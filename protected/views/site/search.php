<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div>
Search Results
</div>

<?php
foreach ($results as $item)
{
    echo $item->Name . '<br />';
}
?>