<?php
/* @var $this RatingController */
/* @var $model Rating */

$this->breadcrumbs=array(
	'Ratings'=>array('index'),
	$model->Rating_ID,
);

$this->menu=array(
	array('label'=>'List Rating', 'url'=>array('index')),
	array('label'=>'Create Rating', 'url'=>array('create')),
	array('label'=>'Update Rating', 'url'=>array('update', 'id'=>$model->Rating_ID)),
	array('label'=>'Delete Rating', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Rating_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rating', 'url'=>array('admin')),
);
?>

<h1>View Rating #<?php echo $model->Rating_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Rating_ID',
		'User_ID',
		'Rate_User_ID',
		'Experience_ID',
		'Comment',
		'Flagged',
		'Active',
		'Created',
	),
)); ?>
