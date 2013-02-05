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
            <input type="text" class="homeSearchinput twelve searchInput" placeholder="city,state or zip">
        </div>
        <div class="two columns">
            <a href="#" onclick="document.forms['search-form'].submit(); return false;" class="large button twelve">Search</a>
        </div>
    </div>

    <?php $this->endWidget('CActiveForm'); ?>

</div>

<!--------- main content container------>
<div class="row" id="wrapper">

    <div id="results">
        <!----- Left Column for search results---->
        <div class="nine columns">

            <!---- Search summary ----->
            <div class="searchSummary">
                <div class="row">
                    <div class="twelve columns breadCrumbs">
                        results for "<?php echo $model->keywords; ?>" in "<?php echo $model->location; ?>"
                    </div>
                </div>
            </div>
            <!----- end search summary ------>

            <?php echo $this->renderPartial('_searchResults', array('model' => $model, 'results' => $results)); ?>

        </div>
        <!------ end left column------------------>
    </div>

    <!------ right column for map, etc.------->
    <div class="three columns">
        <div class="searchSidebar">
            <div class="spacebot10">
                <?php echo CHtml::link("I'd like to post", $this->createUrl("experience/create"),
                                       array('class' => 'large button twelve')); ?>
            </div>
            <div class="spacebot10">
                <?php echo CHtml::link("make a request", $this->createUrl("request/create"),
                                       array('class' => 'large button twelve')); ?>
            </div>
            <div class="searchMap">

                <label for="redoSearch"> <input type="checkbox" id="redoSearch"> <span class="custom checkbox"></span>
                    Redo search when map moves? </label>

                <div id="map" style="width: 100%; height: 200px;"></div>
            </div>
            <!---- Sidebar box for filters----->
            <div class="sidebarBox">
                <h5>Organize Results</h5>

                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form-filters',
                                                                      'action' => Yii::app()->createUrl('/experience/search'),
                                                                      'enableAjaxValidation' => false,
                                                                      'method' => 'get')); ?>

                <label>Category</label>
                <?php
                $categories = Category::GetCategories();
                $categories[0] = 'Any';
                ksort($categories);

                echo $form->dropDownList($model, 'category', $categories, array('class' => 'stretch'));
                ?>

                <label>Price</label>

                <div class="row">
                    <div class="six columns">
                        <?php echo $form->textField($model, 'minTuition', array('placeholder' => 'min')); ?>
                    </div>
                    <div class="six columns">
                        <?php echo $form->textField($model, 'maxTuition', array('placeholder' => 'max')); ?>
                    </div>
                </div>

                <label>Available from:</label>

                <div class="six columns">
                    <?php echo $form->textField($model, 'nextClassStartsBy',
                                                array('id' => 'nextClassStartsBy', 'placeholder' => 'date',
                                                      'class' => 'twelve')); ?>
                </div>

                <div class="six columns">
                    <input type="text" placeholder="date" id="nextClassEndsBy" class='twelve' />
                </div>

                <?php $this->endWidget('CActiveForm'); ?>

                <div class="row">
                    <div class="six columns">
                        <a href="#" onclick="document.forms['search-form-filters'].submit(); return false;" class="button twelve">Apply</a>
                    </div>
                    <div class="six columns">
                        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form-filters-blank',
                                                                              'action' => Yii::app()->createUrl('/experience/search'),
                                                                              'enableAjaxValidation' => false,
                                                                              'method' => 'get',
                                                                              'htmlOptions' => array('style' => 'margin: 0;'))); ?>
                        <?php $this->endWidget('CActiveForm'); ?>
                        <a href="#" onclick="document.forms['search-form-filters-blank'].submit(); return false;" class="button twelve">Reset</a>
                    </div>
                </div>
            </div>
            <!----- End Sidebar Box----->

            <!---- Sidebar box for Kowop Kids----->
            <div class="sidebarBox">
                <div class="row">
                    <div class="twelve columns text-center">
                        Looking for a class or activity for kids? Try<br /><br />
                        <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_kids.png">', array('/kids')); ?>
                    </div>
                </div>
            </div>
            <!---- end sidebar box---->

        </div>
        <!------- end right column --------------->
    </div>

    <!------- end main content container----->
