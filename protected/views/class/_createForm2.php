<?php
/* @var $this ClassController */
/* @var $model KClass */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'class-create-form',
    'enableAjaxValidation' => false,
    'stateful' => true
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'prerequisites'); ?>
        <?php echo $form->textField($model, 'prerequisites'); ?>
        <?php echo $form->error($model, 'prerequisites'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'materials'); ?>
        <?php echo $form->textField($model, 'materials'); ?>
        <?php echo $form->error($model, 'materials'); ?>
    </div>

    <div class="row">
        Class Image URL:
        <input name='imageURL' type='text' />
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'tuition'); ?>
        <?php echo $form->textField($model, 'tuition'); ?>
        <?php echo $form->error($model, 'tuition'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Next', array('name' => 'step3')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

