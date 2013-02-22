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
                'actions' => array('processPayments', 'balancedCallback'),
                'users' => array('*'),
            ),
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
        $outcome = array('success' => 0);

        if (isset($_POST['data']))
        {
            $dataString = $_POST['data'];
            $data = json_decode($dataString);

            $saveCard = true;
            if (isset($_POST['save']))
            {
                $saveCard = $_POST['save'];
            }

            $uri = $data->uri;

            $card = new CreditCard();
            $card->User_ID = $this->getUser()->User_ID;
            $card->URI = $uri;
            if ($saveCard != null)
            {
                $card->Saved = $saveCard;
            }

            if ($card->save())
            {
                $account = $this->getUserAccount();
                $account->addCard($uri);

                $outcome = array('success' => 1, 'CreditCard_ID' => $card->CreditCard_ID);
            }
            else
            {
                $outcome = array('success' => 0, 'Errors' => $card->getErrors());
            }
        }

        echo CJSON::encode($outcome);
    }

    public function actionDeleteCards()
    {
        Yii::import('application.extensions.vendor.autoload', true);

        Httpful\Bootstrap::init();
        Balanced\Bootstrap::init();
        Balanced\Settings::$api_key = Yii::app()->params['balancedAPISecret'];

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

                    $balancedCard = Balanced\Card::get($cardModel->URI);
                    $balancedCard->is_valid = false;
                    $balancedCard->save();
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
        Yii::import('application.extensions.vendor.autoload', true);

        Httpful\Bootstrap::init();
        Balanced\Bootstrap::init();
        Balanced\Settings::$api_key = Yii::app()->params['balancedAPISecret'];

        $outcome = array('success' => 0);

        try
        {
            if (isset($_POST['data']) && isset($_POST['merchantData']))
            {
                $data = json_decode($_POST['data']);
                $merchantData = json_decode($_POST['merchantData']);

                $uri = $data->uri;

                $user = $this->getUser();
                if ($user->bankAccount != null)
                {
                    $bankAccount = $user->bankAccount;

                    $balancedBankAccount = Balanced\BankAccount::get($bankAccount->URI);
                    $balancedBankAccount->delete();

                    $bankAccount->Active = 0;
                    $bankAccount->save();
                }

                $account = new BankAccount();
                $account->User_ID = $user->User_ID;
                $account->URI = $uri;

                if ($account->save())
                {
                    $balancedAccount = $this->getUserAccount();
                    $balancedAccount->addBankAccount($uri);

                    if (!in_array('merchant', $balancedAccount->roles))
                    {
                        $balancedAccount->promoteToMerchant($merchantData);
                    }

                    $outcome = array('success' => 1, 'BankAccount_ID' => $account->BankAccount_ID);
                }
                else
                {
                    $outcome = array('success' => 0, 'Errors' => $account->getErrors());
                }
            }
        }
        catch (Balanced\Errors\IdentityVerificationFailed $error)
        {
            /* could not identify this account. */
            $outcome = array('success' => 0, 'Errors' => "redirect merchant to:" . $error->redirect_uri . "\n");
        }
        catch (Balanced\Errors\HTTPError $error)
        {
            /* TODO: handle 400 and 409 exceptions as required */
            $outcome = array('success' => 0, 'Errors' => print_r($error, true));
        }

        echo CJSON::encode($outcome);
    }

    public function actionProcessPayments()
    {
        Payment::ProcessPayments();
    }

    public function actionBalancedCallback()
    {
        $raw_post = @file_get_contents("php://input");
        Payment::BalancedCallback($raw_post);
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

    public function getUserAccount()
    {
        Yii::import('application.extensions.vendor.autoload', true);

        Httpful\Bootstrap::init();
        Balanced\Bootstrap::init();
        Balanced\Settings::$api_key = Yii::app()->params['balancedAPISecret'];

        $user = $this->getUser();
        if (!isset($user->AccountURI) || ($user->AccountURI == null))
        {
            $account = Balanced\Marketplace::mine()->createAccount($user->Email);
            $user->AccountURI = $account->uri;
            $user->save(false);
        }
        else
        {
            $account = Balanced\Account::get($user->AccountURI);
        }

        return $account;
    }
}
