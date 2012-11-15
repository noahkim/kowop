<?php
/* @var $this Controller */
/* @var $model LoginForm */
?>
<!doctype html>
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container">
    <div>
        <?php echo CHtml::link('Home', Yii::app()->homeUrl); ?>
    </div>
    <div>
        <?php $this->widget('LoginWidget'); ?>
    </div>

    <div>
        <h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
    </div>

    <?php echo $content; ?>
</div>

</body>
</html>
