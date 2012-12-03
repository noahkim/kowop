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
    public $classType;
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

    // Step 3
    public $sessions;

    // Models used
    private $location;
    public $class;

    // Other
    public $fromRequest_ID;

    public function rules()
    {
        return array(
            array('name, category', 'required', 'on' => 'step1'),
            array('start, end, minOccupancy, maxOccupancy, numLessons, tuition, locationType, description', 'required', 'on' => 'step2'),
            array('category, numLessons, classType, minOccupancy, maxOccupancy', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('prerequisites, materials', 'length', 'max' => 1000),
            array('name,description,category,tags,imageURL,imageFile,videoURL,videoFile,start,end,numLessons,classType,minOccupancy,maxOccupancy,locationName,locationStreet,locationCity,locationState,locationZip,locationDescription,locationType,prerequisites,materials,tuition,sessions,fromRequest_ID', 'safe'),
        );
    }

    private function getLocation()
    {
        if ($this->locationName == null)
        {
            return null;
        }

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
            $this->class->Type = $this->classType ? $this->classType : ClassType::Online;
            $this->class->Min_occupancy = $this->minOccupancy;
            $this->class->Max_occupancy = $this->maxOccupancy;
            $this->class->Prerequisites = $this->prerequisites;
            $this->class->Materials = $this->materials;
            $this->class->Tuition = $this->tuition;

            $this->location = $this->getLocation();

            if ($this->location != null)
            {
                $this->class->Location_ID = $this->location->Location_ID;
            }

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
                $content = new Content;
                $content->Content_name = 'Class Image';
                $content->Content_type = ContentType::ImageID;

                $content->save();
                $content->refresh();

                $path = Yii::app()->params['uploads'] . '/' . $content->Content_ID;
                $link = Yii::app()->params['siteBase'] . '/uploads/' . $content->Content_ID;

                $pathParts = pathinfo($this->imageFile);
                $path .= '.' . $pathParts['extension'];
                $link .= '.' . $pathParts['extension'];

                rename(Yii::app()->params['temp'] . '/' . $this->imageFile, $path);

                $image = new Iwi($path);

                $sourceRatio = $image->width / $image->height;
                $targetRatio = 4 / 3;

                if ($sourceRatio > $targetRatio)
                {
                    $height = $image->height;
                    $width = (int)$height * $targetRatio;
                }
                elseif ($sourceRatio < $targetRatio)
                {
                    $width = $image->width;
                    $height = (int)$width / $targetRatio;
                }

                $image->adaptive($width, $height);
                $image->save();

                $content->Link = $link;
                $content->save();

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

            foreach ($sessionData->sessions as $i => $item)
            {
                $session = new Session;
                $session->Class_ID = $this->class->Class_ID;
                $session->save();

                foreach($item as $j => $lessonItem)
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
            print_r($e);
        }

        return $isSaved;
    }
}