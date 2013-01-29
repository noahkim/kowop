<?php
/* @var $this ClassController */
/* @var $data Experience */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Experience_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Experience_ID), array('view', 'id'=>$data->Experience_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Course_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Course_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Type')); ?>:</b>
	<?php echo CHtml::encode($data->Type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Start')); ?>:</b>
	<?php echo CHtml::encode($data->Start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('End')); ?>:</b>
	<?php echo CHtml::encode($data->End); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Min_occupancy')); ?>:</b>
	<?php echo CHtml::encode($data->Min_occupancy); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Max_occupancy')); ?>:</b>
	<?php echo CHtml::encode($data->Max_occupancy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Location_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Location_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Created')); ?>:</b>
	<?php echo CHtml::encode($data->Created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Updated')); ?>:</b>
	<?php echo CHtml::encode($data->Updated); ?>
	<br />

	*/ ?>

</div>