<?php

Yii::import('ext.iwi.Iwi');

class ExperienceCreateForm extends CFormModel
{
    // Step 1

    public $PosterType;

    // Step 2

    public $Type;

    // Step 3

    public $Audience;

    // Step 4

    public $Name;
    public $Category_ID;
    public $Start;
    public $End;
    public $AppropriateAges;

    // Additional elements
    public $tags;
    public $imageFiles;
    public $locationAddress;
    public $locationCity;
    public $locationState;
    public $locationZip;

    // Step 5

    public $Price;
    public $Offering;
    public $Description;
    public $FinePrint;

    // Step 6

    public $sessions;

    // Other

    // Resulting saved experience
    public $experience;

    // Request this was created from, if any
    public $fromRequest_ID;

    public function rules()
    {
        return array(
            array('PosterType', 'required', 'on' => 'step1'),
            array('Type', 'required', 'on' => 'step2'),
            array('Audience', 'required', 'on' => 'step3'),
            array('Name, Category_ID, Start, End, locationAddress, locationCity, locationState, locationZip', 'required', 'on' => 'step4'),
            array('Price, Offering, Description', 'required', 'on' => 'step5'),
        );
    }

    private function getLocation()
    {
        $location = new Location;

        $location->Address = $this->locationStreet;
        $location->City = $this->locationCity;
        $location->State = $this->locationState;
        $location->Zip = $this->locationZip;

        $result = Location::model()->findExisting($location);
        if ($result == null)
        {
            $location->save();
            $result = $location;
        }

        return $result;
    }

    public function save()
    {
        $isSaved = false;

        $this->experience = new Experience;

        $transaction = $this->experience->dbConnection->beginTransaction();

        try
        {
            $this->experience->attributes = get_object_vars($this);

            $location = $this->getLocation();
            $this->experience->Location_ID = $location->Location_ID;

            $this->experience->save();

            if ($this->imageFiles != null)
            {
                foreach($this->imageFiles as $imageFile)
                {
                    $content = Content::AddContent($imageFile, 'Class Image', ContentType::ImageID);

                    $classToContent = new ExperienceToContent;
                    $classToContent->Experience_ID = $this->experience->Experience_ID;
                    $classToContent->Content_ID = $content->Content_ID;
                    $classToContent->save();
                }
            }

            if (isset($this->fromRequest_ID) && is_numeric($this->fromRequest_ID))
            {
                $request = Request::model()->findByPk($this->fromRequest_ID);

                if ($request != null)
                {
                    $request->Created_Experience_ID = $this->experience->Experience_ID;

                    $request->save();

                    // Notify the students
                    foreach ($request->requestors as $user)
                    {
                        if ($user->User_ID != $this->experience->Create_User_ID)
                        {
                            $userName = CHtml::link($this->experience->createUser->fullName, array('user/view', 'id' => $this->experience->createUser->User_ID));
                            $requestName = CHtml::link($request->Name, array('request/view', 'id' => $request->Request_ID));
                            $className = CHtml::link($this->experience->Name, array('experience/view', 'id' => $this->experience->Experience_ID));

                            Message::SendNotification($user->User_ID, "{$userName} has picked up the request \"{$requestName}\" and created the class \"{$className}\".");
                        }
                    }
                }
            }

            $tagsArray = Tag::model()->string2array($this->tags);
            foreach ($tagsArray as $tagName)
            {
                $tag = Tag::model()->findOrCreate($tagName);

                $classToTag = new ClassToTag;
                $classToTag->Experience_ID = $this->experience->Experience_ID;
                $classToTag->Tag_ID = $tag->Tag_ID;
                $classToTag->save();
            }

            $sessionData = json_decode($this->sessions);

            foreach ($sessionData as $sessionItem)
            {
                $session = new Session;
                $session->Experience_ID = $this->experience->Experience_ID;
                $session->Start = $sessionItem->Start;
                $session->End = $sessionItem->End;
                $session->save();
            }

            $transaction->commit();
            $isSaved = true;
        }
        catch (Exception $e)
        {
            $transaction->rollback();
        }

        return $isSaved;
    }
}