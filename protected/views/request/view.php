<?php
/* @var $this RequestController */
/* @var $model Request */
?>

<h1>Viewing class request <?php echo $model->Name; ?></h1>

<?php
echo 'Request created by ';
echo CHtml::link($model->createUser->fullname, array('/user/view', 'id' => $model->Create_User_ID));
echo '<br /><br />';
?>

<?php echo "Tags: {$model->tagstring}<br />"; ?>

<?php if($model->location != null) { echo "<br />{$model->location->fulladdress}<br />"; } ?>

<?php echo CHtml::link('Second this request', array('/request/join', 'id' => $model->Request_ID)) . '<br />'; ?>