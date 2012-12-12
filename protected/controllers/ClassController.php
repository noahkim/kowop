<?php

class ClassController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'search'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'join', 'enrollDialog'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->layout = '//layouts/mainNoSearch';

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = '//layouts/mainNoSearch';
        $model = new ClassCreateForm("step1");
        $step = 1;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['step2']))
        {
            $step = 2;

            $this->setPageState('step1', $_POST['ClassCreateForm']);

            $model->attributes = $_POST['ClassCreateForm'];

            if (!$model->validate())
            {
                $step = 1;
            }
        }
        elseif (isset($_POST['step3']))
        {
            $step = 3;

            $this->setPageState('step2', $_POST['ClassCreateForm']);

            $model = new ClassCreateForm("step2");
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $_POST['ClassCreateForm'];

            $imageFileName = 'temp' . uniqid();
            $imageFile = CUploadedFile::getInstance($model, 'imageFile');

            if ($imageFile)
            {
                $pathParts = pathinfo($imageFile->getName());
                $imageFileName .= '.' . $pathParts['extension'];

                $imageFile->saveAs(Yii::app()->params['temp'] . '/' . $imageFileName);

                $this->setPageState('imageFileName', $imageFileName);
            }

            if (!$model->validate())
            {
                $step = 2;
            }
        }
        elseif (isset($_POST['step4']))
        {
            $model = new ClassCreateForm("step3");
            $this->setPageState('step3', $_POST['ClassCreateForm']);
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $_POST['ClassCreateForm'];

            $model->imageFile = $this->getPageState('imageFileName');

            $model->user = User::model()->findByPk(Yii::app()->user->id);

            $step = 4;
        }
        elseif (isset($_POST['submit']))
        {
            $model = new ClassCreateForm('submit');
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());
            $model->attributes = $_POST['ClassCreateForm'];

            $model->imageFile = $this->getPageState('imageFileName');

            if ($model->save())
            {
                $this->redirect(array('view', 'id' => $model->class->Class_ID));
            }
            else
            {
                $step = 4;
            }
        }
        else
        {
            if (isset($_POST['ClassCreateForm']))
            {
                $model->attributes = $_POST['ClassCreateForm'];
            }
        }

        $this->render('_createForm' . $step, array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['KClass']))
        {
            $model->attributes = $_POST['KClass'];

            if ($model->save())
            {
                $this->redirect(array('view', 'id' => $model->Class_ID));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('KClass');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionSearch()
    {
        $model = new SearchForm;

        if (isset($_REQUEST['SearchForm']))
        {
            $model->attributes = $_REQUEST['SearchForm'];
            Yii::app()->session['lastSearch'] = $model->keywords;
        }

        $results = $model->search();

        if (isset($_REQUEST['json']))
        {
            echo CJSON::encode($results);
        }
        else
        {
            $this->render('search', array('model' => $model, 'results' => $results));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new KClass('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['KClass']))
        {
            $model->attributes = $_GET['KClass'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionJoin($id)
    {
        $model = $this->loadModel($id);
        $user_ID = Yii::app()->user->id;

        $session = null;
        if (count($model->sessions) > 0)
        {
            if(isset($_REQUEST['session']))
            {
                $session_ID = $_REQUEST['session'];
                $sessionFind = Session::model()->findByPk($session_ID);
                if($sessionFind != null)
                {
                    $session = $sessionFind;
                }
            }
            else
            {
                $session = $model->sessions[0];
            }
        }

        if ($model->Create_User_ID != $user_ID)
        {
            $existing = UserToSession::model()->find('User_ID=:User_ID AND Session_ID=:Session_ID',
                array(':User_ID' => $user_ID, ':Session_ID' => $session->Session_ID));

            if ($existing == null)
            {
                $userToSession = new UserToSession();
                $userToSession->Session_ID = $session->Session_ID;
                $userToSession->User_ID = $user_ID;

                $userToSession->save();
            }
        }

        $this->redirect(array('view', 'id' => $model->Class_ID));
    }

    public function actionEnrollDialog($id)
    {
        $this->layout = false;
        $model = $this->loadModel($id);

        $session = isset($_REQUEST['session']) ? Session::model()->findByPk($_REQUEST['session']) : $model->sessions[0];

        $this->render('enrollDialog', array('model' => $model, 'session' => $session));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = KClass::model()->findByPk($id);
        if ($model === null)
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'kclass-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
