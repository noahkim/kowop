<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->User_ID), array('view', 'id'=>$data->User_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('First_name')); ?>:</b>
	<?php echo CHtml::encode($data->First_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Last_name')); ?>:</b>
	<?php echo CHtml::encode($data->Last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->Phone_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('IsAdmin')); ?>:</b>
	<?php echo CHtml::encode($data->IsAdmin); ?>
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