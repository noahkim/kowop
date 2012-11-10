<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->User_ID=>array('view','id'=>$model->User_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->User_ID)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>User profile for <?php echo $model->First_name . ' ' . $model->Last_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>