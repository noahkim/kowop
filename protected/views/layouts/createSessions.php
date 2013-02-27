<!DOCTYPE html><!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --><!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]--><!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]--><!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]--><!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />

    <link rel="stylesheet" href="/ui/sitev2/fonts/proxima/stylesheet.css">
    <link rel="stylesheet" href="/ui/sitev2/fonts/susa/stylesheet.css">
    <link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

    <link rel='stylesheet' type='text/css' href='/ui/sitev2/fullcalendar/fullcalendar/fullcalendar.css' />
    <link rel='stylesheet'
          type='text/css'
          href='/ui/sitev2/fullcalendar/fullcalendar/fullcalendar.print.css'
          media='print' />
    <link rel="stylesheet" type="text/css" href="/ui/sitev2/stylesheets/nivo-default.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/ui/sitev2/stylesheets/nivo-slider.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/ui/sitev2/stylesheets/zebra_datepicker.css" />

    <link rel="stylesheet" href="/ui/sitev2/stylesheets/foundation.css" />
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/main.css" />

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/ui/sitev2/javascripts/foundation.min.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery-ui-1.9.2.custom.min.js"></script>

    <script src='<?php echo Yii::app()->params['siteBase']; ?>/js/date.js'></script>
    <script src='/ui/sitev2/fullcalendar/fullcalendar/fullcalendar.min.js'></script>
    <script src="/ui/sitev2/javascripts/modernizr.foundation.js"></script>
    <script src="/ui/sitev2/javascripts/app.js"></script>
    <script src="/ui/sitev2/javascripts/account_toggle.js"></script>
    <script src="/ui/sitev2/javascripts/jquery.nivo.slider.pack.js"></script>
    <script src="/ui/sitev2/javascripts/jquery.nivo.slider.js"></script>
    <script src="/ui/sitev2/javascripts/qtip.js"></script>
    <script src="/ui/sitev2/javascripts/zebra_datepicker.js"></script>
    <script src="/ui/sitev2/javascripts/jquery.timepicker.js"></script>
    <script src="/ui/sitev2/javascripts/wysiwyg.js"></script>
    <script src="/ui/sitev2/javascripts/wysiwyg_advanced.js"></script>
    <script src="/ui/sitev2/javascripts/jeditable.js"></script>

    <title>Kowop | Neighborhood activites &amp; classes for kids and families</title>
</head>
<body>

<?php echo $this->renderPartial('/site/_headernav'); ?>

<?php echo $content; ?>

<?php echo $this->renderPartial('/site/_footer'); ?>

</body>
</html>
