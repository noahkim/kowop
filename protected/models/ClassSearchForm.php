<?php

class ClassSearchForm extends CFormModel
{
    const NameValue = 4;
    const TagValue = 3;
    const CategoryValue = 2;
    const LocationMultiplier = 10;

    const PageSize = 9;

    public $keywords;
    public $category;

    // Filters
    public $seatsInNextClass;
    public $minTuition;
    public $maxTuition;
    public $nextClassStartsBy;
    public $daysOfWeek;
    public $categories;
    public $includedResults;

    public $page;
    public $totalResults;
    public $totalPages;

    public function rules()
    {
        return array(
            array('keywords, category, seatsInNextClass, minTuition, maxTuition, nextClassStartsBy, daysOfWeek, categories, includedResults, page', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'keywords' => 'keywords'
        );
    }

    public function search()
    {
        $requestCriteria = new CDbCriteria;
        $classCriteria = new CDbCriteria;

        $requestCriteria->with = array('category', 'tags', 'createUser');
        $classCriteria->with = array('location', 'category', 'tags', 'createUser');

        $keywords = explode(' ', $this->keywords);

        if (isset($this->includedResults))
        {
            $included = json_decode($this->includedResults);

            $classes = array();
            $requests = array();

            foreach ($included as $item)
            {
                if ($item->type == 'class')
                {
                    $classes[] = $item->id;
                }
                else
                {
                    $requests[] = $item->id;
                }
            }

            $classCriteria->addInCondition('t.Class_ID', $classes);
            $requestCriteria->addInCondition('t.Request_ID', $requests);
        }
        else
        {
            foreach ($keywords as $keyword)
            {
                $requestCriteria->compare('t.Name', $keyword, true, 'OR');
                $requestCriteria->compare('t.Description', $keyword, true, 'OR');
                $requestCriteria->compare('t.Zip', $keyword, true, 'OR');
                $requestCriteria->compare('category.Name', $keyword, true, 'OR');
                $requestCriteria->compare('tags.Name', $keyword, true, 'OR');
                $requestCriteria->compare('createUser.First_name', $keyword, true, 'OR');
                $requestCriteria->compare('createUser.Last_name', $keyword, true, 'OR');
                $requestCriteria->compare('createUser.Teacher_alias', $keyword, true, 'OR');

                $classCriteria->compare('t.Name', $keyword, true, 'OR');
                $classCriteria->compare('t.Description', $keyword, true, 'OR');
                $classCriteria->compare('location.Name', $keyword, true, 'OR');
                $classCriteria->compare('location.Address', $keyword, true, 'OR');
                $classCriteria->compare('location.City', $keyword, true, 'OR');
                $classCriteria->compare('location.State', $keyword, true, 'OR');
                $classCriteria->compare('location.Zip', $keyword, true, 'OR');
                $classCriteria->compare('category.Name', $keyword, true, 'OR');
                $classCriteria->compare('tags.Name', $keyword, true, 'OR');
                $classCriteria->compare('createUser.First_name', $keyword, true, 'OR');
                $classCriteria->compare('createUser.Last_name', $keyword, true, 'OR');
                $classCriteria->compare('createUser.Teacher_alias', $keyword, true, 'OR');
            }
        }

        $requestCriteria->addCondition('t.Created_Class_ID is NULL');

        //$requestCriteria->compare('t.Status', '');
        $classCriteria->compare('t.Status', ClassStatus::Active);

        if (isset($this->category) && is_numeric($this->category))
        {
            $requestCriteria->compare('t.Category_ID', $this->category);
            $classCriteria->compare('t.Category_ID', $this->category);
        }

        if (($this->minTuition != null) && ($this->minTuition > 0))
        {
            $classCriteria->compare('t.Tuition', '>=' . $this->minTuition);
        }
        if (($this->maxTuition != null) && ($this->maxTuition > 0))
        {
            $classCriteria->compare('t.Tuition', '<=' . $this->maxTuition);
        }
        if (($this->nextClassStartsBy != null) && (strlen($this->nextClassStartsBy) > 0))
        {
            $classCriteria->compare('t.Start', '<=' . $this->nextClassStartsBy);
        }

        $classes = KClass::model()->findAll($classCriteria);
        if (($this->seatsInNextClass != null) && ($this->seatsInNextClass > 1))
        {
            foreach ($classes as $i => $class)
            {
                $enrolled = count($class->students);

                switch ($this->seatsInNextClass)
                {
                    case 2:
                        if ($enrolled > 0)
                        {
                            unset($classes[$i]);
                        }
                        break;
                    case 3:
                        if ($enrolled < 1)
                        {
                            unset($classes[$i]);
                        }
                        break;
                    case 4:
                        $pctFull = $enrolled / $class->Max_occupancy;
                        if ($pctFull < 0.75)
                        {
                            unset($classes[$i]);
                        }
                        break;
                }
            }
        }

        $classes = array_values($classes);

        $requests = Request::model()->findAll($requestCriteria);
        foreach ($requests as $i => $request)
        {
            if (count($request->requestors) == 0)
            {
                unset($requests[$i]);
            }
        }

        $items = array_merge($classes, $requests);

        $scores = array();
        foreach ($items as $item)
        {
            $score = 1;
            $locationFound = false;

            foreach ($keywords as $keyword)
            {
                if (strlen($keyword) == 0)
                {
                    continue;
                }

                if (stristr($item->Name, $keyword))
                {
                    $score += ClassSearchForm::NameValue;
                }

                if (stristr($item->Description, $keyword))
                {
                    $score += ClassSearchForm::NameValue;
                }

                if (stristr($item->category->Name, $keyword))
                {
                    $score += ClassSearchForm::CategoryValue;
                }

                if (stristr($item->tagstring, $keyword))
                {
                    $score += ClassSearchForm::TagValue;
                }

                if (($item instanceof KClass) && ($item->location != null) && (!$locationFound))
                {
                    if (stristr($item->location->fulladdress, $keyword))
                    {
                        $score *= ClassSearchForm::LocationMultiplier;
                        $locationFound = true;
                    }
                }
            }

            array_push($scores, $score);
        }

        arsort($scores);

        $sortedItems = array();
        foreach ($scores as $i => $score)
        {
            $sortedItems[] = $items[$i];
        }

        $this->totalResults = count($sortedItems);
        $this->totalPages = ceil($this->totalResults / ClassSearchForm::PageSize);

        if(! isset($this->page))
        {
            $this->page = 1;
        }

        $offset = (($this->page - 1) * ClassSearchForm::PageSize);
        $sortedItems = array_slice($sortedItems, $offset, ClassSearchForm::PageSize);

        return $sortedItems;
    }

    public static $seatsInNextClassLookup = array(
        1 => "Doesn't matter",
        2 => 'Empty',
        3 => 'At least 1 filled',
        4 => 'Almost full'
    );
}
