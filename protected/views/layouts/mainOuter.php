<!DOCTYPE html><!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --><!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]--><!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]--><!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]--><!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />

    <link rel="stylesheet" href="<?php echo Yii::app()->params['siteBase']; ?>/fonts/proxima/stylesheet.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->params['siteBase']; ?>/fonts/susa/stylesheet.css">
    <link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

    <link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->params['siteBase']; ?>/fullcalendar/fullcalendar/fullcalendar.css' />
    <link rel='stylesheet'
          type='text/css'
          href='<?php echo Yii::app()->params['siteBase']; ?>/fullcalendar/fullcalendar/fullcalendar.print.css'
          media='print' />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['siteBase']; ?>/css/nivo-default.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['siteBase']; ?>/css/nivo-slider.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['siteBase']; ?>/css/zebra_datepicker.css" />

    <link rel="stylesheet" href="<?php echo Yii::app()->params['siteBase']; ?>/css/foundation.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->params['siteBase']; ?>/css/main.css" />

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/foundation.min.js"></script>


    <script src='<?php echo Yii::app()->params['siteBase']; ?>/js/date.js'></script>
    <script src='<?php echo Yii::app()->params['siteBase']; ?>/fullcalendar/fullcalendar/fullcalendar.min.js'></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/modernizr.foundation.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/app.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/account_toggle.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery.nivo.slider.pack.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery.nivo.slider.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/qtip.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/zebra_datepicker.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery.timepicker.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/wysiwyg.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/wysiwyg_advanced.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jeditable.js"></script>
    <script src="https://www.google.com/jsapi?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/gmap3.min.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery.cookie.js"></script>
    <script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery.NobleCount.min.js"></script>


    <title>Kowop | Neighborhood activites &amp; classes for kids and families</title>
</head>
<body>

<?php echo $content; ?>

<?php echo $this->renderPartial('/site/_footer'); ?>

</body>
</html>
