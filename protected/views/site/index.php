<!DOCTYPE html><!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --><!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]--><!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]--><!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]--><!--[if gt IE 8]><!-->
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
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/foundation.css">
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/main.css">

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/yiidev/kowop/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="/ui/sitev2/javascripts/modernizr.foundation.js"></script>
    <script src="/ui/sitev2/javascripts/foundation.min.js"></script>
    <script src="/ui/sitev2/javascripts/app.js"></script>
    <script src="/ui/sitev2/javascripts/account_toggle.js"></script>

    <script type="text/javascript" src="https://www.google.com/jsapi?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4"></script>
    <script type="text/javascript" src="/yii/kowop/js/gmap3.min.js"></script>

    <title>Kowop | Your local neighborhood board, online. Try something new, learn something awesome.</title>
</head>
<body>


<!---------------------------------------
     Main Homepage Banner / Logo / header nav
---------------------------------------->
<div class="mainMap">

    <?php if (Yii::app()->user->isGuest) : ?>

    <!----- Homepage logo and header nav ---------->
    <div class="row">
        <div class="three columns">
            <div class="logo">
                <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_small.png">', Yii::app()->homeUrl); ?>
                neighborhood activities &amp; classes
            </div>
        </div>

        <div class="four columns notlogged">
            <span class="navWhatskowop">
                <?php echo CHtml::link("how's it work?",
                                       $this->createUrl("site/page", array('view' => 'howitworks'))); ?>
            </span>
            <span class="navPost">
                <?php echo CHtml::link("post on Kowop", $this->createUrl("/experience/create")); ?>
            </span>
            <span class="navSignup">
                <?php echo CHtml::link("sign up", $this->createUrl("site/login")); ?>
            </span>
            <span class="navLogin">
                <?php echo CHtml::link("log in", $this->createUrl("site/login")); ?>
            </span>
        </div>
    </div>
    <!----- End Homepage logo and header nav ---------->
    <?php else: ?>
    <?php $user = User::model()->findByPk(Yii::app()->user->id); ?>

    <div class="header spacebot20">
        <div class="row">
            <div class="three columns">
                <div class="logo">
                    <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_small.png">', Yii::app()->homeUrl); ?>
                    neighborhood activities &amp; classes
                </div>
            </div>

            <div class="three columns headernav">
                <span class="notifications">
                    <?php echo CHtml::link(count($user->messages(array('condition' => '`Read` = 0'))),
                                           array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
                </span>
                <!----- My account dropdown ------->
                <div class="dropdown">
                    <a href="#" class="account"> <span class="headerAccount">my account</span> </a>

                    <div class="submenu" style="display: none;">
                        <ul class="root">
                            <li>
                                <?php echo CHtml::link('notifications',
                                                       array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('my classes',
                                                       array('/user/view', 'id' => $user->User_ID, 's' => 3)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('calendar',
                                                       array('/user/view', 'id' => $user->User_ID, 's' => 5)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('account info',
                                                       array('/user/view', 'id' => $user->User_ID, 's' => 6)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link("sign out", $this->createUrl("site/logout")); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <!----- end my account dropdown----->
            </div>
        </div>
    </div>

    <?php endif; ?>

    <!--    <div class="row">
            <div class="twelve columns">
                <div class="alert-box secondary">
                    This is Kowop dev instance. Please excuse any bugs, we make lots of changes daily.
                    <a href="" class="close">&times;</a>
            </div>
        </div>
    </div>
--><!----- Homepage Discovery Map ------>
    <div class="homeMap">
        <div class="row">
            <div class="three columns end">
                <div class="overlayMap">
                    <h2>Discover</h2>

                    <p>
                        Click on stuff you're <strong>not</strong> interested in <strong>90232</strong>
                        (<a href="#" class="homeChangelocation">change location</a>) </p>

              <span class="tagsMap">
              <a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Hacking</a><a href="#" class="homeTag">Adventure</a><a href="#" class="homeTag">Community</a><a href="#" class="homeTag">Scholastic</a><a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Entertainment</a><a href="#" class="homeTag">Fitness</a><a href="#" class="homeTag">Business</a><a href="#" class="homeTag">Music</a><a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Romantic</a><a href="#">Off-Beat</a><a href="#" class="homeTag">Creative</a><a href="#" class="homeTag">Technology</a>
              <a href="#" class="homeTag">Entertainment</a><a href="#" class="homeTag">Fitness</a><a href="#" class="homeTag">Business</a><a href="#" class="homeTag">Music</a><a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Technology</a><a href="#" class="homeTag">Romantic</a><a href="#">Off-Beat</a><a href="#" class="homeTag">Creative</a><a href="#" class="homeTag">Technology</a>
              </span>

                    <div class="row">
                        <div class="six columns">
                            <?php echo CHtml::link("Reset", array('/site/index'),
                                                   array('class' => 'homeChangelocation reset')); ?>
                        </div>
                        <div class="six columns">
                            <?php echo CHtml::link("Switch to Kids", array('/kids'),
                                                   array('class' => 'homeChangelocation')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='map' style='width: 100%; height: 550px;'></div>
        <!--<iframe width="100%" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=activities+90232&amp;sll=34.020479,-118.411732&amp;sspn=0.813826,1.588898&amp;t=v&amp;ie=UTF8&amp;hq=activities&amp;hnear=Culver+City,+California+90232&amp;fll=34.020847,-118.394008&amp;fspn=0.025432,0.049653&amp;st=109112006908742164799&amp;rq=1&amp;ev=zi&amp;split=1&amp;ll=34.020847,-118.394008&amp;spn=0.025432,0.049653&amp;output=embed"></iframe>-->
    </div>
    <!----- homepage discovery map -----><!----- Featured info ------------->
    <div class="homeSearch">
        <div class="row">
            <div class="three columns">
                <label class="inline right">...or the old fashioned way</label>
            </div>

            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form',
                                                                  'action' => Yii::app()->createUrl('/experience/search'),
                                                                  'enableAjaxValidation' => false, 'method' => 'get',
                                                                  'htmlOptions' => array('style' => 'margin: 0;'))); ?>

            <?php $model = new ExperienceSearchForm; ?>

            <div class="five columns">
                <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords,
                                                                      'placeholder' => 'What are you looking for?')); ?>
            </div>
            <div class="three columns">
                <?php echo $form->textField($model, 'location', array('value' => $model->location,
                                                                      'placeholder' => 'city,state or zip')); ?>
            </div>
            <div class="one columns">
                <a href="#" onclick="document.forms['search-form'].submit(); return false;" class="button">Search</a>
            </div>

            <?php $this->endWidget('CActiveForm'); ?>
        </div>
    </div>
    <!----- End Featured class info -------->
</div>

<!--------------------------------------
 Staff picks and Popular Classes
 --------------------------------------->
<div class="homeClasses">

    <h3>What would you like to do?</h3>

    <div class="row">
        <div class="four columns">
            <div class="homeIntro">
                <?php echo CHtml::link("<h5>I want to <i>learn</i> something new or <i>try</i> something fun.</h5>",
                                       array('/experience/search')); ?>
            </div>
        </div>
        <div class="four columns">
            <div class="homeIntro">
                <?php echo CHtml::link("<h5>I want to <i>post</i> an interesting activity or class</h5>",
                                       array('/experience/create')); ?>
            </div>
        </div>
        <div class="four columns">
            <div class="homeIntro">
                <?php echo CHtml::link("<h5>I'm a <i>parent</i> looking for classes &amp; activities for <i>kids</i>.</h5>",
                                       array('/kids')); ?>
            </div>
        </div>
    </div>

    <h3>Staff Picks in Los Angeles</h3>
    <!----------- 1 row of tiles---->
    <div class="row">
        <?php
        $experiences = Experience::model()->findAll(array('select' => '*, rand() as rand',
                                                          'condition' => 'Status = ' . ExperienceStatus::Active,
                                                          'limit' => 4, 'order' => 'rand',));
        foreach ($experiences as $experience)
        {
            $imageHTML = '<img src="' . ($experience->picture ? $experience->picture : 'http://placehold.it/400x300') . '" />';
            $imageLink = CHtml::link($imageHTML, array('/experience/view', 'id' => $experience->Experience_ID));

            $teacherName = $experience->createUser->Teacher_alias ? $experience->createUser->Teacher_alias : $experience->createUser->fullname;
            if (strlen($teacherName) > 25)
            {
                $teacherName = substr($teacherName, 0, 25);
                $teacherName .= ' ...';
            }

            $teacherLink = CHtml::link($teacherName, array('/user/view', 'id' => $experience->Create_User_ID));
            $description = $experience->Description;
            if (strlen($description) > 82)
            {
                $description = substr($description, 0, 82);
                $description .= ' ...';
            }

            $enrollees = '';
            foreach ($experience->enrolled as $enrollee)
            {
                $picLink = 'http://placeskull.com/100/100/868686';

                if ($enrollee->profilePic != null)
                {
                    $picLink = $enrollee->profilePic;
                }

                $enrolleeText = "<img src='{$picLink}' alt='{$enrollee->fullname}' title='{$enrollee->fullname}' />";
                $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $enrollee->User_ID)) . "\n";
            }

            $experienceName = $experience->Name;
            if (strlen($experienceName) > 60)
            {
                $experienceName = substr($experienceName, 0, 60);
                $experienceName .= ' ...';
            }
            $experienceName = CHtml::link('<h5>' . $experienceName . '</h5>',
                                          array('experience/view', 'id' => $experience->Experience_ID));

            if (($experience->Price == null) || ($experience->Price == 0))
            {
                $sessionHTML = 'This experience is free!';
            }
            else
            {
                $sessionHTML = "\${$experience->Price}";
            }

            echo <<<BLOCK
        <!----------- 1 tile ---------->
        <div class="three columns">
            <div class="classTile">{$imageLink}
                {$experienceName}
                <span class="tileInstructor">by {$teacherLink}</span> <span
                        class="tileDescription">{$description}</span>

                <div class="tileStudents">
                    {$enrollees}
                </div>
            </div>
            <div class="classCost">
                {$sessionHTML}
            </div>
        </div>
        <!------- end 1 tile -------->
BLOCK;

        }
        ?>
    </div>
    <!------ end 1 row of tiles ----->
