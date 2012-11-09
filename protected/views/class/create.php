<?php
/* @var $this ClassController */
/* @var $model KClass */

$this->breadcrumbs = array(
    'Kclasses' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List KClass', 'url' => array('index')),
    array('label' => 'Manage KClass', 'url' => array('admin')),
);
?>

<h1>Create Class</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'location' => $location)); ?>