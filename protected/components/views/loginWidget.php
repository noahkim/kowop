<?php if (Yii::app()->user->isGuest) : ?>

<?php echo CHtml::beginForm(Yii::app()->homeUrl); ?>

<div>
    <?php echo CHtml::activeLabelEx($form, 'username'); ?>
    <?php echo CHtml::activeTextField($form, 'username') ?>
</div>

<div>
    <?php echo CHtml::activeLabelEx($form, 'password'); ?>
    <?php echo CHtml::activePasswordField($form, 'password'); ?>
</div>

<div>
    <?php echo CHtml::submitButton('Login'); ?>
</div>

<?php echo CHtml::error($form, 'password'); ?>
<?php echo CHtml::error($form, 'username'); ?>

<?php echo CHtml::endForm(); ?>

<?php echo CHtml::link('Create account', array('/user/create')); ?>

<?php else : ?>

<?php echo Yii::app()->user->Name . '<br />'; ?>
<?php echo CHtml::link('Logout', array('/site/logout')); ?>

<?php endif; ?>
