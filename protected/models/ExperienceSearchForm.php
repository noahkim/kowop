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
    public $minTuition;
    public $maxTuition;
    public $daysOfWeek;
    public $categories;
    public $includedResults;
    public $location;
    public $start;
    public $end;

    public $page;
    public $totalResults;
    public $totalPages;

    public function rules()
    {
        return array(array('keywords, category, minTuition, maxTuition, daysOfWeek, categories, includedResults, location, start, end, page',
                           'safe'),);
    }

    public function attributeLabels()
    {
        return array('keywords' => 'keywords');
    }

    public function search()
    {
        $requestCriteria = new CDbCriteria;
        $experienceCriteria = new CDbCriteria;

        $requestCriteria->with = array('category', 'tags', 'createUser');
        $experienceCriteria->with = array('location', 'category', 'tags', 'createUser');

        $keywords = explode(' ', $this->keywords);

        if (isset($this->includedResults))
        {
            $included = json_decode($this->includedResults);

            $experiences = array();
            $requests = array();

            foreach ($included as $item)
            {
                if ($item->type == 'experience')
                {
                    $experiences[] = $item->id;
                }
                else
                {
                    $requests[] = $item->id;
                }
            }

            $experienceCriteria->addInCondition('t.Experience_ID', $experiences);
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
                $requestCriteria->compare('createUser.DisplayName', $keyword, true, 'OR');

                $experienceCriteria->compare('t.Name', $keyword, true, 'OR');
                $experienceCriteria->compare('t.Description', $keyword, true, 'OR');
                $experienceCriteria->compare('category.Name', $keyword, true, 'OR');
                $experienceCriteria->compare('tags.Name', $keyword, true, 'OR');
                $experienceCriteria->compare('createUser.First_name', $keyword, true, 'OR');
                $experienceCriteria->compare('createUser.Last_name', $keyword, true, 'OR');
                $experienceCriteria->compare('createUser.DisplayName', $keyword, true, 'OR');
            }
        }

        $requestCriteria->addCondition('t.Created_Experience_ID is NULL');

        //$requestCriteria->compare('t.Status', '');
        $experienceCriteria->compare('t.Status', ExperienceStatus::Active);

        if (isset($this->category) && is_numeric($this->category) && ($this->category > 0))
        {
            $requestCriteria->compare('t.Category_ID', $this->category);
            $experienceCriteria->compare('t.Category_ID', $this->category);
        }

        if (($this->minTuition != null) && ($this->minTuition > 0))
        {
            $experienceCriteria->compare('t.Tuition', '>=' . $this->minTuition);
        }
        if (($this->maxTuition != null) && ($this->maxTuition > 0))
        {
            $experienceCriteria->compare('t.Tuition', '<=' . $this->maxTuition);
        }

        if (($this->start != null) && (strlen($this->start) > 0))
        {
            $experienceCriteria->compare('t.Start', '<=' . date('Y-m-d', strtotime($this->start)));
        }

        if (($this->end != null) && (strlen($this->end) > 0))
        {
            $experienceCriteria->compare('t.End', '<=' . date('Y-m-d', strtotime($this->end)));
        }

        $experiences = Experience::model()->findAll($experienceCriteria);

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
            foreach ($experiences as $i => $experience)
            {
                if (!stristr($experience->location->fullAddress, $this->location))
                {
                    unset($experiences[$i]);
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

        $experiences = array_values($experiences);
        $items = array_merge($experiences, $requests);

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
}
