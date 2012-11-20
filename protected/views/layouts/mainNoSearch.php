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
    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href="/ui/site/fonts/susa/stylesheet.css">
    <link href='http://fonts.googleapis.com/css?family=Copse' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/ui/site/stylesheets/foundation.min.css">
    <link rel="stylesheet" href="/ui/site/stylesheets/main.css">
    <script src="/ui/site/javascripts/modernizr.foundation.js"></script>

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
        <div class="six columns blurb"> teach anything. learn everything.</div>
        <div class="three columns headernav">
            <ul>
                <li><a href="how_it_works.html">How it Works</a></li>
                <li><?php echo CHtml::link('Sign Up', array('/user/create')); ?></li>
                <li>
                    <?php if (Yii::app()->user->isGuest) { ?>
                    <?php echo CHtml::link('Login', array('/site/login')); ?>
                    <?php } else { ?>
                    <?php echo CHtml::link('Logout', array('/site/logout'));; ?>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content !-->
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

<!-- Included JS Files (Uncompressed) -->
<!--
  <script src="/ui/site/javascripts/jquery.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.forms.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.reveal.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.orbit.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.navigation.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.buttons.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.tabs.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.tooltips.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.accordion.js"></script>
  <script src="/ui/site/javascripts/jquery.placeholder.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.alerts.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.topbar.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.joyride.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.clearing.js"></script>
  <script src="/ui/site/javascripts/jquery.foundation.magellan.js"></script>
  -->
<!-- Included JS Files (Compressed) -->
<script src="/ui/site/javascripts/jquery.js"></script>
<script src="/ui/site/javascripts/foundation.min.js"></script>
<!-- Initialize JS Plugins -->
<script src="/ui/site/javascripts/app.js"></script>
</body>
</html>
