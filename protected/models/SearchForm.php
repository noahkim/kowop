<?php

class SearchForm extends CFormModel
{
    const NameValue = 4;
    const TagValue = 3;
    const CategoryValue = 2;
    const LocationMultiplier = 10;

    public $keywords;

    public function rules()
    {
        return array(
            array('keywords', 'safe'),
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
        $criteria = new CDbCriteria;
        $criteria->with = array('location', 'category', 'tags');

        $keywords = explode(' ', $this->keywords);
        foreach($keywords as $keyword)
        {
            $criteria->compare('t.Name', $keyword, true, 'OR');
            $criteria->compare('t.Description', $keyword, true, 'OR');
            $criteria->compare('location.Name', $keyword, true, 'OR');
            $criteria->compare('location.Address', $keyword, true, 'OR');
            $criteria->compare('location.City', $keyword, true, 'OR');
            $criteria->compare('location.State', $keyword, true, 'OR');
            $criteria->compare('location.Zip', $keyword, true, 'OR');
            $criteria->compare('category.Name', $keyword, true, 'OR');
            $criteria->compare('tags.Name', $keyword, true, 'OR');
        }

        $classes = KClass::model()->findAll($criteria);
        $requests = Request::model()->findAll($criteria);

        $items = array_merge($classes, $requests);

        $scores = array();
        foreach($items as $item)
        {
            $score = 1;
            $locationFound = false;

            foreach($keywords as $keyword)
            {
                if(strlen($keyword) == 0)
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

                if(($item->location != null) && (! $locationFound))
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
        foreach($scores as $i => $score)
        {
            $sortedItems[] = $items[$i];
        }

        return $sortedItems;
    }
}
