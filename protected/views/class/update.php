<?php
/* @var $this ClassController */
/* @var $model KClass */

$this->breadcrumbs=array(
	'Kclasses'=>array('index'),
	$model->Name=>array('view','id'=>$model->Class_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List KClass', 'url'=>array('index')),
	array('label'=>'Create KClass', 'url'=>array('create')),
	array('label'=>'View KClass', 'url'=>array('view', 'id'=>$model->Class_ID)),
	array('label'=>'Manage KClass', 'url'=>array('admin')),
);
?>

<h1>Update KClass <?php echo $model->Class_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>