<?php
/* @var $this RatingController */
/* @var $model Rating */

$this->breadcrumbs=array(
	'Ratings'=>array('index'),
	$model->Rating_ID=>array('view','id'=>$model->Rating_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rating', 'url'=>array('index')),
	array('label'=>'Create Rating', 'url'=>array('create')),
	array('label'=>'View Rating', 'url'=>array('view', 'id'=>$model->Rating_ID)),
	array('label'=>'Manage Rating', 'url'=>array('admin')),
);
?>

<h1>Update Rating <?php echo $model->Rating_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>