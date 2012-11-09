<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Request', 'url'=>array('index')),
	array('label'=>'Create Request', 'url'=>array('create')),
	array('label'=>'Update Request', 'url'=>array('update', 'id'=>$model->Request_ID)),
	array('label'=>'Delete Request', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Request_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Request', 'url'=>array('admin')),
);
?>

<h1>View Request #<?php echo $model->Request_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Request_ID',
		'Create_User_ID',
		'Type',
		'Name',
		'Description',
		'Cost',
		'MinimumRating',
		'Created_Class_ID',
		'Location_ID',
		'Created',
		'Updated',
	),
)); ?>
