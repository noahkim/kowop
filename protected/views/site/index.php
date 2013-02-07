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
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/foundation.css">
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/main.css">

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="/ui/sitev2/javascripts/modernizr.foundation.js"></script>
    <script src="/ui/sitev2/javascripts/foundation.min.js"></script>
    <script src="/ui/sitev2/javascripts/app.js"></script>
    <script src="/ui/sitev2/javascripts/account_toggle.js"></script>

    <script type="text/javascript" src="https://www.google.com/jsapi?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->params['siteBase']; ?>/js/gmap3.min.js"></script>

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
            <div class="four columns end">
                <div class="overlayMap">
                    <h2>Discover</h2>

                    <p>
                        Click on stuff you're <strong>not</strong> interested in <strong>90232</strong>
                        (<a href="#" class="homeChangelocation">change location</a>) </p>

                    <span class="categoriesMap">
                    </span>

                    <span class="tagsMap">
                    </span>

                    <div class="row">
                        <div class="six columns">
                            <a href="#" class='homeChangelocation reset' onclick='populateData(); return false;'>Reset</a>
                            <?php /*echo CHtml::link("Reset", array('/site/index'),
                                                   array('class' => 'homeChangelocation reset')); */?>
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

            $hostName = $experience->createUser->Teacher_alias ? $experience->createUser->Teacher_alias : $experience->createUser->fullname;
            if (strlen($hostName) > 25)
            {
                $hostName = substr($hostName, 0, 25);
                $hostName .= ' ...';
            }

            $hostLink = CHtml::link($hostName, array('/user/view', 'id' => $experience->Create_User_ID));

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
                <span class="tileInstructor">by {$hostLink}</span>
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
var excludedTags = [];
var excludedCategories = [];

$(document).ready(function ()
{
    google.load('maps', '3.x', {other_params:'sensor=true', callback:function ()
    {
        $("#map").gmap3({
            map:{
                options :{
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
                callback:function ()
                {
                    populateData();
                }
            }
        });
    }
    });
});

function populateData()
{
    excludedTags = [];
    excludedCategories = [];

    $("#map").gmap3({clear:{
        name:'marker'
    }});

    $.ajax({
        type   :'GET',
        url    :'<?php echo Yii::app()->createAbsoluteUrl("experience/searchResults", array('json' => '1')); ?>',
        success:function (data)
        {
            var results = jQuery.parseJSON(data);

            var markerValues = [];
            for (var i in results.results)
            {
                var markerValue = {
                    address:results.results[i].location,
                    data   :{
                        link    :results.results[i].link,
                        type    :results.results[i].type,
                        tile    :results.results[i].tile,
                        tags    :results.results[i].tags,
                        category:results.results[i].category
                    },
                    id     :results.results[i].id
                };

                markerValues.push(markerValue);
            }


            $("#map").gmap3({
                marker:{
                    values  :markerValues,
                    options :{
                        draggable:false
                    },
                    events  :{
                        click    :function (marker, event, context)
                        {
                            window.location.replace(context.data.link);
                        },
                        mouseover:function (marker, event, context)
                        {
                            $(this).gmap3(
                                    {clear:"overlay"},
                                    {
                                        overlay:{
                                            latLng :marker.getPosition(),
                                            options:{
                                                content:context.data.tile,
                                                offset :{
                                                    x:-1,
                                                    y:-22
                                                }
                                            }
                                        }
                                    });
                        },
                        mouseout :function ()
                        {
                            $(this).gmap3({clear:"overlay"});
                        }
                    },
                    callback:function ()
                    {
                        var map = $("#map").gmap3("get");
                        var defaultZoomLevel = 12;

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
                        else if (google.loader.ClientLocation)
                        {
                            var lat = google.loader.ClientLocation.latitude;
                            var lon = google.loader.ClientLocation.longitude
                            var center = new google.maps.LatLng(lat, lon);

                            map.setCenter(center);
                            map.setZoom(defaultZoomLevel);
                        }

                        populateFilters();
                    }
                }
            });
        }
    });
}

function populateFilters()
{
    $(".categoriesMap").empty();
    $(".tagsMap").empty();

    $("#map").gmap3({
        get:{
            name    :"marker",
            all     :true,
            full    :true,
            callback:function (objs)
            {
                var categories = [];
                var tags = [];

                $.each(objs, function (i, obj)
                {
                    if ($.inArray(obj.data.category, excludedCategories) == -1)
                    {
                        categories.push(obj.data.category);
                    }

                    for (var i in obj.data.tags)
                    {
                        if ($.inArray(obj.data.tags[i], excludedTags) == -1)
                        {
                            tags.push(obj.data.tags[i]);
                        }
                    }
                });

                categories = $.grep(categories, function (v, k)
                {
                    return $.inArray(v, categories) === k;
                });
                categories.sort();

                tags = $.grep(tags, function (v, k)
                {
                    return $.inArray(v, tags) === k;
                });
                tags.sort();

                for (var i in categories)
                {
                    if ($.inArray(categories[i], excludedCategories) == -1)
                    {
                        $(".categoriesMap").append('<a href="#" class="homeTag">' + categories[i] + '</a>');
                    }
                }

                for (var i in tags)
                {
                    if ($.inArray(tags[i], excludedTags) == -1)
                    {
                        $(".tagsMap").append('<a href="#" class="homeTag">' + tags[i] + '</a>');
                    }
                }

                $('.categoriesMap a').click(function ()
                {
                    var category = $(this).text();
                    removeCategory(category);
                });

                $('.tagsMap a').click(function ()
                {
                    var tag = $(this).text();
                    removeTag(tag);
                });
            }
        }
    });
}

function removeTag(tag)
{
    excludedTags.push(tag);

    $("#map").gmap3({
        get:{
            name    :"marker",
            all     :true,
            full    :true,
            callback:function (objs)
            {
                $.each(objs, function (i, obj)
                {
                    var isValid = false;

                    if (obj.data.tags.length == 0)
                    {
                        isValid = true;
                    }
                    else
                    {
                        for (var i in obj.data.tags)
                        {
                            if ($.inArray(obj.data.tags[i], excludedTags) == -1)
                            {
                                isValid = true;
                                break;
                            }
                        }
                    }

                    if (!isValid)
                    {
                        $("#map").gmap3({clear:{
                            id:obj.id
                        }});
                    }
                });

                populateFilters();
            }
        }
    });
}

function removeCategory(category)
{
    excludedCategories.push(category);

    $("#map").gmap3({
        get:{
            name    :"marker",
            all     :true,
            full    :true,
            callback:function (objs)
            {
                $.each(objs, function (i, obj)
                {
                    if ($.inArray(obj.data.category, excludedCategories) != -1)
                    {
                        $("#map").gmap3({clear:{
                            id:obj.id
                        }});
                    }
                });

                populateFilters();
            }
        }
    });
}

</script>
