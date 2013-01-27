<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width"/>

    <link rel="stylesheet" href="/ui/sitev2/fonts/proxima/stylesheet.css">
    <link rel="stylesheet" href="/ui/sitev2/fonts/susa/stylesheet.css">
    <link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

    <link rel='stylesheet' type='text/css' href='/ui/sitev2/fullcalendar/fullcalendar/fullcalendar.css'/>
    <link rel='stylesheet' type='text/css' href='/ui/sitev2/fullcalendar/fullcalendar/fullcalendar.print.css'
          media='print'/>
    <link rel="stylesheet" type="text/css" href="/ui/sitev2/stylesheets/nivo-default.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/ui/sitev2/stylesheets/nivo-slider.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/ui/sitev2/stylesheets/zebra_datepicker.css"/>

    <link rel="stylesheet" href="/ui/sitev2/stylesheets/foundation.css" />
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/main.css" />

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/yii/kowop/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="/ui/sitev2/javascripts/foundation.min.js"></script>


    <script src='/yii/kowop/js/date.js'></script>
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

    <title>Kowop | Hand-crafted experiences to share, learn and teach in the comfort of your neighborhood. Meet new
        people, experience new things.</title>
</head>
<body>

<?php echo $content; ?>

<!---------------------------------------
              Footer
---------------------------------------->
<div class="footer">
    <div class="row">
        <div class="two columns footerlinks discover">
            <h5>Discover</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("teach a class", $this->createUrl("class/create")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("take a class", $this->createUrl("class/search")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("request a class", $this->createUrl("request/create")); ?>
                </li>
                <li><a href="#">how it works</a></li>
            </ul>
        </div>
        <div class="two columns footerlinks company">
            <h5>Company</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("our story", $this->createUrl("site/page", array('view' => 'about'))); ?>
                </li>
                <li>
                    <?php echo CHtml::link("join the team", $this->createUrl("site/page", array('view' => 'meet'))); ?>
                </li>
                <li><a href="#">press</a></li>
                <li><a href="#">blog</a></li>
                <li>
                    <?php echo CHtml::link("FaQ", $this->createUrl("site/page", array('view' => 'faq'))); ?>
                </li>
                <li><a href="#">policies</a></li>
                <li><a href="#">contact</a></li>
                <li><a href="#">terms &amp; privacy</a></li>
            </ul>
        </div>
        <div class="two columns footerlinks joinuson">
            <h5>Join us on:</h5>
            <ul>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Google+</a></li>
                <li><a href="#">Newsletter</a></li>
            </ul>
        </div>
        <div class="six columns"></div>
    </div>
    <div class="row">
        <div class="two columns offset-by-five footerlogo"><img src="/ui/sitev2/images/logo_small.png"></div>
    </div>
</div>

</body>
</html>