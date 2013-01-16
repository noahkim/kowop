<?php

Yii::import('ext.iwi.Iwi');

class ClassCreateForm extends CFormModel
{
    // Step 1
    public $name;
    public $description;
    public $category;
    public $tags;
    public $imageURL;
    public $imageFile;
    public $videoURL;
    public $videoFile;
    public $start;
    public $end;
    public $numLessons;
    public $minOccupancy;
    public $maxOccupancy;

    // Location
    public $locationName;
    public $locationStreet;
    public $locationCity;
    public $locationState;
    public $locationZip;
    public $locationDescription;
    public $locationType;

    // Step 2
    public $prerequisites;
    public $materials;
    public $tuition;
    public $lessonDuration;

    // Step 3
    public $sessions;

    // Models used
    private $location;
    public $class;
    public $user;

    // Other
    public $fromRequest_ID;

    public function rules()
    {
        return array(
            array('name, category', 'required', 'on' => 'step1'),
            array('start, end, minOccupancy, maxOccupancy, numLessons, tuition, lessonDuration, description, locationType, locationStreet, locationCity, locationState, locationZip', 'required', 'on' => 'step2'),
            array('category, numLessons, classType, minOccupancy, maxOccupancy', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('prerequisites, materials', 'length', 'max' => 1000),
            array('name,description,category,tags,imageURL,imageFile,videoURL,videoFile,start,end,numLessons,minOccupancy,maxOccupancy,locationName,locationStreet,locationCity,locationState,locationZip,locationDescription,locationType,prerequisites,materials,tuition,lessonDuration,sessions,fromRequest_ID', 'safe'),
        );
    }

    private function getLocation()
    {
        $location = new Location;
        $location->Name = $this->locationName;
        $location->Address = $this->locationStreet;
        $location->City = $this->locationCity;
        $location->State = $this->locationState;
        $location->Zip = $this->locationZip;
        $location->Type = $this->locationType;

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

        $this->class = new KClass;
        $transaction = $this->class->dbConnection->beginTransaction();

        try
        {
            $this->class->Name = $this->name;
            $this->class->Description = $this->description;
            $this->class->Category_ID = $this->category;
            $this->class->Start = $this->start;
            $this->class->End = $this->end;
            $this->class->Min_occupancy = $this->minOccupancy;
            $this->class->Max_occupancy = $this->maxOccupancy;
            $this->class->Prerequisites = $this->prerequisites;
            $this->class->Materials = $this->materials;
            $this->class->Tuition = $this->tuition;
            $this->class->LessonDuration = $this->lessonDuration;

            $this->location = $this->getLocation();
            $this->class->Location_ID = $this->location->Location_ID;

            $this->class->save();

            if (strlen($this->imageURL) > 0)
            {
                $content = new Content;
                $content->Content_name = 'Class Image URL';
                $content->Content_type = ContentType::ImageURL;
                $content->Link = $this->imageURL;
                $content->save();

                $classToContent = new ClassToContent;
                $classToContent->Class_ID = $this->class->Class_ID;
                $classToContent->Content_ID = $content->Content_ID;
                $classToContent->save();
            }
            elseif ($this->imageFile != null)
            {
                $content = Content::AddContent($this->imageFile, 'Class Image', ContentType::ImageID);

                $classToContent = new ClassToContent;
                $classToContent->Class_ID = $this->class->Class_ID;
                $classToContent->Content_ID = $content->Content_ID;
                $classToContent->save();
            }

            if (isset($this->fromRequest_ID) && is_numeric($this->fromRequest_ID))
            {
                $request = Request::model()->findByPk($this->fromRequest_ID);

                if ($request != null)
                {
                    $request->Created_Class_ID = $this->class->Class_ID;

                    $request->save();

                    // Notify the students
                    foreach ($request->requestors as $student)
                    {
                        if ($student->User_ID != $this->class->Create_User_ID)
                        {
                            Message::SendNotification($student->User_ID, "{$this->class->createUser->fullName} has picked up the class request \"{$request->Name}\".");
                        }
                    }
                }
            }

            $tagsArray = Tag::model()->string2array($this->tags);
            foreach ($tagsArray as $tagName)
            {
                $tag = Tag::model()->findOrCreate($tagName);

                $classToTag = new ClassToTag;
                $classToTag->Class_ID = $this->class->Class_ID;
                $classToTag->Tag_ID = $tag->Tag_ID;
                $classToTag->save();
            }

            $sessionData = json_decode($this->sessions);

            foreach ($sessionData as $sessionItem)
            {
                $session = new Session;
                $session->Class_ID = $this->class->Class_ID;
                $session->save();

                foreach ($sessionItem->lessons as $lessonItem)
                {
                    $lesson = new Lesson;
                    $lesson->Session_ID = $session->Session_ID;
                    $lesson->Start = $lessonItem->start;
                    $lesson->End = $lessonItem->end;

                    $lesson->save();
                }
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