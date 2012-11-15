<?php
/* @var $this Controller */
/* @var $model LoginForm */
?>
<!doctype html>
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!--- calendar---->
    <link href="/ux/css/fullcalendar.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='/ux/fullcalendar/fullcalendar/fullcalendar.css'/>
    <link rel='stylesheet' type='text/css' href='/ux/fullcalendar/fullcalendar/fullcalendar.print.css' media='print'/>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

    <script type='text/javascript' src='/ux/fullcalendar/jquery/jquery-1.8.1.min.js'></script>
    <!--<script type='text/javascript' src='/ux/fullcalendar/jquery/jquery-ui-1.8.23.custom.min.js'></script>-->
    <script type='text/javascript' src='/ux/fullcalendar/fullcalendar/fullcalendar.min.js'></script>

    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

    <script type='text/javascript' src='/yii/kowop/js/date.js'></script>
</head>

<body>

<div class="container">
    <div>
        <?php
        $this->widget('LoginWidget');
        ?>
    </div>

    <div>
        <h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
    </div>

    <?php echo $content; ?>
</div>

</body>
</html>
