<!---------------------------------------
                 Search
---------------------------------------->
<div class="bigsearchbar">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form',
    'action' => Yii::app()->createUrl('/experience/search'),
    'enableAjaxValidation' => false, 'method' => 'get')); ?>

    <div class="row">
        <div class="seven columns">
            <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords,
            'class' => 'homeSearchinput twelve searchInput',
            'placeholder' => 'What are you looking for?')); ?>
        </div>
        <div class="three columns">
            <?php echo $form->textField($model, 'location', array('value' => $model->location,
            'class' => 'homeSearchinput twelve searchInput',
            'placeholder' => 'city,state or zip')); ?>
        </div>
        <div class="two columns">
            <a href="#" onclick="document.forms['search-form'].submit(); return false;" class="large button twelve">Search</a>
        </div>
    </div>

    <?php $this->endWidget('CActiveForm'); ?>

</div>

<!--------- main content container------>
<div class="row" id="wrapper">
    <!----- Left Column for search results---->
    <div class="nine columns">

        <!---- Search summary ----->
        <div class="searchSummary">
            <div class="row">
                <div class="twelve columns breadCrumbs">
                    <?php
                    $resultsText = '';

                    if (strlen($model->keywords) == 0)
                    {
                        $resultsText .= "Showing all results";
                    }
                    else
                    {
                        $resultsText .= "Results for \"{$model->keywords}\"";
                    }

                    if (strlen($model->location) > 0)
                    {
                        $resultsText .= " in \"{$model->location}\"";
                    }

                    echo $resultsText;
                    ?>
                </div>
            </div>
        </div>
        <!----- end search summary ------>

        <div id="results"></div>
        <!------ end left column------------------>
    </div>

    <!------ right column for map, etc.------->
    <div class="three columns">
        <div class="searchSidebar">
            <div class="spacebot10">
                <?php
                echo CHtml::link("post your experience",
                    $this->createUrl("site/page", array('view' => 'postingAgreement')),
                    array('class' => 'large button twelve')
                );
                ?>
            </div>
            <div class="spacebot10">
                <?php echo CHtml::link("make a request", $this->createUrl("request/create"),
                array('class' => 'large button twelve')); ?>
            </div>
            <div class="searchMap">

                <label for="redoSearch"> <input type="checkbox" id="redoSearch" onclick="redoSearchWithMap();"> <span
                        class="custom checkbox"></span> Redo search when map moves? </label>

                <div id="map" style="width: 100%; height: 200px;"></div>
            </div>


            <!---- Sidebar box for filters----->
            <div class="sidebarBox">
                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form-filters',
                'action' => Yii::app()->createUrl('/experience/search'),
                'enableAjaxValidation' => false,
                'method' => 'get')); ?>

                <fieldset>
                    <legend>Age Range</legend>

                    <div class="checkboxDiv">
                        <?php
                        $ageGroups = ExperienceAppropriateAges::$Lookup;
                        $ageGroups[0] = 'Whole Family';
                        ksort($ageGroups);

                        if ($model->ageRanges == null)
                        {
                            $model->ageRanges = array(0);
                        }

                        echo $form->checkBoxList($model, 'ageRanges', $ageGroups,
                            array(
                                'template' => '{input} {label} <br />',
                                'separator' => "\n",
                                'class' => 'ageChoice filterInput',
                            )
                        );

                        ?>
                    </div>
                </fieldset>

                <label>Class or Activity?</label>

                <?php
                $experienceType = ExperienceType::$Lookup;
                $experienceType[0] = 'Both';
                ksort($experienceType);

                echo $form->dropDownList($model, 'experienceType', $experienceType, array('class' => 'twelve filterInput'));
                ?>

                <label>Individuals or Businesses</label>

                <?php
                $posterType = UserPosterType::$Lookup;
                $posterType[0] = 'Both';
                ksort($posterType);

                echo $form->dropDownList($model, 'posterType', $posterType, array('class' => 'twelve filterInput'));
                ?>

                <label>Category</label>

                <?php
                $categories = Category::GetCategories();
                $categories[0] = 'Any';
                ksort($categories);

                echo $form->dropDownList($model, 'category', $categories, array('class' => 'twelve filterInput'));
                ?>

                <label>Price</label>

                <div class="row">
                    <div class="six columns">
                        <?php echo $form->textField($model, 'minPrice', array('placeholder' => 'min', 'class' => 'filterInput')); ?>
                    </div>
                    <div class="six columns">
                        <?php echo $form->textField($model, 'maxPrice', array('placeholder' => 'max', 'class' => 'filterInput')); ?>
                    </div>
                </div>

                <label>Available from:</label>

                <div class="row">
                    <div class="six columns">
                        <?php echo $form->textField($model, 'start', array('id' => 'start', 'placeholder' => 'date', 'class' => 'filterInput')); ?>
                    </div>
                    <div class="six columns">
                        <?php echo $form->textField($model, 'end', array('id' => 'end', 'placeholder' => 'date', 'class' => 'filterInput')); ?>
                    </div>
                </div>

                <?php $this->endWidget('CActiveForm'); ?>

                <div class="row">
                    <div class="twelve columns">
                        <a href="#" onclick="resetFilters(); return false;" class="button twelve">Reset</a>
                    </div>
                </div>
            </div>
            <!----- End Sidebar Box----->

        </div>
        <!------- end right column --------------->
    </div>
    <!------- end main content container----->
