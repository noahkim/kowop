<?php

class ExperienceController extends Controller
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
                'actions' => array('index', 'view', 'search', 'enrollDialog', 'viewDialog', 'searchResults'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'updateSessions', 'join', 'leave', 'delete', 'uploadImages'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
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
        $this->layout = '//layouts/main';

        $view = 'view/_default';

        $model = $this->loadModel($id);

        if (!Yii::app()->user->isGuest)
        {
            if (Yii::app()->user->id == $model->Create_User_ID)
            {
                $view = 'view/_teacher';
            }
            else
            {
                $isEnrolled = count($model->students(array('condition' => 'students.User_ID = ' . Yii::app()->user->id))) > 0;

                if ($isEnrolled)
                {
                    $view = 'view/_enrolled';
                }
            }
        }

        $this->render('view', array('model' => $model, 'view' => $view));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = '//layouts/main';
        $model = new ExperienceCreateForm("step1");
        $step = 1;

        Yii::import("xupload.models.XUploadForm");
        $images = new XUploadForm;

        if (isset($_POST['step2']))
        {
            $step = 2;

            Yii::app()->user->setState('imageFileNames', array());

            $this->setPageState('step1', $_POST['ExperienceCreateForm']);

            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());
            $model->attributes = $_POST['ExperienceCreateForm'];

            if (!$model->validate())
            {
                $step = 1;
            }
        }
        elseif (isset($_POST['step3']))
        {
            $step = 3;

            $this->setPageState('step2', $_POST['ExperienceCreateForm']);

            $model = new ExperienceCreateForm("step2");
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());
            $model->attributes = $_POST['ExperienceCreateForm'];

            if (!$model->validate())
            {
                $step = 2;
            }
        }
        elseif (isset($_POST['step4']))
        {
            $model = new ExperienceCreateForm("step3");
            $this->setPageState('step3', $_POST['ExperienceCreateForm']);
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());
            $model->attributes = $_POST['ExperienceCreateForm'];

            $model->imageFiles = Yii::app()->user->getState('imageFileNames');
            $model->user = User::model()->findByPk(Yii::app()->user->id);

            $step = 4;
        }
        elseif (isset($_POST['submit']))
        {
            $model = new ExperienceCreateForm('submit');
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());

            $model->imageFiles = Yii::app()->user->getState('imageFileNames');

            if ($model->save())
            {
                Yii::app()->user->setState('imageFileNames', array());

                $this->redirect(array('view', 'id' => $model->experience->Experience_ID));
            }
            else
            {
                $step = 4;
            }
        }
        elseif (isset($_POST['change']))
        {
            $step = 1;

            $model = new ExperienceCreateForm('submit');
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());
        }
        else
        {
            if (isset($_POST['ExperienceCreateForm']))
            {
                $model->attributes = $_POST['ExperienceCreateForm'];
            }
        }

        $this->render('_createForm' . $step, array(
            'model' => $model,
            'images' => $images,
        ));
    }

    public function actionUpdateSessions($id)
    {
        $this->layout = '//layouts/main';

        $model = $this->loadModel($id);

        if (isset($_POST['sessionsData']))
        {
            $sessionData = json_decode($_POST['sessionsData']);

            $keptSessions = array();

            foreach ($sessionData as $sessionItem)
            {
                if ($sessionItem->existingSessionID > 0)
                {
                    $keptSessions[] = $sessionItem->existingSessionID;
                }
                else
                {
                    $session = new Session;
                    $session->Experience_ID = $model->Experience_ID;
                    $session->save();

                    foreach ($sessionItem->lessons as $lessonItem)
                    {
                        $lesson = new Lesson;
                        $lesson->Session_ID = $session->Session_ID;
                        $lesson->Start = $lessonItem->start;
                        $lesson->End = $lessonItem->end;

                        $lesson->save();
                    }

                    $keptSessions[] = $session->Session_ID;
                }
            }
        }

        $this->render('updateSessions', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $this->layout = '//layouts/main';

        $model = $this->loadModel($id);
        Yii::import("xupload.models.XUploadForm");
        $images = new XUploadForm;

        if (isset($_POST['Experience']))
        {
            $model->attributes = $_POST['Experience'];

            $imageFiles = Yii::app()->user->getState('imageFileNames');

            if (isset($imageFiles) && count($imageFiles) > 0)
            {
                ClassToContent::model()->deleteAll('Experience_ID = :Experience_ID', array(':Experience_ID' => $model->Experience_ID));

                foreach ($imageFiles as $imageFile)
                {
                    $content = Content::AddContent($imageFile, 'Class Image', ContentType::ImageID);

                    $classToContent = new ClassToContent;
                    $classToContent->Experience_ID = $model->Experience_ID;
                    $classToContent->Content_ID = $content->Content_ID;
                    $classToContent->save();
                }

                Yii::app()->user->setState('imageFileNames', array());
            }

            if ($model->save())
            {
                // Notify the students
                foreach ($model->students as $student)
                {
                    if ($student->User_ID != $model->Create_User_ID)
                    {
                        $userName = CHtml::link($model->createUser->fullName, array('user/view', 'id' => $model->createUser->User_ID));
                        $className = CHtml::link($model->Name, array('experience/view', 'id' => $model->Experience_ID));

                        Message::SendNotification($student->User_ID, "{$userName} has updated the class details for \"{$className}\".");
                    }
                }

                $this->redirect(array('view', 'id' => $model->Experience_ID));
            }
        }
        else
        {
            Yii::app()->user->setState('imageFileNames', array());
        }

        $this->render('update', array(
            'model' => $model,
            'images' => $images,
        ));
    }

    public function actionUploadImages()
    {
        $this->layout = false;

        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = Yii::app()->params['temp'];

        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT'])
            && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
        )
        {
            header('Content-type: application/json');
        }
        else
        {
            header('Content-type: text/plain');
        }

        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"]))
        {
            if ($_GET["_method"] == "delete")
            {
                if ($_GET["file"][0] !== '.')
                {
                    $file = $path . $_GET["file"];
                    if (is_file($file))
                    {
                        unlink($file);
                    }
                }
                echo json_encode(true);
            }
        }
        else
        {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');

            if ($model->file !== null)
            {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();

                $imageFileName = 'temp' . uniqid();
                $pathParts = pathinfo($model->name);
                $imageFileName .= '.' . $pathParts['extension'];

                if ($model->validate())
                {
                    $model->file->saveAs(Yii::app()->params['temp'] . '/' . $imageFileName);

                    if (Yii::app()->user->hasState('imageFileNames'))
                    {
                        $imageFileNames = Yii::app()->user->getState('imageFileNames');
                    }
                    else
                    {
                        $imageFileNames = array();
                    }

                    $imageFileNames[] = $imageFileName;

                    Yii::app()->user->setState('imageFileNames', $imageFileNames);

                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                        "name" => $model->name,
                        "type" => $model->mime_type,
                        "size" => $model->size,
                        "url" => Yii::app()->params['siteBase'] . '/temp/' . $imageFileName,
                        "thumbnail_url" => Yii::app()->params['siteBase'] . '/temp/' . $imageFileName,
                        "delete_url" => $this->createUrl("//experience/uploadImages", array(
                            "_method" => "delete",
                            "file" => $imageFileName
                        )),
                        "delete_type" => "POST"
                    )));
                }
                else
                {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                        )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()),
                        CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            }
            else
            {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->Status = ExperienceStatus::Inactive;
        $model->save();

        $this->redirect(array('//site/index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Experience');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionSearch()
    {
        $this->layout = '//layouts/mainNoSearch';

        $model = new ExperienceSearchForm;

        if (isset($_REQUEST['ExperienceSearchForm']))
        {
            $model->attributes = $_REQUEST['ExperienceSearchForm'];
            Yii::app()->session['lastSearch'] = $model->keywords;
        }

        $results = $model->search();

        $this->render('search', array('model' => $model, 'results' => $results));
    }

    public function actionSearchResults()
    {
        $this->layout = false;

        $model = new ExperienceSearchForm;

        if (isset($_REQUEST['ExperienceSearchForm']))
        {
            $model->attributes = $_REQUEST['ExperienceSearchForm'];
            Yii::app()->session['lastSearch'] = $model->keywords;
        }

        $results = $model->search();

        if (isset($_REQUEST['json']))
        {
            echo CJSON::encode($results);
        }
        else
        {
            $this->render('_searchResults', array('model' => $model, 'results' => $results));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Experience('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Experience']))
        {
            $model->attributes = $_GET['Experience'];
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
            if (isset($_REQUEST['session']))
            {
                $session_ID = $_REQUEST['session'];
                $sessionFind = Session::model()->findByPk($session_ID);
                if ($sessionFind != null)
                {
                    $session = $sessionFind;
                }
            }
            else
            {
                $session = $model->nextAvailableSession;
            }
        }

        $user = User::model()->findByPk($user_ID);

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

            $userName = CHtml::link($user->fullName, array('user/view', 'id' => $user->User_ID));
            $className = CHtml::link($model->Name, array('experience/view', 'id' => $model->Experience_ID));

            Message::SendNotification($model->Create_User_ID, "{$userName} has joined your class \"{$className}\".");
        }

        // Notify the students
        foreach ($model->students as $student)
        {
            if ($student->User_ID != $user_ID)
            {
                $userName = CHtml::link($user->fullName, array('user/view', 'id' => $user->User_ID));
                $className = CHtml::link($model->Name, array('experience/view', 'id' => $model->Experience_ID));

                Message::SendNotification($student->User_ID, "{$userName} has also joined the class \"{$className}\".");
            }
        }

        $this->redirect(array('view', 'id' => $model->Experience_ID));
    }

    public function actionLeave($id)
    {
        $model = $this->loadModel($id);
        $user_ID = Yii::app()->user->id;

        UserToSession::model()->deleteAll('User_ID=:User_ID', array(':User_ID' => $user_ID));

        $this->redirect(array('view', 'id' => $model->Experience_ID));
    }

    public function actionEnrollDialog($id)
    {
        $this->layout = false;
        $model = $this->loadModel($id);

        $session = isset($_REQUEST['session']) ? Session::model()->findByPk($_REQUEST['session']) : $model->sessions[0];

        $this->render('dialogs/enrollDialog', array('model' => $model, 'session' => $session));
    }

    public function actionViewDialog()
    {
        $this->layout = false;

        if (isset($_REQUEST['lesson']))
        {
            $lesson = Lesson::model()->findByPk($_REQUEST['lesson']);
            $this->render('dialogs/viewDialog', array('model' => $lesson));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Experience::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Experience-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
