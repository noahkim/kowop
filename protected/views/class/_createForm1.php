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
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'classType'); ?>
        <?php echo $form->dropDownList($model, 'classType', ClassType::$Lookup); ?>
        <?php echo $form->error($model, 'classType'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'start'); ?>
        <?php echo $form->textField($model, 'start'); ?>
        <?php echo $form->error($model, 'start'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'end'); ?>
        <?php echo $form->textField($model, 'end'); ?>
        <?php echo $form->error($model, 'end'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'minOccupancy'); ?>
        <?php echo $form->textField($model, 'minOccupancy'); ?>
        <?php echo $form->error($model, 'minOccupancy'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'maxOccupancy'); ?>
        <?php echo $form->textField($model, 'maxOccupancy'); ?>
        <?php echo $form->error($model, 'maxOccupancy'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'category'); ?>
        <?php echo $form->dropDownList($model, 'category', Category::GetCategories()); ?>
        <?php echo $form->error($model, 'category'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'tags'); ?>
        <?php echo $form->textField($model, 'tags'); ?>
        <?php echo $form->error($model, 'tags'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'numSessions'); ?>
        <?php echo $form->textField($model, 'numSessions'); ?>
        <?php echo $form->error($model, 'numSessions'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'locationName'); ?>
        <?php echo $form->textField($model,'locationName',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'locationName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'locationStreet'); ?>
        <?php echo $form->textField($model,'locationStreet',array('size'=>60,'maxlength'=>2000)); ?>
        <?php echo $form->error($model,'locationStreet'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'locationCity'); ?>
        <?php echo $form->textField($model,'locationCity',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'locationCity'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'locationState'); ?>
        <?php echo $form->textField($model,'locationState',array('size'=>60,'maxlength'=>2)); ?>
        <?php echo $form->error($model,'locationState'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'locationZip'); ?>
        <?php echo $form->textField($model,'locationZip',array('size'=>45,'maxlength'=>5)); ?>
        <?php echo $form->error($model,'locationZip'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'locationType'); ?>
        <?php echo $form->dropDownList($model,'locationType', LocationType::$Lookup); ?>
        <?php echo $form->error($model,'locationType'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Next', array('name' => 'step2')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

