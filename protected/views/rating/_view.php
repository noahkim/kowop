<?php
/* @var $this RatingController */
/* @var $data Rating */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rating_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Rating_ID), array('view', 'id'=>$data->Rating_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->User_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rate_User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Rate_User_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Experience_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Experience_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Comment')); ?>:</b>
	<?php echo CHtml::encode($data->Comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Flagged')); ?>:</b>
	<?php echo CHtml::encode($data->Flagged); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Active')); ?>:</b>
	<?php echo CHtml::encode($data->Active); ?>
	<br />

	<?php
    /*
   <b><?php echo CHtml::encode($data->getAttributeLabel('Reaction')); ?>:</b>
   <?php echo CHtml::encode($data->Reaction); ?>
   <br />

   <b><?php echo CHtml::encode($data->getAttributeLabel('Created')); ?>:</b>
   <?php echo CHtml::encode($data->Created); ?>
   <br />

   */ ?>

</div>