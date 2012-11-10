<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h1>

<div>
    <?php
    if(isset($searchModel))
    {
        echo $this->renderPartial('_searchForm', array('searchModel' => $searchModel));
    }
    ?>
</div>

<?php

if (!Yii::app()->user->isGuest)
{
    echo CHtml::link('User profile', array('/user/update', 'id' => Yii::app()->user->id)) . '<br />';

    echo CHtml::link('Create class', array('/class/create')) . '<br />';
    echo CHtml::link('Create request', array('/request/create')) . '<br />';
}
?>