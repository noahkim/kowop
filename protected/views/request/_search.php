<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Request_ID'); ?>
		<?php echo $form->textField($model,'Request_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Create_User_ID'); ?>
		<?php echo $form->textField($model,'Create_User_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Type'); ?>
		<?php echo $form->textField($model,'Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Cost'); ?>
		<?php echo $form->textField($model,'Cost',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MinimumRating'); ?>
		<?php echo $form->textField($model,'MinimumRating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Created_Class_ID'); ?>
		<?php echo $form->textField($model,'Created_Class_ID'); ?>
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