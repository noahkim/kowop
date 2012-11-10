<?php

class SearchForm extends CFormModel
{
    const NameValue = 4;
    const TagValue = 3;
    const CategoryValue = 2;

    public $keywords;
    public $location;

    public function rules()
    {
        return array(
            array('keywords, location', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'keywords' => 'keywords',
            'location' => 'location',
        );
    }

    public function getResults()
    {
        if(! isset($this->location))
        {
            $items = $this->getLocationResults();
        }
        else
        {
            $classes = KClass::model()->findAll();
            $requests = Request::model()->findAll();

            $items = array_merge($classes, $requests);
        }

        $keywords = explode(' ', $this->keywords);

        $scores = array();
        foreach ($items as $item)
        {
            $score = 0;

            foreach ($keywords as $keyword)
            {
                if(strlen($keyword) == 0)
                {
                    continue;
                }

                $needle = strtolower($keyword);

                if (strstr(strtolower($item->Name), $needle))
                {
                    $score += SearchForm::NameValue;
                }

                if ($item instanceof KClass)
                {
                    $tagMappings = ClassToTag::model()->findAll('Class_ID=:Class_ID', array(':Class_ID' => $item->Class_ID));
                    foreach ($tagMappings as $tagMapping)
                    {
                        if (strstr(strtolower($tagMapping->tag->Name), $needle))
                        {
                            $score += SearchForm::TagValue;
                        }
                    }
                }
                elseif ($item instanceof Request)
                {
                    $tagMappings = RequestToTag::model()->findAll('Request_ID=:Request_ID', array(':Request_ID' => $item->Request_ID));
                    foreach ($tagMappings as $tagMapping)
                    {
                        if (strstr(strtolower($tagMapping->tag->Name), $needle))
                        {
                            $score += SearchForm::TagValue;
                        }
                    }
                }
            }

            array_push($scores, $score);
        }

        arsort($scores);

        $sortedItems = array();
        foreach($scores as $i => $score)
        {
            $sortedItems[] = $items[$i];
        }

        return $sortedItems;
    }

    public function getLocationResults()
    {
        $locations = array();

        if (isset($this->location))
        {
            if (is_numeric($this->location))
            {
                $locations = Location::model()->with('kClasses', 'requests')->findAll('Zip=:Zip', array(':Zip' => $this->location));
            }
            else
            {
                $parts = explode(',', $this->location);
                $city = trim($parts[0]);
                if (count($parts) > 1)
                {
                    $state = strtoupper(trim($parts[1]));
                }

                $criteria['City'] = $city;
                if (isset($state))
                {
                    $criteria['State'] = $state;
                }

                $locations = Location::model()->with('kClasses', 'requests')->findAllByAttributes($criteria);
            }
        }

        $items = array();

        foreach ($locations as $location)
        {
            if (isset($location->requests))
            {
                $requests = $location->requests;
                if (count($requests) > 0)
                {
                    $items = array_merge($items, $requests);
                }
            }

            if (isset($location->kClasses))
            {
                $classes = $location->kClasses;
                if (count($classes) > 0)
                {
                    $items = array_merge($items, $classes);
                }
            }
        }

        return $items;
    }
}
