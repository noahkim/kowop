<?php
/* @var $this ClassController */
/* @var $model KClass */
?>

<h1>Viewing class <?php echo $model->Name; ?></h1>

<?php
    echo 'Taught by ';
    echo CHtml::link($model->createUser->fullname, array('/user/view', 'id' => $model->Create_User_ID));
    echo '<br /><br />';
?>

<?php echo "Tags: {$model->tagstring}<br />"; ?>

<?php if($model->location != null) { echo "<br />{$model->location->fulladdress}<br />"; } ?>

<?php
    foreach($model->sessions as $i => $session)
    {
        $sessionNumber = $i + 1;
        echo "Session {$sessionNumber}<br />";
        echo "Start: {$session->Start}<br />";
        echo "End: {$session->End}<br /><br />";
    }
?>

<?php echo CHtml::link('Join class', array('/class/join', 'id' => $model->Class_ID)) . '<br />'; ?>


