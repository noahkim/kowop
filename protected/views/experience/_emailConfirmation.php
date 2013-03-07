<div>
    <?php echo CHtml::link('<img src="http://' . $_SERVER['HTTP_HOST'] . Yii::app()->params['siteBase'] . '/images/logo_small.png">', 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->params['siteBase']); ?>
    <br /> activities &amp; classes for kids &amp; families
</div>

<p>
    Thank you for signing up to <?php echo $model->Name; ?>! <br />

    Your confirmation code is: <?php echo $confirmationCode; ?> <br />

    Cost: <?php echo $model->Price == null ? 'Free' : '$' . $model->Price; ?> <br />

    Quantity: <?php echo $quantity; ?>    <br /><br />

    Total: <?php echo $model->Price == null ? 'Free' : '$' . ($model->Price * $quantity); ?> <br />

</p>

<?php echo CHtml::link('View the listing', Yii::app()->createAbsoluteUrl('/experience/view', array('id' => $model->Experience_ID))); ?>

