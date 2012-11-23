<?php

class SearchForm extends CFormModel
{
    const NameValue = 4;
    const TagValue = 3;
    const CategoryValue = 2;
    const LocationMultiplier = 10;

    public $keywords;
    public $category;

    // Filters
    public $seatsInNextClass;
    public $minTuition;
    public $maxTuition;
    public $nextClassStartsBy;
    public $classType;
    public $daysOfWeek;
    public $categories;

    public function rules()
    {
        return array(
            array('keywords, category, seatsInNextClass, minTuition, maxTuition, nextClassStartsBy, classType, daysOfWeek, categories', 'safe'),
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

        $requestCriteria->with = array('location', 'category', 'tags');
        $classCriteria->with = array('location', 'category', 'tags');

        $keywords = explode(' ', $this->keywords);
        foreach ($keywords as $keyword)
        {
            $requestCriteria->compare('t.Name', $keyword, true, 'OR');
            $requestCriteria->compare('t.Description', $keyword, true, 'OR');
            $requestCriteria->compare('location.Name', $keyword, true, 'OR');
            $requestCriteria->compare('location.Address', $keyword, true, 'OR');
            $requestCriteria->compare('location.City', $keyword, true, 'OR');
            $requestCriteria->compare('location.State', $keyword, true, 'OR');
            $requestCriteria->compare('location.Zip', $keyword, true, 'OR');
            $requestCriteria->compare('category.Name', $keyword, true, 'OR');
            $requestCriteria->compare('tags.Name', $keyword, true, 'OR');

            $classCriteria->compare('t.Name', $keyword, true, 'OR');
            $classCriteria->compare('t.Description', $keyword, true, 'OR');
            $classCriteria->compare('location.Name', $keyword, true, 'OR');
            $classCriteria->compare('location.Address', $keyword, true, 'OR');
            $classCriteria->compare('location.City', $keyword, true, 'OR');
            $classCriteria->compare('location.State', $keyword, true, 'OR');
            $classCriteria->compare('location.Zip', $keyword, true, 'OR');
            $classCriteria->compare('category.Name', $keyword, true, 'OR');
            $classCriteria->compare('tags.Name', $keyword, true, 'OR');
        }

        if(isset($this->category) && is_numeric($this->category))
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
        if (($this->classType != null) && ($this->classType > 0))
        {
            $classCriteria->compare('t.Type', $this->classType);
        }

        $classes = KClass::model()->findAll($classCriteria);
        if (($this->seatsInNextClass != null) && ($this->seatsInNextClass > 1))
        {
            foreach ($classes as $i => $class)
            {
                $enrolled = count($class->userToClasses);

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
                    $score += SearchForm::NameValue;
                }

                if (stristr($item->Description, $keyword))
                {
                    $score += SearchForm::NameValue;
                }

                if (stristr($item->category->Name, $keyword))
                {
                    $score += SearchForm::CategoryValue;
                }

                if (stristr($item->tagstring, $keyword))
                {
                    $score += SearchForm::TagValue;
                }

                if (($item->location != null) && (!$locationFound))
                {
                    if (stristr($item->location->fulladdress, $keyword))
                    {
                        $score *= SearchForm::LocationMultiplier;
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

        return $sortedItems;
    }

    public static $seatsInNextClassLookup = array(
        1 => "don't care",
        2 => 'empty',
        3 => 'at least 1 enrolled',
        4 => 'almost full!'
    );
}
