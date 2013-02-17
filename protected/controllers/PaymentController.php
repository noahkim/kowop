<?php

class PaymentController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionGetCards()
    {
        Yii::import('application.extensions.vendor.autoload', true);

        Httpful\Bootstrap::init();
        Balanced\Bootstrap::init();
        Balanced\Settings::$api_key = Yii::app()->params['balancedAPISecret'];

        $user = $this->getUser();

        $cards = array();

        foreach ($user->creditCards as $card)
        {
            $cardData = Balanced\Card::get($card->URI);
            $cards[] = array('CreditCard_ID' => $card->CreditCard_ID, 'data' => $cardData);
        }

        echo CJSON::encode($cards);
    }

    public function actionAddCard()
    {
        $isCreated = false;

        if (isset($_POST['data']))
        {
            $dataString = $_POST['data'];
            $data = json_decode($dataString);

            $uri = $data->uri;

            $card = new CreditCard();
            $card->User_ID = $this->getUser()->User_ID;
            $card->URI = $uri;

            $isCreated = $card->save();
        }

        if ($isCreated)
        {
            echo 'Success';
        }
        else
        {
            echo 'Error';
        }
    }

    public function actionDeleteCards()
    {
        if (isset($_POST['data']))
        {
            $dataString = $_POST['data'];
            $data = json_decode($dataString);

            $user_ID = $this->getUser()->User_ID;

            foreach ($data as $card)
            {
                $cardModel = CreditCard::model()->findByPk($card);
                if ($cardModel->User_ID == $user_ID)
                {
                    $cardModel->Active = 0;
                    $cardModel->save();
                }
            }
        }
    }

    public function actionGetBankAccount()
    {
        Yii::import('application.extensions.vendor.autoload', true);

        Httpful\Bootstrap::init();
        Balanced\Bootstrap::init();
        Balanced\Settings::$api_key = Yii::app()->params['balancedAPISecret'];

        $account = null;

        $user = $this->getUser();
        if ($user->bankAccount != null)
        {
            $accountData = Balanced\BankAccount::get($user->bankAccount->URI);
            $account = array('BankAccount_ID' => $user->bankAccount->BankAccount_ID, 'data' => $accountData);
        }

        echo CJSON::encode($account);
    }

    public function actionAddBankAccount()
    {
        $isCreated = false;

        if (isset($_POST['data']))
        {
            $dataString = $_POST['data'];
            $data = json_decode($dataString);

            $uri = $data->uri;

            $user = $this->getUser();
            if ($user->bankAccount != null)
            {
                $user->bankAccount->Active = 0;
                $user->bankAccount->save();
            }

            $account = new BankAccount();
            $account->User_ID = $user->User_ID;
            $account->URI = $uri;

            $isCreated = $account->save();
        }

        if ($isCreated)
        {
            echo 'Success';
        }
        else
        {
            echo 'Error';
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Payment::model()->findByPk($id);
        if ($model === null)
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    public function getUser()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);

        return $user;
    }
}
