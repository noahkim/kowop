<?php
if (Yii::app()->user->isGuest)
{
    echo CHtml::beginForm(array('/site/login'));

    $link = '//' . Yii::app()->controller->uniqueid . '/' . Yii::app()->controller->action->id;
    echo CHtml::hiddenField('quicklogin', $link);
    ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="row">
    <?php echo CHtml::activeLabelEx($model, 'username'); ?>
    <?php echo CHtml::activeTextField($model, 'username') ?>
</div>

<div class="row" style="padding-top:12px;">
    <?php echo CHtml::activeLabelEx($model, 'password'); ?>
    <?php echo CHtml::activePasswordField($model, 'password'); ?>
</div>

<div class="row submit">
    <?php echo CHtml::submitButton('Login'); ?>
</div>
<?php
    echo CHtml::endForm();
    echo CHtml::link('Create account', array('/user/create'));
}
else
{
    echo Yii::app()->user->Name . '<br />';
    echo CHtml::link('Logout', array('/site/logout'));
}
?>
