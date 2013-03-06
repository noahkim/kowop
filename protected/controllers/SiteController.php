<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
                'layout' => '//layouts/main'
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->layout = false;
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
            {
                echo $error['message'];
            }
            else
            {
                $this->layout = '//layouts/mainNoSearch';
                $this->render('error', $error);
            }
        }
    }

    public function actionLogin()
    {
        $this->layout = '//layouts/mainOuter';

        $model = new LoginForm;

        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate() && $model->login())
            {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // displays the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionGetLocation()
    {
        $this->layout = false;

        if (isset($_REQUEST['latlng']))
        {
            $latlng = $_REQUEST['latlng'];
            $url = "http://maps.googleapis.com/maps/api/geocode/json?&latlng={$latlng}&sensor=false";
        }
        elseif (isset($_REQUEST['address']))
        {
            $address = $_REQUEST['address'];
            $url = "http://maps.googleapis.com/maps/api/geocode/json?&address={$address}&sensor=false";
        }

        $results = file_get_contents($url);
        echo $results;
    }

    public function actionContact()
    {
        $model = new ContactForm;

        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];

            if ($model->save())
            {
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        $this->render('contact', array('model' => $model));
    }
}