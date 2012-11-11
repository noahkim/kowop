<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary(array($model)); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'First_name'); ?>
        <?php echo $form->textField($model, 'First_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'First_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Last_name'); ?>
        <?php echo $form->textField($model, 'Last_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Password'); ?>
        <?php echo $form->passwordField($model, 'Password', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Email'); ?>
        <?php echo $form->textField($model, 'Email', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Phone_number'); ?>
        <?php echo $form->textField($model, 'Phone_number', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'Phone_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Description'); ?>
        <?php echo $form->textField($model, 'Description', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Teacher_alias'); ?>
        <?php echo $form->textField($model, 'Teacher_alias', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Teacher_alias'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->