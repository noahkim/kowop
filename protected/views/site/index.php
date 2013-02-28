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
    <link rel="stylesheet" href="<?php echo Yii::app()->params['siteBase']; ?>/css/foundation.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->params['siteBase']; ?>/css/main.css">

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/modernizr.foundation.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/foundation.min.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/app.js"></script>
    <script src="<?php echo Yii::app()->params['siteBase']; ?>/js/account_toggle.js"></script>

    <script type="text/javascript"
            src="https://www.google.com/jsapi?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->params['siteBase']; ?>/js/gmap3.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->params['siteBase']; ?>/js/jquery.cookie.js"></script>
    <script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>

    <title>Kowop | Neighborhood activites &amp; classes for kids and families</title>
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
                <?php echo CHtml::link('<img src="' . Yii::app()->params['siteBase'] . '/images/logo_small.png">', Yii::app()->homeUrl); ?>
                activities &amp; classes for<br /> kids &amp; families
            </div>
        </div>

        <div class="four columns notlogged">
            <span class="navWhatskowop">
                <?php echo CHtml::link("how's it work?",
                $this->createUrl("site/page", array('view' => 'howitworks'))); ?>
            </span>
            <span class="navPost">
                <?php
                echo CHtml::link("post on Kowop", $this->createUrl("site/page", array('view' => 'postingAgreement')));
                ?>
            </span>
            <span class="navSignup">
                <?php echo CHtml::link("sign up", $this->createUrl("user/create")); ?>
            </span>
            <span class="navLogin">
                <a href="#">log in</a>
            </span>
            <!----- login box dropdown---->
            <div class="loginbox">
                <div class="login">
                    <p>Log in using Facebook</p>
                    <a href="<?php echo Yii::app()->params['siteBase']; ?>/hybridauth/default/login/?provider=facebook">
                        <img src="<?php echo Yii::app()->params['siteBase']; ?>/images/facebook.jpg"> </a>

                    <p>- or -</p>

                    <p>Log in with your Kowop account</p>

                    <?php
                    $loginModel = new LoginForm;

                    $form = $this->beginWidget(
                        'CActiveForm', array(
                        'id' => 'login-form-header',
                        'enableAjaxValidation' => false,
                        'action' => array('site/login'),
                    ));
                    ?>

                    <?php echo $form->textField($loginModel, 'username', array('class' => 'twelve', 'placeholder' => 'login email')); ?>
                    <?php echo $form->passwordField($loginModel, 'password', array('class' => 'twelve', 'placeholder' => 'password')); ?>
                    <a href="#"
                       class="button twelve"
                       onclick="document.forms['login-form-header'].submit(); return false;">Sign in</a>

                    <?php $this->endWidget('CActiveForm'); ?>

                    <p>
                        <a href="#">I forgot</a> | <?php echo CHtml::link('Sign up', array('/user/create')); ?> | <a
                            href="#"
                            class="closelogin">Close</a>
                    </p>
                </div>
            </div>
            <!--- End login box dropdown---->

        </div>
    </div>
    <!----- End Homepage logo and header nav ---------->
    <?php else: ?>
    <?php $user = User::model()->findByPk(Yii::app()->user->id); ?>

    <div class="row">
        <div class="three columns">
            <div class="logo">
                <?php echo CHtml::link('<img src="' . Yii::app()->params['siteBase'] . '/images/logo_small.png">', Yii::app()->homeUrl); ?>
                activities &amp; classes for<br /> kids &amp; families
            </div>
        </div>

        <div class="three columns headernav">
                <span class="notifications">
                    <?php echo CHtml::link(count($user->messages(array('condition' => '`Read` = 0'))),
                    array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
                </span>
            <!----- My account dropdown ------->
            <div class="dropdown">
                <?php
                echo CHtml::link(
                    '<span class="headerAccount">my account</span>',
                    array(
                        '/user/view',
                        'id' => $user->User_ID,
                        's' => AccountSections::Notifications
                    ),
                    array('class' => 'account')
                );
                ?>
                <div class="submenu" style="display: none;">
                    <ul class="root">
                        <li>
                            <?php echo CHtml::link("post on Kowop", $this->createUrl("site/page", array('view' => 'postingAgreement'))); ?>
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

    <!----- Homepage Discovery Map ------>
    <div class="homeMap">
        <div class="row">
            <div class="four columns end">
                <div class="overlayMap">
                    <h2>Discover</h2>

                    <p>
                        It's faster to explore by what you <strong>don't</strong> want, so click on stuff you're
                        <strong>NOT</strong> interested in to narrow down your choices in <strong id='zipcode'>your
                        area</strong> (<a href="#" class="homeChangelocation" id="showChangeLocation">change
                        location</a>) </p>
                    <span class="categoriesMap">
                    </span>

                    <span class="tagsMap">
                    </span>

                    <div class="overlayLinks">
                        <a href="#" class='homeChangelocation reset' onclick='populateData(); return false;'>Reset</a>
                    </div>
                </div>
            </div>
        </div>

        <div id='map' style='width: 100%; height: 550px;'></div>
    </div>
    <!----- homepage discovery map ----->

    <!----- Featured info ------------->
    <div class="homeSearch">
        <div class="row">
            <div class="three columns">
                <label class="inline right">Know what you want? Search here:</label>
            </div>

            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form',
            'action' => array('/experience/search'),
            'enableAjaxValidation' => false, 'method' => 'get',
            'htmlOptions' => array('style' => 'margin: 0;'))); ?>

            <?php $model = new ExperienceSearchForm; ?>

            <div class="five columns">
                <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords,
                'placeholder' => 'What are you looking for?')); ?>
            </div>
            <div class="three columns">
                <?php echo $form->textField($model, 'location', array('value' => $model->location,
                'placeholder' => 'city or zip')); ?>
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
                <?php
                echo CHtml::link("<img src='" . Yii::app()->params['siteBase'] . "/images/icon_homepage_post.gif'/><h5>Post an activity or class</h5>",
                    $this->createUrl("site/page", array('view' => 'postingAgreement')));
                ?>
            </div>
        </div>
        <div class="four columns">
            <div class="homeIntro">
                <?php
                echo CHtml::link(
                    "<img src='" . Yii::app()->params['siteBase'] . "/images/icon_homepage_discover.gif' /><h5>Find something for the whole family</h5>",
                    array('/experience/search')
                );
                ?>
            </div>
        </div>
        <div class="four columns">
            <div class="homeIntro">
                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form-kids',
                'action' => array('/experience/search'),
                'enableAjaxValidation' => false, 'method' => 'get',
                'htmlOptions' => array('style' => 'margin: 0;'))); ?>
                <?php $model = new ExperienceSearchForm; ?>

                <?php
                foreach (ExperienceAppropriateAges::$Lookup as $i => $item)
                {
                    echo "<input type='hidden' name='ExperienceSearchForm[ageRanges][]' value='{$i}' />\n";
                }
                ?>
                <?php $this->endWidget('CActiveForm'); ?>

                <a href="#" onclick="document.forms['search-form-kids'].submit(); return false;">
                    <img src='<?php echo Yii::app()->params['siteBase']; ?>/images/icon_homepage_kids.gif' /><h5>Find classes &amp; activities for
                    kids</h5>
                </a>
            </div>
        </div>
    </div>

    <h3>Staff Picks in <span id='city'>Los Angeles</span></h3>
    <!----------- 1 row of tiles---->
    <div class="row">
        <?php
        $experiences = Experience::model()->active()->current()->findAll(array('select' => '*, rand() as rand',
            'limit' => 4, 'order' => 'rand',));
        foreach ($experiences as $experience)
        {
            $imageHTML = '<img src="' . ($experience->picture ? $experience->picture : 'http://placehold.it/400x300') . '" />';
            $imageLink = CHtml::link($imageHTML, array('/experience/view', 'id' => $experience->Experience_ID));

            $hostName = $experience->createUser->display;
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
            if (strlen($experienceName) > 50)
            {
                $experienceName = substr($experienceName, 0, 50);
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

<?php echo $this->renderPartial('/site/_footer'); ?>

<div id="changeLocation" class="reveal-modal small" style="z-index: 999;">

    <h2>Change location</h2>

    <p>Please enter a new zip code:</p>

    <div class="four columns">
        <input type="text" id='inputZipCode' maxlength="5" />
    </div>

    <button class="button secondary radius"
            id='inputZipCodeChange'
            onclick='changeLocation($("#inputZipCode").val()); $("#changeLocation").trigger("reveal:close");'>Change
    </button>

    <button class="button secondary radius" onclick='detectLocation(); $("#changeLocation").trigger("reveal:close");'>
        Detect
    </button>

    <a class="close-reveal-modal">&#215;</a>
</div>

</body>

<script>
var initialLoad = true;
var excludedTags = [];
var excludedCategories = [];
var defaultZoomLevel = 11;

$(document).ready(function ()
{
    initialize();

    $('a.account, .submenu').hover(
            function ()
            {
                $('.submenu').show();
            },
            function ()
            {
                $('.submenu').hide();
            }
    );

    $('.navLogin').click(function (e)
    {
        e.preventDefault();
        $('.loginbox').slideToggle('fast');
    });

    $('.closelogin').click(function (e)
    {
        e.preventDefault();
        $('.loginbox').slideToggle('fast');
    });
});

function initialize()
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

    $('#inputZipCode').keypress(function (e)
    {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13)
        { //Enter keycode
            $('#inputZipCodeChange').trigger('click');
        }
    });

    $('#showChangeLocation').click(function (e)
    {
        e.preventDefault();
        $('#changeLocation').reveal();
        $("#inputZipCode").focus();
    });
}

