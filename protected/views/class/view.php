<?php
/* @var $this ClassController */
/* @var $model KClass */

$this->breadcrumbs=array(
	'Kclasses'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List KClass', 'url'=>array('index')),
	array('label'=>'Create KClass', 'url'=>array('create')),
	array('label'=>'Update KClass', 'url'=>array('update', 'id'=>$model->Class_ID)),
	array('label'=>'Delete KClass', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Class_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KClass', 'url'=>array('admin')),
);
?>

<h1>View KClass #<?php echo $model->Class_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Class_ID',
		'Course_ID',
		'Name',
		'Type',
		'Start',
		'End',
		'Min_occupancy',
		'Max_occupancy',
		'Location_ID',
		'Created',
		'Updated',
	),
)); ?>