</div>

<script type="text/javascript" src="https://www.google.com/jsapi?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4"></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4&sensor=false"></script>-->
<script type="text/javascript" src="/yii/kowop/js/gmap3.min.js"></script>

<script>
    var timeoutHandle;

    $(document).ready(function ()
    {
        google.load('maps', '3.x', {other_params:'sensor=true', callback:function ()
        {
            $("#map").gmap3({
                map   :{
                    options:{
                        mapTypeId     :google.maps.MapTypeId.ROADMAP,
                        mapTypeControl:false,
                        zoom          :5
                    },
                    events :{
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
                    }
                },
                marker:{
                    values :[
                    <?php
                    $markerValues = '';

                    foreach ($results as $i => $item)
                    {
                        $type = 'class';
                        $id = 0;
                        if ($item instanceof Experience)
                        {
                            $address = str_replace("'", "\\'", $item->location->fullAddress);

                            $link = $this->createUrl('/experience/view', array('id' => $item->Experience_ID));
                            $id = $item->Experience_ID;
                        }
                        elseif ($item instanceof Request)
                        {
                            $address = $item->Zip;

                            $link = $this->createUrl('/request/view', array('id' => $item->Request_ID));
                            $id = $item->Request_ID;
                            $type = 'request';
                        }

                        $markerValues .= "{ address: '{$address}', data: { index: '{$i}', link: '{$link}', 'type': '{$type}', 'id': {$id} } },\n";
                    }

                    $markerValues = Utils::str_lreplace(',', '', $markerValues);
                    echo $markerValues;
                    ?>
                    ],
                    options:{
                        draggable:false
                    },
                    events :{
                        mouseover:function (marker, event, context)
                        {
                            var index = context.data.index;
                            $('#result' + index).css('border-width', '2');
                            $('#result' + index).css('border-color', 'blue');
                        },
                        mouseout :function (marker, event, context)
                        {
                            var index = context.data.index;
                            $('#result' + index).css('border-width', '');
                            $('#result' + index).css('border-color', '');
                        },
                        click    :function (marker, event, context)
                        {
                            window.location.replace(context.data.link);
                        }
                    }
                }
                /*autofit:{}*/
            });

            if (google.loader.ClientLocation)
            {
                var lat = google.loader.ClientLocation.latitude;
                var lon = google.loader.ClientLocation.longitude
                var center = new google.maps.LatLng(lat, lon);

                var map = $("#map").gmap3("get");
                map.setCenter(center);
            }

            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function (position)
                {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    var center = new google.maps.LatLng(lat, lon);

                    var map = $("#map").gmap3("get");
                    map.setCenter(center);
                }, function (error)
                {
                    alert(error.code);
                    //use error.code to determine what went wrong
                });
            }

        }});

        $('.searchInput').keypress(function (e)
        {
            if (e.which == 13)
            {
                document.forms['search-form'].submit();
            }
        });

        $('#nextClassStartsBy').Zebra_DatePicker({
            direction:1,
            format   :'m/d/Y'
        });

        $('#nextClassEndsBy').Zebra_DatePicker({
            direction:1,
            format   :'m/d/Y'
        });

        $('#redoSearch').change(function ()
        {
            if (!$('#redoSearch').is(':checked'))
            {
                document.forms['search-form'].submit();
            }
        });
    });

    function redoSearchWithMap()
    {
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
                                id  :obj.data.id
                            });
                        }
                    });
                }
            }
        });

        var query = '<?php echo http_build_query($_GET); ?>';
        var includedString = '&ExperienceSearchForm[includedResults]=' + JSON.stringify(included);
        query += includedString;

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
</script>