</div>

<style>
    .checkboxDiv label {
        display: inline;
    }
</style>

<script type="text/javascript" src="https://www.google.com/jsapi?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['siteBase']; ?>/js/gmap3.min.js"></script>

<script>
var timeoutHandle;
var loadAll = false;
var defaultZoomLevel = 10;

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
                events  :{
                    zoom_changed  :function ()
                    {
                        if (!$('#redoSearch').is(':checked'))
                        {
                            return;
                        }

                        clearTimeout(timeoutHandle);
                        timeoutHandle = setTimeout(redoSearchWithMap, 500);
                    },
                    center_changed:function ()
                    {
                        if (!$('#redoSearch').is(':checked'))
                        {
                            return;
                        }

                        clearTimeout(timeoutHandle);
                        timeoutHandle = setTimeout(redoSearchWithMap, 500);
                    }
                },
                callback:function ()
                {
                    populateResults();
                }
            }
        });
    }});

    $('.searchInput').keypress(function (e)
    {
        if (e.which == 13)
        {
            document.forms['search-form'].submit();
        }
    });

    $('#start').Zebra_DatePicker({
        direction:1,
        format   :'m/d/Y',
        pair     :$('#end'),
        onSelect :function ()
        {
            clearTimeout(timeoutHandle);
            timeoutHandle = setTimeout(populateResults, 500);
        },
        onClear  :function ()
        {
            clearTimeout(timeoutHandle);
            timeoutHandle = setTimeout(populateResults, 500);
        }
    });

    $('#end').Zebra_DatePicker({
        direction:1,
        format   :'m/d/Y',
        onSelect :function ()
        {
            clearTimeout(timeoutHandle);
            timeoutHandle = setTimeout(populateResults, 500);
        },
        onClear  :function ()
        {
            clearTimeout(timeoutHandle);
            timeoutHandle = setTimeout(populateResults, 500);
        }
    });

    $('#redoSearch').change(function ()
    {
        if (!$('#redoSearch').is(':checked'))
        {
            populateResults();
        }
    });

    $('input.ageChoice').click(function ()
    {
        var value = $(this).val();
        if (value == 0)
        {
            $('input.ageChoice').each(function ()
            {
                if ($(this).val() > 0)
                {
                    $(this).removeAttr('checked');
                }
            });
        }
        else
        {
            $("input.ageChoice[value='0']").removeAttr('checked');
        }

        if ($('input.ageChoice:checked').length == 0)
        {
            $("input.ageChoice[value='0']").prop('checked', true);
        }
    });

    $('.filterInput').change(function ()
    {
        clearTimeout(timeoutHandle);
        timeoutHandle = setTimeout(populateResults, 500);
    });

    $('input.filterInput[type=text]').keypress(function ()
    {
        clearTimeout(timeoutHandle);
        timeoutHandle = setTimeout(populateResults, 500);
    });
});

