<?php

class ExperienceController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('accessControl', // perform access control for CRUD operations
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
        return array(array('allow', // allow all users to perform 'index' and 'view' actions
            'actions' => array('index', 'view', 'search', 'enrollDialog', 'viewDialog', 'searchResults', 'getPictures'),
            'users' => array('*'),),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'updateDescription', 'updateScheduling', 'signup', 'signupConfirmation', 'leave', 'delete',
                    'uploadImages', 'deletePicture'), 'users' => array('@'),),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'), 'users' => array('admin'),), array('deny', // deny all users
                'users' => array('*'),),);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->layout = '//layouts/main';

        $model = $this->loadModel($id);
        $user = null;

        $view = 'view/_default';

        if (!Yii::app()->user->isGuest)
        {
            $user = User::model()->findByPk(Yii::app()->user->id);

            if (Yii::app()->user->id == $model->Create_User_ID)
            {
                $view = 'view/_host';
            }
            else
            {
                $isEnrolled = count($model->enrolled(array('condition' => 'enrolled.User_ID = ' . Yii::app()->user->id))) > 0;

                if ($isEnrolled)
                {
                    $view = 'view/_enrolled';
                }
            }
        }

        if (!isset($_SERVER['HTTP_REFERER']) || ($_SERVER['HTTP_REFERER'] != $this->createAbsoluteUrl('/experience/view', array('id' => $id))))
        {
            $model->Views++;
            $model->save(false);
        }

        $this->render('view', array('model' => $model, 'view' => $view, 'user' => $user));
    }

    public function actionCreate()
    {
        $this->layout = '//layouts/main';
        $model = new ExperienceCreateForm("step1");

        Yii::import("xupload.models.XUploadForm");
        $images = new XUploadForm;

        $step = 1;
        if (isset($_REQUEST['step']))
        {
            $step = $_REQUEST['step'];
        }

        if (is_numeric($step) && ($step > 1))
        {
            $existingForm = isset($_POST['ExperienceCreateForm']) ? $_POST['ExperienceCreateForm'] : null;
            $this->setPageState('step' . ($step - 1), $existingForm);

            $model = new ExperienceCreateForm("step" . ($step - 1));

            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());
            $model->attributes = $this->getPageState('step4', array());
            $model->attributes = $this->getPageState('step5', array());
            $model->attributes = $this->getPageState('step6', array());

            $model->imageFiles = Yii::app()->user->getState('imageFileNames');

            if ($existingForm != null)
            {
                $model->attributes = $existingForm;

                if (!$model->validate())
                {
                    $step--;
                }
            }
        }
        elseif (isset($_POST['submit']))
        {
            $model->attributes = $this->getPageState('step1', array());
            $model->attributes = $this->getPageState('step2', array());
            $model->attributes = $this->getPageState('step3', array());
            $model->attributes = $this->getPageState('step4', array());
            $model->attributes = $this->getPageState('step5', array());
            $model->attributes = $this->getPageState('step6', array());

            $existingForm = isset($_POST['ExperienceCreateForm']) ? $_POST['ExperienceCreateForm'] : null;

            if ($existingForm != null)
            {
                $model->attributes = $existingForm;
            }

            $model->imageFiles = Yii::app()->user->getState('imageFileNames');

            if ($model->save())
            {
                Yii::app()->user->setState('imageFileNames', array());

                $this->redirect(array('/experience/view', 'id' => $model->experience->Experience_ID));
            }
            else
            {
                $step = 1;
            }
        }
        elseif (isset($_POST['change']))
        {
            $step = 1;
        }

        if ($step == 4)
        {
            Yii::app()->user->setState('imageFileNames', array());
        }
        elseif ($step == 6)
        {
            $this->layout = '//layouts/createSessions';
        }

        $user = User::model()->findByPk(Yii::app()->user->id);

        $this->render('_createForm' . $step, array('model' => $model, 'images' => $images, 'user' => $user));

    }

    public function actionUpdate($id)
    {
        $this->checkOwner($id);

        $model = $this->loadModel($id);
        Yii::import("xupload.models.XUploadForm");
        $images = new XUploadForm;

        if (isset($_POST['Experience']))
        {
            $model->attributes = $_POST['Experience'];

            $imageFiles = Yii::app()->user->getState('imageFileNames');

            if (isset($imageFiles) && count($imageFiles) > 0)
            {
                /*ExperienceToContent::model()->deleteAll('Experience_ID = :Experience_ID',
                    array(':Experience_ID' => $model->Experience_ID));*/

                foreach ($imageFiles as $imageFile)
                {
                    $content = Content::AddContent($imageFile, 'Class Image', ContentType::ImageID);

                    $experienceToContent = new ExperienceToContent;
                    $experienceToContent->Experience_ID = $model->Experience_ID;
                    $experienceToContent->Content_ID = $content->Content_ID;
                    $experienceToContent->save();
                }

                Yii::app()->user->setState('imageFileNames', array());
            }

            if ($model->save())
            {
                // Notify the students
                foreach ($model->enrolled as $enrollee)
                {
                    if ($enrollee->User_ID != $model->Create_User_ID)
                    {
                        $userName = CHtml::link($model->createUser->fullName,
                            array('user/view', 'id' => $model->createUser->User_ID));
                        $experienceName = CHtml::link($model->Name,
                            array('experience/view', 'id' => $model->Experience_ID));

                        Message::SendNotification($enrollee->User_ID,
                            "{$userName} has updated the experience details for \"{$experienceName}\".");
                    }
                }
            }
        }
        else
        {
            Yii::app()->user->setState('imageFileNames', array());
        }

        $this->render('update', array('model' => $model, 'images' => $images,));
    }

    public function actionUpdateDescription($id)
    {
        $this->checkOwner($id);

        $model = $this->loadModel($id);

        if (isset($_POST['Experience']))
        {
            $model->attributes = $_POST['Experience'];

            if ($model->save())
            {
                // Notify the students
                foreach ($model->enrolled as $enrollee)
                {
                    if ($enrollee->User_ID != $model->Create_User_ID)
                    {
                        $userName = CHtml::link($model->createUser->fullName,
                            array('user/view', 'id' => $model->createUser->User_ID));
                        $experienceName = CHtml::link($model->Name,
                            array('experience/view', 'id' => $model->Experience_ID));

                        Message::SendNotification($enrollee->User_ID,
                            "{$userName} has updated the experience details for \"{$experienceName}\".");
                    }
                }
            }
        }

        $this->render('updateDescription', array('model' => $model));
    }

    public function actionUpdateScheduling($id)
    {
        $this->checkOwner($id);

        $this->layout = '//layouts/createSessions';

        $model = $this->loadModel($id);

        if (isset($_POST['Experience']))
        {
            $model->attributes = $_POST['Experience'];

            if ($model->save(false))
            {
                // Notify the students
                foreach ($model->enrolled as $enrollee)
                {
                    if ($enrollee->User_ID != $model->Create_User_ID)
                    {
                        $userName = CHtml::link($model->createUser->fullName,
                            array('user/view', 'id' => $model->createUser->User_ID));
                        $experienceName = CHtml::link($model->Name,
                            array('experience/view', 'id' => $model->Experience_ID));

                        Message::SendNotification($enrollee->User_ID,
                            "{$userName} has updated the experience details for \"{$experienceName}\".");
                    }
                }
            }
        }

        $this->render('updateScheduling', array('model' => $model));
    }

    public function actionUploadImages()
    {
        $this->layout = false;

        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = Yii::app()->params['temp'];

        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
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
                    echo json_encode(array(array("name" => $model->name, "type" => $model->mime_type,
                        "size" => $model->size,
                        "url" => Yii::app()->params['siteBase'] . '/temp/' . $imageFileName,
                        "thumbnail_url" => Yii::app()->params['siteBase'] . '/temp/' . $imageFileName,
                        "delete_url" => $this->createUrl("//experience/uploadImages",
                            array("_method" => "delete",
                                "file" => $imageFileName)),
                        "delete_type" => "POST")));
                }
                else
                {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(array("error" => $model->getErrors('file'),)));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR,
                        "xupload.actions.XUploadAction");
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
        $this->checkOwner($id);

        $model = $this->loadModel($id);
        $model->Status = ExperienceStatus::Inactive;
        $model->save();

        $this->redirect(array('//site/index'));
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
            echo $this->getJSONFormattedResults($results);
        }
        else
        {
            $this->render('_searchResults', array('model' => $model, 'results' => $results));
        }
    }

    private function getJSONFormattedResults($results)
    {
        $formattedResults = array();
        $tags = array();
        $categories = array();

        foreach ($results as $i => $item)
        {
            $formattedResult = array();

            $name = "<h5> {$item->Name} </h5>";
            if ($item instanceof Experience)
            {
                $name = CHtml::link($name, array('/experience/view', 'id' => $item->Experience_ID));

                $formattedResult['itemNumber'] = $i + 1;

                $lat = $item->location->Latitude;
                $lng = $item->location->Longitude;
                $formattedResult['lat'] = $lat;
                $formattedResult['lng'] = $lng;

                $itemTags = $item->tagList;

                $formattedResult['tags'] = $itemTags;
                $formattedResult['category'] = $item->category->Name;

                $tags = array_unique(array_merge($tags, $itemTags));
                array_push($categories, $item->category->Name);

                $formattedResult['link'] = $this->createUrl('/experience/view', array('id' => $item->Experience_ID));
                $formattedResult['type'] = 'experience';
                $formattedResult['experienceType'] = ExperienceType::$Lookup[$item->ExperienceType];
                $formattedResult['id'] = $item->Experience_ID;

                $imageHTML = "<img src='http://flickholdr.com/400/300/bbq' />";
                if (count($item->contents) > 0)
                {
                    $link = $item->contents[0]->Link;
                    $imageHTML = "<img src='{$link}' />";
                }

                $imageLink = CHtml::link($imageHTML, array('/experience/view', 'id' => $item->Experience_ID));

                $formattedResult['tile'] = <<<BLOCK
                <!---- Google maps tile ---->
                <div class="mapTile">
                    {$imageLink}
                    {$name}
                </div>
BLOCK;
            }

            $formattedResults['results'][] = $formattedResult;
        }

        $formattedResults['tags'] = $tags;
        $categories = array_unique($categories);
        $formattedResults['categories'] = $categories;

        return CJSON::encode($formattedResults);
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

        $this->render('admin', array('model' => $model,));
    }

    public function actionSignup($id)
    {
        $model = $this->loadModel($id);

        $user = User::model()->findByPk(Yii::app()->user->id);
        if ($user->User_ID == $model->createUser->User_ID)
        {
            $this->redirect(array('view', 'id' => $model->Experience_ID));
        }

        $session = null;
        $sessionID = null;
        if (isset($_REQUEST['session']))
        {
            $sessionID = $_REQUEST['session'];
            $session = Session::model()->findByPk($sessionID);
        }

        $quantity = 1;
        if (isset($_POST['quantity']))
        {
            $quantity = $_POST['quantity'];
        }

        if (isset($_POST['confirm']))
        {
            $creditCard = null;

            if (isset($_POST['CreditCard_ID']))
            {
                $creditCard = $_POST['CreditCard_ID'];
            }

            if ($model->SignUp($sessionID, $quantity, $creditCard))
            {
                $this->redirect(array('/experience/signupConfirmation'));
            }
        }

        $this->render('signup', array('model' => $model, 'session' => $session, 'quantity' => $quantity));
    }

    public function actionSignupConfirmation()
    {
        $this->render('signupConfirmation');
    }

    public function actionLeave($id)
    {
        $model = $this->loadModel($id);
        $user_ID = Yii::app()->user->id;

        UserToExperience::model()->deleteAll('User_ID=:User_ID AND Experience_ID=:Experience_ID',
            array(':User_ID' => $user_ID, ':Experience_ID' => $model->Experience_ID));

        $this->redirect(array('view', 'id' => $model->Experience_ID));
    }

    public function actionEnrollDialog($id)
    {
        $this->layout = false;
        $model = $this->loadModel($id);

        $session = isset($_REQUEST['session']) ? Session::model()->findByPk($_REQUEST['session']) : $model->nextAvailableSession;

        $this->render('dialogs/enrollDialog', array('model' => $model, 'session' => $session));
    }

    public function actionViewDialog()
    {
        $this->layout = false;

        if (isset($_REQUEST['session']))
        {
            $session = Session::model()->findByPk($_REQUEST['session']);
            $this->render('dialogs/viewDialog', array('model' => $session));
        }
    }

    public function actionGetPictures($id)
    {
        $model = $this->loadModel($id);

        $pictures = array();

        foreach ($model->contents as $item)
        {
            $pictures[] = array(
                'Content_ID' => $item->Content_ID,
                'Link' => $item->Link
            );
        }

        echo CJSON::encode($pictures);
    }

    public function actionDeletePicture($id)
    {
        $this->checkOwner($id);

        if (isset($_POST['Content_ID']))
        {
            $contentID = $_POST['Content_ID'];

            ExperienceToContent::model()->deleteAll('Experience_ID=:Experience_ID AND Content_ID=:Content_ID',
                array(':Experience_ID' => $id, ':Content_ID' => $contentID));
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

    protected function checkOwner($experienceID)
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $model = $this->loadModel($experienceID);

        if ($user->User_ID != $model->createUser->User_ID)
        {
            throw new Exception('Only the experience host may modify the experience.');
        }
    }
}
