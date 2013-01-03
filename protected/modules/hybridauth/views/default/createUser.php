<div class="form">
	<h1>Choose a username and an email address</h1>

	<?php
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'create-user-form',
			'enableAjaxValidation'=>false,
		));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($user); ?>

	<div class="row">
		<?php echo $form->labelEx($user,'Email'); ?>
		<?php echo $form->textField($user,'Email'); ?>
		<?php echo $form->error($user,'Email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->