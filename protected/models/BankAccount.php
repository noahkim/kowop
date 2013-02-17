<?php

/**
 * This is the model class for table "BankAccount".
 *
 * The followings are the available columns in table 'BankAccount':
 * @property integer $BankAccount_ID
 * @property integer $User_ID
 * @property string $URI
 * @property integer $Active
 * @property integer $Type
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Payment[] $payments
 */
class BankAccount extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BankAccount the static model class
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
        return 'BankAccount';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('User_ID, Active, Type', 'numerical', 'integerOnly' => true),
            array('URI', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('BankAccount_ID, User_ID, URI, Active, Type, Created', 'safe'),
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
            'user' => array(self::BELONGS_TO, 'User', 'User_ID'),
            'payments' => array(self::HAS_MANY, 'Payment', 'BankAccount_ID'),
        );
    }

    public function scopes()
    {
        $t = $this->getTableAlias(false);

        return array(
            'active' => array('condition' => "{$t}.Active = " . 1),
            'inactive' => array('condition' => "{$t}.Active <> " . 1),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'BankAccount_ID' => 'Bank Account',
            'User_ID' => 'User',
            'URI' => 'Uri',
            'Active' => 'Active',
            'Type' => 'Type',
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

        $criteria->compare('BankAccount_ID', $this->BankAccount_ID);
        $criteria->compare('User_ID', $this->User_ID);
        $criteria->compare('URI', $this->URI, true);
        $criteria->compare('Active', $this->Active);
        $criteria->compare('Type', $this->Type);
        $criteria->compare('Created', $this->Created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave()
    {
        $this->Type = BankAccountType::Customer;

        return parent::beforeSave();
    }
}