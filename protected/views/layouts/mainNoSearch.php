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

    <link rel="stylesheet" type="text/css" href="/ui/site/fonts/hero/stylesheet.css"/>
    <link rel="stylesheet" type="text/css" href="/ui/site/fonts/bryant/stylesheet.css"/>
    <link rel="stylesheet" type="text/css" href="/ui/site/fonts/susa/stylesheet.css"/>
    <link rel='stylesheet' type='text/css' href='/ui/site/fullcalendar/fullcalendar/fullcalendar.css'/>
    <link rel='stylesheet' type='text/css' href='/ui/site/fullcalendar/fullcalendar/fullcalendar.print.css'
          media='print'/>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Copse"/>
    <link rel="stylesheet" type="text/css" href="/ui/site/stylesheets/foundation.min.css"/>
    <link rel="stylesheet" type="text/css" href="/ui/site/stylesheets/main.css"/>
    <link rel="stylesheet" type="text/css" href="/ui/site/stylesheets/nivo-default.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/ui/site/stylesheets/nivo-slider.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/ui/site/stylesheets/zebra_datepicker.css"/>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/yii/kowop/js/jquery-ui-1.9.2.custom.min.js"></script>

    <script src='/yii/kowop/js/date.js'></script>
    <script src='/ui/site/fullcalendar/fullcalendar/fullcalendar.min.js'></script>
    <script src="/ui/site/javascripts/modernizr.foundation.js"></script>
    <script src="/ui/site/javascripts/app.js"></script>
    <script src="/ui/site/javascripts/account_toggle.js"></script>
    <script src="/ui/site/javascripts/jquery.nivo.slider.pack.js"></script>
    <script src="/ui/site/javascripts/jquery.nivo.slider.js"></script>
    <script src="/ui/site/javascripts/qtip.js"></script>
    <script src="/ui/site/javascripts/zebra_datepicker.js"></script>
    <script src="/ui/site/javascripts/jquery.timepicker.js"></script>

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
            <!----- My account dropdown ------->
            <div class="dropdown">
                <a class="account">
                    <span class="notifications">99</span>
                    <span>My Account</span>
                </a>
                <div class="submenu" style="display: none;">
                    <ul class="root">
                        <li><a href="account_manage1.html">My Classes</a> </li>
                        <li><?php echo CHtml::link('My Profile', array('/user/view', 'id' => Yii::app()->user->id)); ?> </li>
                        <li><?php echo CHtml::link('Sign Out', array('/site/logout')); ?></li>
                    </ul>
                </div>
            </div>
            <!----- end my account dropdown----->
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

</body>
</html>
