<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	$model->Name=>array('view','id'=>$model->Request_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Request', 'url'=>array('index')),
	array('label'=>'Create Request', 'url'=>array('create')),
	array('label'=>'View Request', 'url'=>array('view', 'id'=>$model->Request_ID)),
	array('label'=>'Manage Request', 'url'=>array('admin')),
);
?>

<h1>Update Request <?php echo $model->Request_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>