</div>
<!---------------------------------------
              Footer
---------------------------------------->
<div class="footer">
    <div class="row">
        <div class="two columns footerlinks discover">
            <h5>Discover</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("how it works",
                                           $this->createUrl("site/page", array('view' => 'howitworks'))); ?>
                </li>
                <li>
                    <?php echo CHtml::link("teach a class", $this->createUrl("experience/create")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("take a class", $this->createUrl("experience/search")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("request a class", $this->createUrl("request/create")); ?>
                </li>

            </ul>
        </div>
        <div class="two columns footerlinks company">
            <h5>Company</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("about us", $this->createUrl("site/page", array('view' => 'about'))); ?>
                </li>
                <li>
                    <?php echo CHtml::link("join the team", $this->createUrl("site/page", array('view' => 'meet'))); ?>
                </li>
                <li>
                    <?php echo CHtml::link("FAQ", $this->createUrl("site/page", array('view' => 'faq'))); ?>
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

<script>
    var initialLoad = true;

    $(document).ready(function ()
    {
        google.load('maps', '3.x', {other_params:'sensor=true', callback:function ()
        {
            $("#map").gmap3({
                map:{
                    options:{
                        mapTypeId         :google.maps.MapTypeId.ROADMAP,
                        mapTypeControl    :false,
                        streetViewControl :false,
                        zoomControlOptions:{
                            position:google.maps.ControlPosition.TOP_RIGHT
                        },
                        panControlOptions :{
                            position:google.maps.ControlPosition.TOP_RIGHT
                        }
                    },
                    events :{
                        idle:function ()
                        {
                            if (initialLoad)
                            {
                                initialLoad = false;
                            }
                            else
                            {
                                return;
                            }

                            var map = $("#map").gmap3("get");
                            var defaultZoomLevel = 13;

                            if (google.loader.ClientLocation)
                            {
                                var lat = google.loader.ClientLocation.latitude;
                                var lon = google.loader.ClientLocation.longitude
                                var center = new google.maps.LatLng(lat, lon);

                                map.setCenter(center);
                                map.setZoom(defaultZoomLevel);
                            }

                            if (navigator.geolocation)
                            {
                                navigator.geolocation.getCurrentPosition(function (position)
                                {
                                    var lat = position.coords.latitude;
                                    var lon = position.coords.longitude;
                                    var center = new google.maps.LatLng(lat, lon);

                                    map.setCenter(center);
                                    map.setZoom(defaultZoomLevel);
                                }, function (error)
                                {
                                    //use error.code to determine what went wrong
                                });
                            }
                        }
                    }
                }
            });

            $.ajax({
                type   :'GET',
                url    :'<?php echo Yii::app()->createAbsoluteUrl("experience/searchResults",
                                                                  array('json' => '1')); ?>',
                success:function (data)
                {
                    //TODO
                    var results = jQuery.parseJSON(data);

                    for(var i in results)
                    {

                    }
                }
            });
        }

        });
    });
</script>
