<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->Content_ID,
);

$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Create Content', 'url'=>array('create')),
	array('label'=>'Update Content', 'url'=>array('update', 'id'=>$model->Content_ID)),
	array('label'=>'Delete Content', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Content_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Content', 'url'=>array('admin')),
);
?>

<h1>View Content #<?php echo $model->Content_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Content_ID',
		'Content_type',
		'Content_name',
		'Link',
		'Created',
		'Updated',
	),
)); ?>
