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
    <!-- Included CSS Files (Uncompressed) -->
    <!--
      <link rel="stylesheet" href="stylesheets/foundation.css">
      -->

    <script src="/ui/site/javascripts/jquery.nivo.slider.pack.js" type="text/javascript"></script>

    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href="/ui/site/fonts/hero/stylesheet.css">
    <link rel="stylesheet" href="/ui/site/fonts/bryant/stylesheet.css">
    <link rel="stylesheet" href="/ui/site/fonts/susa/stylesheet.css">
    <link href='http://fonts.googleapis.com/css?family=Copse' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/ui/site/stylesheets/nivo-default.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/ui/site/stylesheets/nivo-slider.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/ui/site/stylesheets/foundation.min.css">
    <link rel="stylesheet" href="/ui/site/stylesheets/main.css">
    <script src="/ui/site/javascripts/modernizr.foundation.js"></script>

    <!-- Included JS Files (Compressed) -->
    <script src="/ui/site/javascripts/jquery.js"></script>
    <script src="/ui/site/javascripts/foundation.min.js"></script>
    <!-- Initialize JS Plugins -->
    <script src="/ui/site/javascripts/app.js"></script>

    <!-- Calendar stuff -->
    <link href="/ux/css/fullcalendar.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='/ux/fullcalendar/fullcalendar/fullcalendar.css'/>
    <link rel='stylesheet' type='text/css' href='/ux/fullcalendar/fullcalendar/fullcalendar.print.css' media='print'/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/>

    <!-- Calendar stuff -->
    <script src='/ux/fullcalendar/fullcalendar/fullcalendar.min.js'></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script src='/yii/kowop/js/date.js'></script>

    <title>Kowop | teach anything. learn everything.</title>
</head>
<body>
<!---------------------------------------
                 Header
---------------------------------------->
<div class="header spacebot20">
    <div class="row">
        <div class="three columns logo">
            <?php echo CHtml::link('<img src="/ui/site/images/logo_small.png">', Yii::app()->homeUrl); ?>
        </div>

        <?php if (Yii::app()->user->isGuest) : ?>
        <div class="six columns blurb"> teach anything. learn everything.</div>
        <div class="three columns headernav">
            <ul>
                <li><a href="how_it_works.html">How it Works</a></li>
                <li><?php echo CHtml::link('Sign Up', array('/user/create')); ?></li>
                <li><?php echo CHtml::link('Login', array('/site/login')); ?></li>
            </ul>
        </div>
        <?php else : ?>
        <div class="five columns blurb"> teach anything. learn everything.</div>
        <div class="four columns headernav">
            <ul>
                <li><a href="how_it_works.html">How it Works</a></li>
                <li><?php echo CHtml::link('Logout', array('/site/logout')); ?></li>
                <li><?php echo CHtml::link('My Account', array('/user/view', 'id' => Yii::app()->user->id)); ?></li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php echo $content; ?>

<!---------------------------------------
              Footer
---------------------------------------->
<div class="footer">
    <div class="row">
        <div class="two columns footerlinks discover">
            <h5>Discover</h5>
            <ul>
                <li><a href="#">teach a class</a></li>
                <li><a href="#">take a class</a></li>
                <li><a href="#">request a class</a></li>
                <li><a href="#">how it works</a></li>
            </ul>
        </div>
        <div class="two columns footerlinks company">
            <h5>Company</h5>
            <ul>
                <li><a href="#">about us</a></li>
                <li><a href="#">join the team</a></li>
                <li><a href="#">press</a></li>
                <li><a href="#">blog</a></li>
                <li><a href="#">FaQ</a></li>
                <li><a href="#">policies</a></li>
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
    <div class="row footerlogo">
        <div class="two columns offset-by-five"><img src="/ui/site/images/logo_small.png"></div>
    </div>
</div>

<script type="text/javascript" src="/ui/site/javascripts/jquery.nivo.slider.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        $('#slider').nivoSlider({
            effect:'fade', // Specify sets like: 'fold,fade,sliceDown'
            slices:15, // For slice animations
            boxCols:8, // For box animations
            boxRows:4, // For box animations
            animSpeed:1000, // Slide transition speed
            pauseTime:4000, // How long each slide will show
            startSlide:0, // Set starting Slide (0 index)
            directionNav:true, // Next & Prev navigation
            controlNav:true, // 1,2,3... navigation
            controlNavThumbs:true, // Use thumbnails for Control Nav
            pauseOnHover:true, // Stop animation while hovering
            manualAdvance:false, // Force manual transitions
            prevText:'Prev', // Prev directionNav text
            nextText:'Next', // Next directionNav text
            randomStart:false, // Start on a random slide
            beforeChange:function () {
            }, // Triggers before a slide transition
            afterChange:function () {
            }, // Triggers after a slide transition
            slideshowEnd:function () {
            }, // Triggers after all slides have been shown
            lastSlide:function () {
            }, // Triggers when last slide is shown
            afterLoad:function () {
            } // Triggers when slider has loaded
        });
    });
</script>


</body>
</html>
