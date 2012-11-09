<?php
/* @var $this ClassController */
/* @var $model KClass */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Class_ID'); ?>
		<?php echo $form->textField($model,'Class_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Course_ID'); ?>
		<?php echo $form->textField($model,'Course_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Type'); ?>
		<?php echo $form->textField($model,'Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Start'); ?>
		<?php echo $form->textField($model,'Start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'End'); ?>
		<?php echo $form->textField($model,'End'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Min_occupancy'); ?>
		<?php echo $form->textField($model,'Min_occupancy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Max_occupancy'); ?>
		<?php echo $form->textField($model,'Max_occupancy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Location_ID'); ?>
		<?php echo $form->textField($model,'Location_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Created'); ?>
		<?php echo $form->textField($model,'Created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Updated'); ?>
		<?php echo $form->textField($model,'Updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->