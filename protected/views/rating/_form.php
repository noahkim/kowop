<?php
/* @var $this RatingController */
/* @var $model Rating */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rating-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'User_ID'); ?>
		<?php echo $form->textField($model,'User_ID'); ?>
		<?php echo $form->error($model,'User_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Experience_ID'); ?>
		<?php echo $form->textField($model,'Experience_ID'); ?>
		<?php echo $form->error($model,'Experience_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Comment'); ?>
		<?php echo $form->textField($model,'Comment',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'Comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Reaction'); ?>
		<?php echo $form->textField($model,'Reaction'); ?>
		<?php echo $form->error($model,'Reaction'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->