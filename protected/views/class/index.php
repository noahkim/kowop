<?php
/* @var $this ClassController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kclasses',
);

$this->menu=array(
	array('label'=>'Create KClass', 'url'=>array('create')),
	array('label'=>'Manage KClass', 'url'=>array('admin')),
);
?>

<h1>Kclasses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
