<?php

class RequestController extends Controller
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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'join', 'leave'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id)
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Request;
        $modelJoin = new RequestJoinForm;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Request'], $_POST['RequestJoinForm']))
        {
            $model->attributes = $_POST['Request'];
            $modelJoin->attributes = $_POST['RequestJoinForm'];

            $transaction = Yii::app()->db->beginTransaction();
            try
            {
                $model->save();

                if (isset($_POST['tags']))
                {
                    $tags = Tag::model()->string2array($_POST['tags']);
                    foreach ($tags as $tagName)
                    {
                        $tag = Tag::model()->findOrCreate($tagName);

                        $requestToTag = new RequestToTag;
                        $requestToTag->Request_ID = $model->Request_ID;
                        $requestToTag->Tag_ID = $tag->Tag_ID;
                        $requestToTag->save();
                    }
                }

                $modelJoin->request_ID = $model->Request_ID;
                $modelJoin->user_ID = $model->Create_User_ID;

                $modelJoin->save();

                $transaction->commit();

                $this->redirect(array('view', 'id' => $model->Request_ID));
            }
            catch (Exception $e)
            {
                $transaction->rollback();
            }
        }

        $this->render('create', array(
            'model' => $model,
            'modelJoin' => $modelJoin,
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

        if (isset($_POST['Request']))
        {
            $model->attributes = $_POST['Request'];
            if ($model->save())
            {
                $this->redirect(array('view', 'id' => $model->Request_ID));
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
        $dataProvider = new CActiveDataProvider('Request');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Request('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Request']))
        {
            $model->attributes = $_GET['Request'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionJoin($id)
    {
        $user_ID = Yii::app()->user->id;

        $joinForm = new RequestJoinForm;
        if (isset($_REQUEST['RequestJoinForm']))
        {
            $joinForm->attributes = $_REQUEST['RequestJoinForm'];
        }

        $transaction = Yii::app()->db->beginTransaction();
        try
        {
            $joinForm->request_ID = $id;
            $joinForm->user_ID = $user_ID;
            $joinForm->save();

            $transaction->commit();
        }
        catch (Exception $e)
        {
            $transaction->rollback();
        }

        $this->redirect(array('view', 'id' => $id));
    }

    public function actionLeave($id)
    {
        $model = $this->loadModel($id);
        $user_ID = Yii::app()->user->id;

        $existing = RequestToUser::model()->find(
            'User_ID=:User_ID AND Request_ID=:Request_ID',
            array(':User_ID' => $user_ID, ':Request_ID' => $model->Request_ID)
        );

        if ($existing != null)
        {
            RequestToUser::model()->deleteAll(
                'User_ID=:User_ID AND Request_ID=:Request_ID',
                array(':User_ID' => $user_ID, ':Request_ID' => $model->Request_ID)
            );
        }

        $leftOver = RequestToUser::model()->find('Request_ID=:Request_ID', array(':Request_ID' => $model->Request_ID));
        if($leftOver == null)
        {
            // TODO: de-activate request
        }

        $this->redirect(array('view', 'id' => $id));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Request::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'request-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
