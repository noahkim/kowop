<?php

class UserController extends Controller
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
                'actions' => array('index', 'view', 'create'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'submitProfileChange', 'sendMessage', 'getReplyDialog', 'friendRequest', 'acceptFriend'),
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
        $section = 0;

        if (isset($_REQUEST['s']))
        {
            $section = $_REQUEST['s'];
        }

        if (($id != Yii::app()->user->id) && ($section > 0))
        {
            $section = 0;
        }

        $this->render('view', array(
            'section' => $section,
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = '//layouts/mainOuter';

        $model = new User;

        if (isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            $model->Password = md5($model->Password);

            $identity = new UserIdentity($model->Email, $model->Password);

            if ($model->save())
            {
                if ($identity->authenticate())
                {
                    Yii::app()->user->login($identity);
                    $this->redirect(array('/site/index'));
                }
            }
        }

        $this->render('create', array(
            'model' => $model
        ));
    }

    public function actionUpdate()
    {
        $id = Yii::app()->user->id;

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $imageFile = CUploadedFile::getInstanceByName('profilePic');

        if ($imageFile != null)
        {
            $imageContent = Content::AddContent($imageFile, 'User Image', ContentType::ImageID, 1);

            if ($imageContent != null)
            {
                $userToContent = new UserToContent;
                $userToContent->User_ID = $model->User_ID;
                $userToContent->Content_ID = $imageContent->Content_ID;
                $userToContent->save();
            }
        }

        $this->redirect(array('view', 'id' => $model->User_ID));
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
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User']))
        {
            $model->attributes = $_GET['User'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionClassReport()
    {
        $this->layout = false;

        $id = Yii::app()->user->id;
        $model = $this->loadModel($id);

        $filter = json_decode($_REQUEST['filter']);
        $results = $model->getClassReport($filter);

        echo json_encode($results);
    }

    public function actionSubmitProfileChange()
    {
        $model = $this->loadModel(Yii::app()->user->id);

        if (isset($_POST['id']))
        {
            $attribute = $_POST['id'];
            $value = $_POST['value'];

            $attributes = array($attribute => $value);
            $model->attributes = $attributes;

            $model->save();

            $this->layout = false;
            echo $value;
        }
    }

    public function actionSendMessage($id)
    {
        $sender = Yii::app()->user->id;

        $text = $_POST['message'];
        $replyTo = isset($_POST['replyTo']) ? $_POST['replyTo'] : null;

        Message::SendMessage($id, $sender, $text, $replyTo);

        if ($replyTo != null)
        {
            $to = User::model()->findByPk($id);
            $toLink = CHtml::link($to->fullName, array('/user/view', 'id' => $to->User_ID));

            Message::SendNotification($sender, "Replied to {$toLink}", $text);
        }

        $this->redirect(array('/user/view', 'id' => $sender, 's' => '1'));
    }

    public function actionGetReplyDialog($id)
    {
        $this->layout = false;

        $model = $this->loadModel($id);
        $replyTo = $_REQUEST['replyTo'];

        $this->render('_replyDialog', array(
            'model' => $model,
            'replyTo' => $replyTo
        ));
    }

    public function actionFriendRequest($id)
    {
        /*        if($id == Yii::app()->user->id)
                {
                    return;
                }*/

        $message = $_POST['message'];

        Friend::CreateRequest(Yii::app()->user->id, $id, $message);

        $this->redirect(array('/user/view', 'id' => $id));
    }

    public function actionAcceptFriend($id)
    {
        $friendship = Friend::model()->find('User_ID = :User_ID AND Friend_User_ID = :Friend_User_ID AND Status = :Status',
            array(':User_ID' => $id, ':Friend_User_ID' => Yii::app()->user->id, ':Status' => FriendStatus::AwaitingApproval));

        if ($friendship != null)
        {
            $friendship->Status = FriendStatus::Friend;
            $friendship->save();

            $notification = Message::model()->find('`From` = :From AND `To` = :To AND Type = :Type',
                array(':From' => $id, ':To' => Yii::app()->user->id, ':Type' => MessageType::FriendRequest));

            if ($notification != null)
            {
                $notification->Deleted = 1;
                $notification->save();
            }

            $friend = User::model()->findByPk(Yii::app()->user->id);
            $friendLink = CHtml::link($friend->fullName, array('/user/view', 'id' => Yii::app()->user->id));

            Message::SendNotification($id, "{$friendLink} has accepted your homie request!");
        }

        $this->redirect(array('/user/view', 'id' => Yii::app()->user->id, 's' => '1'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
