<?php

class ExperienceSearchForm extends CFormModel
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
    public $location;

    public $page;
    public $totalResults;
    public $totalPages;

    public function rules()
    {
        return array(
            array('keywords, category, seatsInNextClass, minTuition, maxTuition, nextClassStartsBy, daysOfWeek, categories, includedResults, location, page', 'safe'),
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

            $classCriteria->addInCondition('t.Experience_ID', $classes);
            $requestCriteria->addInCondition('t.Request_ID', $requests);
        }
        else
        {
            foreach ($keywords as $keyword)
            {
                $requestCriteria->compare('t.Name', $keyword, true, 'OR');
                $requestCriteria->compare('t.Description', $keyword, true, 'OR');
                $requestCriteria->compare('category.Name', $keyword, true, 'OR');
                $requestCriteria->compare('tags.Name', $keyword, true, 'OR');
                $requestCriteria->compare('createUser.First_name', $keyword, true, 'OR');
                $requestCriteria->compare('createUser.Last_name', $keyword, true, 'OR');
                $requestCriteria->compare('createUser.Teacher_alias', $keyword, true, 'OR');

                $classCriteria->compare('t.Name', $keyword, true, 'OR');
                $classCriteria->compare('t.Description', $keyword, true, 'OR');
                $classCriteria->compare('category.Name', $keyword, true, 'OR');
                $classCriteria->compare('tags.Name', $keyword, true, 'OR');
                $classCriteria->compare('createUser.First_name', $keyword, true, 'OR');
                $classCriteria->compare('createUser.Last_name', $keyword, true, 'OR');
                $classCriteria->compare('createUser.Teacher_alias', $keyword, true, 'OR');
            }
        }

        $requestCriteria->addCondition('t.Created_Experience_ID is NULL');

        //$requestCriteria->compare('t.Status', '');
        $classCriteria->compare('t.Status', ExperienceStatus::Active);

        if (isset($this->category) && is_numeric($this->category) && ($this->category > 0))
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
            $classCriteria->compare('t.Start', '<=' . date('Y-m-d', strtotime($this->nextClassStartsBy)));
        }

        $classes = Experience::model()->findAll($classCriteria);

        if (($this->seatsInNextClass != null) && ($this->seatsInNextClass > 1))
        {
            foreach ($classes as $i => $class)
            {
                $enrolled = count($class->enrolled);

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

        $requests = Request::model()->findAll($requestCriteria);

        foreach ($requests as $i => $request)
        {
            if (count($request->requestors) == 0)
            {
                unset($requests[$i]);
            }
        }

        if (isset($this->location) && strlen($this->location) > 0)
        {
            foreach ($classes as $i => $class)
            {
                if (!stristr($class->location->fullAddress, $this->location))
                {
                    unset($classes[$i]);
                }
            }

            foreach ($requests as $i => $request)
            {
                if ($request->Zip != $this->location)
                {
                    unset($requests[$i]);
                }
            }
        }

        $classes = array_values($classes);
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
                    $score += ExperienceSearchForm::NameValue;
                }

                if (stristr($item->Description, $keyword))
                {
                    $score += ExperienceSearchForm::NameValue;
                }

                if (stristr($item->category->Name, $keyword))
                {
                    $score += ExperienceSearchForm::CategoryValue;
                }

                if (stristr($item->tagstring, $keyword))
                {
                    $score += ExperienceSearchForm::TagValue;
                }

                if (($item instanceof Experience) && ($item->location != null) && (!$locationFound))
                {
                    if (stristr($item->location->fulladdress, $keyword))
                    {
                        $score *= ExperienceSearchForm::LocationMultiplier;
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
        $this->totalPages = ceil($this->totalResults / ExperienceSearchForm::PageSize);

        if (!isset($this->page))
        {
            $this->page = 1;
        }

        $offset = (($this->page - 1) * ExperienceSearchForm::PageSize);
        $sortedItems = array_slice($sortedItems, $offset, ExperienceSearchForm::PageSize);

        return $sortedItems;
    }

    public static $seatsInNextClassLookup = array(
        1 => "Doesn't matter",
        2 => 'Empty',
        3 => 'At least 1 filled',
        4 => 'Almost full'
    );
}
