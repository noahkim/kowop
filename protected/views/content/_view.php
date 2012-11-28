<?php
/* @var $this ContentController */
/* @var $data Content */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Content_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Content_ID), array('view', 'id'=>$data->Content_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Content_type')); ?>:</b>
	<?php echo CHtml::encode($data->Content_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Content_name')); ?>:</b>
	<?php echo CHtml::encode($data->Content_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Link')); ?>:</b>
	<?php echo CHtml::encode($data->Link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Created')); ?>:</b>
	<?php echo CHtml::encode($data->Created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Updated')); ?>:</b>
	<?php echo CHtml::encode($data->Updated); ?>
	<br />


</div>