<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h1>

<?php

if (!Yii::app()->user->isGuest)
{
    echo CHtml::link('Create class', array('/class/create')) . '<br />';
    echo CHtml::link('Create request', array('/request/create')) . '<br />';
}
?>