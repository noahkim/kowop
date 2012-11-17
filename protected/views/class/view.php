<?php
/* @var $this ClassController */
/* @var $model KClass */
?>

<h1>Viewing class <?php echo $model->Name; ?></h1>

<?php
    echo 'Taught by ';
    $name = ($model->createUser->Teacher_alias == null) ? $model->createUser->fullname : $model->createUser->Teacher_alias;
    echo CHtml::link($name, array('/user/view', 'id' => $model->Create_User_ID));
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

<br />

Currently enrolled: <br />
<?php
foreach($model->userToClasses as $userToClass)
{
    $user = $userToClass->user;
    $link = CHtml::link($user->fullname, array('/user/view', 'id' => $user->User_ID));
    echo "{$link}<br />";
}
?>
<br />

<?php echo CHtml::link('Join class', array('/class/join', 'id' => $model->Class_ID)) . '<br />'; ?>


