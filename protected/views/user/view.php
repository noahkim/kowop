<?php
/* @var $this UserController */
/* @var $model User */

?>

<h1>User profile for <?php echo $model->First_name . ' ' . $model->Last_name; ?></h1>

<?php echo CHtml::encode($model->getAttributeLabel('First_name')); ?>:
<?php echo CHtml::encode($model->First_name); ?>
<br/>

<?php echo CHtml::encode($model->getAttributeLabel('Last_name')); ?>:
<?php echo CHtml::encode($model->Last_name); ?>
<br/>

<?php
if (Yii::app()->user->id == $model->User_ID)
{
    echo CHtml::encode($model->getAttributeLabel('Email')) . ':';
    echo CHtml::encode($model->Email);
    echo '<br/>';

    echo CHtml::encode($model->getAttributeLabel('Phone_number')) . ':';
    echo CHtml::encode($model->Phone_number);
    echo '<br/>';
}
?>

<?php echo CHtml::encode($model->getAttributeLabel('Description')); ?>:
<?php echo CHtml::encode($model->Description); ?>
<br/>

<?php echo CHtml::encode($model->getAttributeLabel('Teacher_alias')); ?>:
<?php echo CHtml::encode($model->Teacher_alias); ?>
<br/>

<?php echo CHtml::encode($model->getAttributeLabel('Created')); ?>:
<?php echo CHtml::encode($model->Created); ?>
<br/>

<?php
if (count($model->kClasses) > 0)
{
    echo 'Teaching: <br />';

    foreach ($model->kClasses as $class)
    {
        echo CHtml::encode($class->getAttributeLabel('Name')) . ':';

        echo CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID)) . '<br />';

        foreach ($model->ratings as $rating)
        {
            if ($rating->Class_ID == $class->Class_ID)
            {
                echo 'Comment by ' . $rating->rateUser->fullname . ':<br />';
                echo $rating->Comment . '<br />';
                echo 'Reaction: ' . $rating->Reaction . '<br />';
            }
        }
    }

    echo '<br />';
}
?>

Enrolled in: <br/>

<?php
foreach ($model->userToClasses as $userToClass)
{
    $class = $userToClass->class;
    echo CHtml::encode($class->getAttributeLabel('Name')) . ':';
    echo CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID)) . '<br />';
}
?>

<br/>

Class requests: <br/>
<?php
foreach ($model->requests as $request)
{
    echo CHtml::encode($request->getAttributeLabel('Name')) . ':';
    echo CHtml::link($request->Name, array('/request/view', 'id' => $request->Request_ID)) . '<br />';
}
?>