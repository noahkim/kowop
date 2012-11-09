<?php
/* @var $this RequestController */
/* @var $data Request */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Request_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Request_ID), array('view', 'id'=>$data->Request_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Create_User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Create_User_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Type')); ?>:</b>
	<?php echo CHtml::encode($data->Type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Cost')); ?>:</b>
	<?php echo CHtml::encode($data->Cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MinimumRating')); ?>:</b>
	<?php echo CHtml::encode($data->MinimumRating); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Created_Class_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Created_Class_ID); ?>
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