function redoSearchWithMap()
{
    if (loadAll)
    {
        return;
    }

    var map = $("#map").gmap3("get");

    var included = [];

    $("#map").gmap3({
        get:{
            name    :"marker",
            all     :true,
            full    :true,
            callback:function (objs)
            {
                $.each(objs, function (i, obj)
                {
                    if (map.getBounds().contains(obj.object.getPosition()))
                    {
                        included.push({
                            type:obj.data.type,
                            id  :obj.id
                        });
                    }
                });

                var includedString = 'ExperienceSearchForm%5BincludedResults%5D=' + JSON.stringify(included);

                var query = '<?php echo http_build_query($_GET); ?>';
                query += '&' + includedString;

                var filters = $('#search-form-filters').serialize();
                if (filters.length > 0)
                {
                    query += '&' + filters;
                }

                console.log(query);

                $.ajax({
                    type   :'POST',
                    url    :'<?php echo Yii::app()->createAbsoluteUrl("experience/searchResults"); ?>',
                    data   :query,
                    success:function (data)
                    {
                        $('#results').html(data);
                    }
                });
            }
        }
    });
}

function populateResults()
{
    loadAll = true;
    var query = '<?php echo http_build_query($_GET); ?>';
    var filters = $('#search-form-filters').serialize();

    if (filters.length > 0)
    {
        query += '&' + filters;
    }

    $.ajax({
        type   :'POST',
        url    :'<?php echo Yii::app()->createAbsoluteUrl("experience/searchResults"); ?>',
        data   :query,
        success:function (data)
        {
            $('#results').html(data);

            $("#map").gmap3({clear:{
                name:'marker'
            }});

            $.ajax({
                type   :'GET',
                url    :'<?php echo Yii::app()->createAbsoluteUrl("experience/searchResults",
                    array('json' => '1')); ?>',
                data   :query,
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
                                category:results.results[i].category,
                            },
                            id     :results.results[i].id
                        };

                        markerValues.push(markerValue);
                    }

                    $("#map").gmap3({
                        marker :{
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
                                    $('#result' + context.data.type + context.id).addClass('maphover');
                                },
                                mouseout :function (marker, event, context)
                                {
                                    $('#result' + context.data.type + context.id).removeClass('maphover');
                                }
                            },
                            callback:function ()
                            {
                                var map = $("#map").gmap3("get");

                                var savedLocation = $.cookie('kowop_location');
                                if ((typeof savedLocation != 'undefined') && (savedLocation != null))
                                {
                                    changeLocation(savedLocation);
                                }
                                else
                                {
                                    detectLocation();
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
                                else if (google.loader.ClientLocation)
                                {
                                    var lat = google.loader.ClientLocation.latitude;
                                    var lon = google.loader.ClientLocation.longitude
                                    var center = new google.maps.LatLng(lat, lon);

                                    map.setCenter(center);
                                    map.setZoom(defaultZoomLevel);
                                }

                                loadAll = false;
                            }
                        },
                        autofit:{}
                    });
                }
            });
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

            var map = $("#map").gmap3("get");
            map.setCenter(center);
            map.setZoom(defaultZoomLevel);

            $.removeCookie('kowop_location');
            $.cookie('kowop_location', zipCode);
        }
    });
}

function detectLocation()
{
    $.removeCookie('kowop_location');

    var map = $("#map").gmap3("get");

    var lat = geoplugin_latitude();
    var lon = geoplugin_longitude();
    var center = new google.maps.LatLng(lat, lon);

    map.setCenter(center);
    map.setZoom(defaultZoomLevel);

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
        });
    }
}

function resetFilters()
{
    $('#search-form-filters')[0].reset();
    populateResults();
}
</script>