function populateData()
{
    excludedTags = [];
    excludedCategories = [];

    $("#map").gmap3({clear:{
        name:'marker'
    }});

    $.ajax({
        type   :'GET',
        url    :'<?php echo Yii::app()->createAbsoluteUrl("experience/searchResults", array("json" => "1", "ExperienceSearchForm[disablePaging]" => "1")); ?>',
        success:function (data)
        {
            var results = jQuery.parseJSON(data);

            var markerValues = [];
            for (var i in results.results)
            {
                var markerValue = {
                    latLng:[results.results[i].lat, results.results[i].lng],
                    //address:results.results[i].location,
                    data  :{
                        link    :results.results[i].link,
                        type    :results.results[i].type,
                        tile    :results.results[i].tile,
                        tags    :results.results[i].tags,
                        category:results.results[i].category
                    },
                    id    :results.results[i].id
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
                            window.location.href = context.data.link;
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
                        var savedLocation = $.cookie('kowop_location');
                        if ((typeof savedLocation != 'undefined') && (savedLocation != null))
                        {
                            changeLocation(savedLocation);
                        }
                        else
                        {
                            detectLocation();
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

function getZipCode(lat, lon)
{
    var url = '<?php echo Yii::app()->createAbsoluteUrl("/site/getLocation"); ?>?latlng=' + lat + ',' + lon;

    $.ajax({
        type   :'GET',
        url    :url,
        success:function (data)
        {
            var zipCode = 'your area';
            var city = '';
            var results = jQuery.parseJSON(data);
            var locationData = results.results[0];

            for (var i in locationData.address_components)
            {
                var component = locationData.address_components[i];

                if (component.types[0] == 'postal_code')
                {
                    zipCode = component.long_name;
                }
                else if (component.types[0] == 'administrative_area_level_2')
                {
                    city = component.long_name;
                }
            }

            if (city.length == 0)
            {
                for (var i in locationData.address_components)
                {
                    var component = locationData.address_components[i];

                    if (component.types[0] == 'locality')
                    {
                        city = component.long_name;
                        break;
                    }
                }
            }

            if (city.length == 0)
            {
                city = 'Los Angeles';
            }

            $('#zipcode').text(zipCode);
            $('#city').text(city);
        }
    });
}

function changeLocation(zipCode)
{
    var url = '<?php echo Yii::app()->createAbsoluteUrl("/site/getLocation"); ?>?address=' + zipCode;

    $.ajax({
        type   :'GET',
        url    :url,
        success:function (data)
        {
            var results = jQuery.parseJSON(data);
            var locationData = results.results[0];

            var lat = locationData.geometry.location.lat;
            var lon = locationData.geometry.location.lng;
            var center = new google.maps.LatLng(lat, lon);
            var city = '';

            for (var i in locationData.address_components)
            {
                var component = locationData.address_components[i];

                if (component.types[0] == 'administrative_area_level_2')
                {
                    city = component.long_name;
                    break;
                }
            }

            if (city.length == 0)
            {
                for (var i in locationData.address_components)
                {
                    var component = locationData.address_components[i];

                    if (component.types[0] == 'locality')
                    {
                        city = component.long_name;
                        break;
                    }
                }
            }

            if (city.length == 0)
            {
                city = 'Los Angeles';
            }

            var map = $("#map").gmap3("get");
            map.setCenter(center);
            map.setZoom(defaultZoomLevel);

            $('#inputZipCode').val('');
            $('#zipcode').text(zipCode);
            $('#city').text(city);

            $.removeCookie('kowop_location');
            $.cookie('kowop_location', zipCode, { expires:30, path:'/' });
        }
    });
}

function detectLocation()
{
    $.removeCookie('kowop_location', {path:'/'});

    var map = $("#map").gmap3("get");

    var lat = geoplugin_latitude();
    var lon = geoplugin_longitude();
    var center = new google.maps.LatLng(lat, lon);

    getZipCode(lat, lon);

    map.setCenter(center);
    map.setZoom(defaultZoomLevel);

    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(function (position)
        {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            var center = new google.maps.LatLng(lat, lon);

            getZipCode(lat, lon);

            map.setCenter(center);
            map.setZoom(defaultZoomLevel);
        }, function (error)
        {
        });
    }
}
</script>
