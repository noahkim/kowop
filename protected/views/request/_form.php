<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    $models = array($model);
    if (isset($location))
    {
        array_push($models, $location);
    }
    if(isset($requestToUser))
    {
        array_push($models, $requestToUser);
    }
    echo $form->errorSummary($models);
    ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'Type'); ?>
        <?php echo $form->textField($model,'Type'); ?>
        <?php echo $form->error($model,'Type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Category_ID'); ?>
        <?php echo $form->textField($model, 'Category_ID'); ?>
        <?php echo $form->error($model, 'Category_ID'); ?>
    </div>

    <!--Tags-->
    <div class="row">
        <label for="tags">Tags</label>
        <input name="tags" id="tags" type="text" />
    </div>

    <!--Request_to_user-->
    <?php if(isset($requestToUser)) {  ?>

    <div class="row">
        <?php echo $form->labelEx($requestToUser,'Day'); ?>
        <?php echo $form->textField($requestToUser,'Day'); ?>
        <?php echo $form->error($requestToUser,'Day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($requestToUser,'Time_of_day'); ?>
        <?php echo $form->textField($requestToUser,'Time_of_day'); ?>
        <?php echo $form->error($requestToUser,'Time_of_day'); ?>
    </div>

    <?php } ?>

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