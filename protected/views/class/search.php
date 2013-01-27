<!---------------------------------------
                 Search
---------------------------------------->
<div class="bigsearchbar">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    'action' => Yii::app()->createUrl('/class/search'),
    'enableAjaxValidation' => false,
    'method' => 'get'
)); ?>

    <div class="row">
        <div class="seven columns">
            <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords, 'class' => 'homeSearchinput twelve searchInput', 'placeholder' => 'What are you looking for?')); ?>
        </div>
        <div class="three columns">
            <input type="text" class="homeSearchinput twelve searchInput" placeholder="city,state or zip">
        </div>
        <div class="two columns">
            <a href="#" onclick="document.forms['search-form'].submit(); return false;"
               class="large button twelve">Search</a>
        </div>
    </div>

    <?php $this->endWidget('CActiveForm'); ?>

</div>

<!--------- main content container------>
<div class="row" id="wrapper">

    <div id="results">
        <?php echo $this->renderPartial('_searchResults', array('model' => $model, 'results' => $results)); ?>
    </div>

    <!------ right column for map, etc.------->
    <div class="three columns">
        <div class="searchSidebar">
            <div class="spacebot10">
                <?php echo CHtml::link("teach a class", $this->createUrl("class/create"), array('class' => 'large button twelve')); ?>
            </div>
            <div class="spacebot10">
                <?php echo CHtml::link("request a class", $this->createUrl("request/create"), array('class' => 'large button twelve')); ?>
            </div>
            <div class="searchMap">

                <label for="redoSearch">
                    <input type="checkbox" id="redoSearch">
                    <span class="custom checkbox"></span>
                    Redo search when map moves?
                </label>

                <div id="map" style="width: 100%; height: 200px;"></div>
            </div>
            <!---- Sidebar box for filters----->
            <div class="sidebarBox">
                <h5>Organize Results</h5>

                <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'search-form-filters',
                'action' => Yii::app()->createUrl('/class/search'),
                'enableAjaxValidation' => false,
                'method' => 'get'
            )); ?>

                <label>Open seats in next session</label>
                <?php echo $form->dropDownList($model, 'seatsInNextClass', ClassSearchForm::$seatsInNextClassLookup, array('class' => 'stretch')); ?>

                <label>Category</label>
                <?php
                    $categories = Category::GetCategories();
                    array_unshift($categories, array(0 => 'Any'));

                    echo $form->dropDownList($model, 'category', $categories, array('class' => 'stretch'));
                ?>

                <label>Tuition</label>

                <div class="row">
                    <div class="six columns">
                        <?php echo $form->textField($model, 'minTuition', array('placeholder' => 'min')); ?>
                    </div>
                    <div class="six columns">
                        <?php echo $form->textField($model, 'maxTuition', array('placeholder' => 'max')); ?>
                    </div>
                </div>
                <label>Next class starts by:</label>
                <?php echo $form->textField($model, 'nextClassStartsBy', array('id' => 'nextClassStartsBy')); ?>

                <?php $this->endWidget('CActiveForm'); ?>

                <div class="row">
                    <div class="six columns">
                        <a href="#" onclick="document.forms['search-form-filters'].submit(); return false;"
                           class="button twelve">Apply</a>
                    </div>
                    <div class="six columns">
                        <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'search-form-filters-blank',
                        'action' => Yii::app()->createUrl('/class/search'),
                        'enableAjaxValidation' => false,
                        'method' => 'get',
                        'htmlOptions' => array('style' => 'margin: 0;')
                    )); ?>
                        <?php $this->endWidget('CActiveForm'); ?>
                        <a href="#" onclick="document.forms['search-form-filters-blank'].submit(); return false;"
                           class="button twelve">Reset</a>
                    </div>
                </div>
            </div>
            <!----- End Sidebar Box----->
        </div>
        <!------- end right column --------------->
    </div>

    <!------- end main content container----->
</div>


<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4&sensor=false">
</script>
<script type="text/javascript" src="/yii/kowop/js/gmap3.min.js"></script>

<script>
    var timeoutHandle;

    $(document).ready(function () {

        $('.searchInput').keypress(function (e) {
            if (e.which == 13) {
                document.forms['search-form'].submit();
            }
        });

        $('#nextClassStartsBy').Zebra_DatePicker({
            direction:1,
            format:'m/d/Y'
        });

        $('#redoSearch').change(function () {
            if (!$('#redoSearch').is(':checked')) {
                document.forms['search-form'].submit();
            }
        });

        $("#map").gmap3({
            map:{
                options:{
                    mapTypeId:google.maps.MapTypeId.ROADMAP,
                    mapTypeControl:false,
                    zoom:5
                },
                events:{
                    zoom_changed:function () {
                        if (!$('#redoSearch').is(':checked')) {
                            return;
                        }

                        clearTimeout(timeoutHandle);
                        timeoutHandle = setTimeout(redoSearchWithMap, 500);
                    },
                    center_changed:function () {
                        if (!$('#redoSearch').is(':checked')) {
                            return;
                        }

                        clearTimeout(timeoutHandle);
                        timeoutHandle = setTimeout(redoSearchWithMap, 500);
                    }
                }
            },
            marker:{
                values:[
                <?php
                $markerValues = '';

                foreach ($results as $i => $item)
                {
                    $type = 'class';
                    $id = 0;
                    if ($item instanceof KClass)
                    {
                        $address = str_replace("'", "\\'", $item->location->fullAddress);

                        $link = $this->createUrl('/class/view', array('id' => $item->Class_ID));
                        $id = $item->Class_ID;
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
                events:{
                    mouseover:function (marker, event, context) {
                        var index = context.data.index;
                        $('#result' + index).css('border-width', '2');
                        $('#result' + index).css('border-color', 'blue');
                    },
                    mouseout:function (marker, event, context) {
                        var index = context.data.index;
                        $('#result' + index).css('border-width', '');
                        $('#result' + index).css('border-color', '');
                    },
                    click:function (marker, event, context) {
                        window.location.replace(context.data.link);
                    }
                }
            },
            autofit:{}
        });
    });

    function redoSearchWithMap() {
        var map = $("#map").gmap3("get");

        var included = [];

        $("#map").gmap3({
            get:{
                name:"marker",
                all:true,
                full:true,
                callback:function (objs) {
                    $.each(objs, function (i, obj) {
                        if (map.getBounds().contains(obj.object.getPosition())) {
                            included.push({
                                type:obj.data.type,
                                id:obj.data.id
                            });
                        }
                    });
                }
            }
        });

        var query = '<?php echo http_build_query($_GET); ?>';
        var includedString = '&ClassSearchForm[includedResults]=' + JSON.stringify(included);
        query += includedString;

        $.ajax({
            type:'POST',
            url:'<?php echo Yii::app()->createAbsoluteUrl("class/searchResults"); ?>',
            data:query,
            success:function (data) {
                $('#results').html(data);
            }
        });


    }
</script>