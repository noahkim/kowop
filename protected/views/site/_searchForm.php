<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    'action'=>Yii::app()->createUrl('/site/search'),
    'enableAjaxValidation' => false,
)); ?>

<?php echo $form->errorSummary(array($searchModel)); ?>

<?php echo $form->textField($searchModel, 'keywords'); ?>
<?php echo $form->textField($searchModel, 'location'); ?>

<?php echo CHtml::submitButton('Search'); ?>

<?php $this->endWidget(); ?>