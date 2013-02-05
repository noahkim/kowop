<?php

Yii::import('ext.iwi.Iwi');

class ExperienceCreateForm extends CFormModel
{
    // Step 1

    public $PosterType;

    // Step 2

    public $ExperienceType;

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
    public $locationStreet;
    public $locationCity;
    public $locationState;
    public $locationZip;

    // Step 5

    public $Price;
    public $Offering;
    public $Description;
    public $FinePrint;
    public $MaxPerPerson;
    public $MultipleAllowed;

    // Additional elements

    public $free;

    // Step 6

    public $sessions;
    public $Min_occupancy;
    public $Max_occupancy;

    // Other

    // Resulting saved experience
    public $experience;

    // Request this was created from, if any
    public $fromRequest_ID;

    public function rules()
    {
        return array(array('PosterType', 'required', 'on' => 'step1'),
                     array('ExperienceType', 'required', 'on' => 'step2'),
                     array('Audience', 'required', 'on' => 'step3'),
                     array('Name, Category_ID, Start, End, locationStreet, locationCity, locationState, locationZip',
                           'required', 'on' => 'step4'),
                     array('Offering, Description', 'required', 'on' => 'step5'),
                     array('PosterType,ExperienceType,Audience,Name,Category_ID,Start,End,AppropriateAges,tags,imageFiles,locationStreet,locationCity,locationState,locationZip,Price,Offering,Description,FinePrint,free,sessions,Min_occupancy,Max_occupancy,experience,fromRequest_ID,MaxPerPerson,MultipleAllowed',
                           'safe'),);
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
        $isSaved = null;

        try
        {
            $experience = new Experience;
            $transaction = $experience->dbConnection->beginTransaction();

            if (isset($this->free) && ($this->free === true))
            {
                unset($this->Price);
            }

            $experience->Name = $this->Name;
            $experience->PosterType = $this->PosterType;
            $experience->ExperienceType = $this->ExperienceType;
            $experience->Audience = $this->Audience;
            $experience->Category_ID = $this->Category_ID;
            $experience->Start = $this->Start;
            $experience->End = $this->End;
            $experience->Description = $this->Description;
            $experience->Offering = $this->Offering;
            $experience->FinePrint = $this->FinePrint;
            $experience->Price = $this->Price;
            $experience->Min_occupancy = $this->Min_occupancy;
            $experience->Max_occupancy = $this->Max_occupancy;
            $experience->MaxPerPerson = $this->MaxPerPerson;
            $experience->MultipleAllowed = $this->MultipleAllowed;

            $appropriateAges = 0;
            if (isset($this->AppropriateAges) && is_array($this->AppropriateAges))
            {
                foreach ($this->AppropriateAges as $age)
                {
                    $appropriateAges += $age;
                }
            }
            $experience->AppropriateAges = $appropriateAges;

            $location = $this->getLocation();
            $experience->Location_ID = $location->Location_ID;

            $experience->save();

            $this->experience = $experience;

            if ($this->imageFiles != null)
            {
                foreach ($this->imageFiles as $imageFile)
                {
                    $content = Content::AddContent($imageFile, 'Class Image', ContentType::ImageID);

                    $experienceToContent = new ExperienceToContent;
                    $experienceToContent->Experience_ID = $this->experience->Experience_ID;
                    $experienceToContent->Content_ID = $content->Content_ID;
                    $experienceToContent->save();
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
                            $userName = CHtml::link($this->experience->createUser->fullName, array('//user/view',
                                                                                                   'id' => $this->experience->createUser->User_ID));
                            $requestName = CHtml::link($request->Name,
                                                       array('//request/view', 'id' => $request->Request_ID));
                            $experienceName = CHtml::link($this->experience->Name, array('//experience/view',
                                                                                    'id' => $this->experience->Experience_ID));

                            Message::SendNotification($user->User_ID,
                                                      "{$userName} has picked up the request \"{$requestName}\" and created the experience \"{$experienceName}\".");
                        }
                    }
                }
            }

            $tagsArray = Tag::model()->string2array($this->tags);
            foreach ($tagsArray as $tagName)
            {
                $tag = Tag::model()->findOrCreate($tagName);

                $experienceToTag = new ExperienceToTag;
                $experienceToTag->Experience_ID = $this->experience->Experience_ID;
                $experienceToTag->Tag_ID = $tag->Tag_ID;
                $experienceToTag->save();
            }

            if (isset($this->sessions) && strlen($this->sessions) > 0)
            {
                $sessionData = json_decode($this->sessions);

                foreach ($sessionData as $sessionItem)
                {
                    $session = new Session;
                    $session->Experience_ID = $this->experience->Experience_ID;
                    $session->Start = $sessionItem->Start;
                    $session->End = $sessionItem->End;
                    $session->save();
                }
            }

            $transaction->commit();
            $isSaved = true;
        }
        catch (Exception $e)
        {
            $isSaved = false;

            $transaction->rollback();
        }

        return $isSaved;
    }
}
