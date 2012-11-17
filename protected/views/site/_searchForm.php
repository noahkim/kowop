<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    'action'=>Yii::app()->createUrl('/class/search'),
    'enableAjaxValidation' => false,
    'method' => 'get'
)); ?>

<?php echo $form->textField($searchModel, 'keywords'); ?>

<?php echo CHtml::submitButton('Search'); ?>

<?php $this->endWidget(); ?>