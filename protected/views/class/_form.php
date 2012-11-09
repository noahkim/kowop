<?php
/* @var $this ClassController */
/* @var $model KClass */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'kclass-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    $models = array($model);
    if (isset($location))
    {
        $models = array($model, $location);
    }
    echo $form->errorSummary($models);
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'Name'); ?>
        <?php echo $form->textField($model, 'Name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Type'); ?>
        <?php echo $form->textField($model, 'Type'); ?>
        <?php echo $form->error($model, 'Type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Start'); ?>
        <?php echo $form->textField($model, 'Start'); ?>
        <?php echo $form->error($model, 'Start'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'End'); ?>
        <?php echo $form->textField($model, 'End'); ?>
        <?php echo $form->error($model, 'End'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Min_occupancy'); ?>
        <?php echo $form->textField($model, 'Min_occupancy'); ?>
        <?php echo $form->error($model, 'Min_occupancy'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Max_occupancy'); ?>
        <?php echo $form->textField($model, 'Max_occupancy'); ?>
        <?php echo $form->error($model, 'Max_occupancy'); ?>
    </div>

    <!--Location-->
    <?php
    if (isset($location))
    {
        echo $this->renderPartial('//location/_form', array('model' => $location, 'form' => $form));
    }
    ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->