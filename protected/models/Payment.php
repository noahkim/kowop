<?php

/**
 * This is the model class for table "Payment".
 *
 * The followings are the available columns in table 'Payment':
 * @property integer $Payment_ID
 * @property integer $CreditCard_ID
 * @property integer $BankAccount_ID
 * @property integer $Experience_ID
 * @property string $Amount
 * @property string $Batch_ID
 * @property integer $Status
 * @property string $Processed
 * @property string $ScheduledFor
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property CreditCard $creditCard
 * @property BankAccount $bankAccount
 * @property Experience $experience
 */
class Payment extends CActiveRecord
{
    const CODE_BASE = 36;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Payment the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Payment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CreditCard_ID, BankAccount_ID, Experience_ID', 'numerical', 'integerOnly' => true),
            array('Amount', 'length', 'max' => 10),
            array('Batch_ID', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Payment_ID, CreditCard_ID, BankAccount_ID, Experience_ID, Amount, Batch_ID, Status, Processed, ScheduledFor, Created', 'safe'),
            array('Created', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false,
                'on' => 'insert'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'creditCard' => array(self::BELONGS_TO, 'CreditCard', 'CreditCard_ID'),
            'bankAccount' => array(self::BELONGS_TO, 'BankAccount', 'BankAccount_ID'),
            'experience' => array(self::BELONGS_TO, 'Experience', 'Experience_ID'),
            'buyer' => array(self::HAS_ONE, 'User', array('User_ID' => 'User_ID'), 'through' => 'creditCard'),
            'seller' => array(self::HAS_ONE, 'User', array('User_ID' => 'User_ID'), 'through' => 'bankAccount'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Payment_ID' => 'Payment',
            'CreditCard_ID' => 'Credit Card',
            'BankAccount_ID' => 'Bank Account',
            'Experience_ID' => 'Experience',
            'Amount' => 'Amount',
            'Batch_ID' => 'Batch',
            'Status' => 'Status',
            'Processed' => 'Processed',
            'ScheduledFor' => 'Scheduled For',
            'Created' => 'Created',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('Payment_ID', $this->Payment_ID);
        $criteria->compare('CreditCard_ID', $this->CreditCard_ID);
        $criteria->compare('BankAccount_ID', $this->BankAccount_ID);
        $criteria->compare('Experience_ID', $this->Experience_ID);
        $criteria->compare('Amount', $this->Amount, true);
        $criteria->compare('Batch_ID', $this->Batch_ID, true);
        $criteria->compare('Status', $this->Status, true);
        $criteria->compare('Processed', $this->Processed, true);
        $criteria->compare('ScheduledFor', $this->ScheduledFor, true);
        $criteria->compare('Created', $this->Created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getCode()
    {
        return base_convert($this->Payment_ID, 10, Payment::CODE_BASE);
    }

    public static function GetPaymentFromCode($code)
    {
        $payment = Payment::model()->findByPk(intval($code, Payment::CODE_BASE));

        return $payment;
    }

    public static function ProcessPayments()
    {
        Yii::import('application.extensions.vendor.autoload', true);

        Httpful\Bootstrap::init();
        Balanced\Bootstrap::init();
        Balanced\Settings::$api_key = Yii::app()->params['balancedAPISecret'];

        //$pending = Payment::model()->findAll();
        $pending = Payment::model()->findAll(array('condition' => '(Status = ' . PaymentStatus::Scheduled . ')')); // AND ScheduledFor <= now()'));

        echo "Found " . count($pending) . " payments to process.\n\n";

        foreach ($pending as $payment)
        {
            try
            {
                $user = $payment->creditCard->user;

                $balancedAccount = null;
                if (isset($user->AccountURI) && ($user->AccountURI != null))
                {
                    echo 'Account URI: ' . $user->AccountURI . "\n";

                    $balancedAccount = Balanced\Account::get($user->AccountURI);
                }

                // Convert to cents
                $amount = $payment->Amount * 100;

                $statementText = "Kowop.com";
                $meta = array("Payment_ID" => "{$payment->Payment_ID}");
                $description = "Charged \${$payment->Amount} for {$payment->experience->Name}";

                $balancedAccount->debit(
                    $amount,
                    $statementText,
                    $description,
                    $meta,
                    $payment->creditCard->URI
                );

                print_r($payment->attributes);
                echo str_repeat('-', 40) . "\n\n";

                $payment->Status = PaymentStatus::Processed;
                $payment->Processed = date('Y-m-d H:i:s');
                $payment->save();
            }
            catch (Exception $e)
            {
                Mail::Instance()->Alert("Error charging card", print_r($e));

                echo 'Error: ' . print_r($e, true) . "\n";

                $payment->Status = PaymentStatus::Error;
                $payment->save();
            }
        }
    }

    public static function BalancedCallback($post)
    {
        Yii::import('application.extensions.vendor.autoload', true);

        Httpful\Bootstrap::init();
        Balanced\Bootstrap::init();
        Balanced\Settings::$api_key = Yii::app()->params['balancedAPISecret'];

        $log = "Received callback... \n";

        $data = json_decode($post);

        if ($data->type == 'debit.succeeded')
        {
            try
            {
                $log .= "Customer debit succeeded. Paying the host...\n";

                $paymentID = $data->entity->meta->Payment_ID;

                $log .= "Payment_ID: {$paymentID}\n";

                $payment = Payment::model()->findByPk($paymentID);

                $hostAmount = $payment->Amount * Yii::app()->params['HostPercentage'];

                $log .= "Host's share is \${$hostAmount}\n";

                // Convert to cents
                $hostAmount *= 100;

                $hostBankAccount = Balanced\BankAccount::get($payment->bankAccount->URI);
                $credit = $hostBankAccount->credit($hostAmount);

                $log .= 'Sent credit, response is: ' . print_r($credit, true) . "\n";
            }
            catch (Exception $e)
            {
                Mail::Instance()->Alert("Error crediting host account", print_r($e));

                Yii::log(print_r($e, true), 'info', 'BalancedCallback');
            }
        }
        else
        {
            $log .= print_r($data, true) . "\n";

        }

        Yii::log($log, 'info', 'BalancedCallback');
    }
}