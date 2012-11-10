<div class="row">
    <?php echo $form->labelEx($model,'Name'); ?>
    <?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'Name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'Address'); ?>
    <?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>2000)); ?>
    <?php echo $form->error($model,'Address'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'City'); ?>
    <?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'City'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'State'); ?>
    <?php echo $form->textField($model,'State',array('size'=>60,'maxlength'=>80)); ?>
    <?php echo $form->error($model,'State'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'Zip'); ?>
    <?php echo $form->textField($model,'Zip',array('size'=>45,'maxlength'=>45)); ?>
    <?php echo $form->error($model,'Zip'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'Country'); ?>
    <?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'Country'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'Type'); ?>
    <?php echo $form->textField($model,'Type'); ?>
    <?php echo $form->error($model,'Type'); ?>
</div>
