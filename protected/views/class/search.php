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
            <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords, 'class' => 'homeSearchinput twelve', 'placeholder' => 'What are you looking for?')); ?>
        </div>
        <div class="three columns">
            <input type="text" class="homeSearchinput twelve" placeholder="city,state or zip">
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

<!----- Left Column for search results---->
<div class="nine columns">
    <?php

    echo "<div class='row'>\n";

    $remaining = 0;

    foreach ($results as $i => $item)
    {
        $teacherName = $item->createUser->Teacher_alias ? $item->createUser->Teacher_alias : $item->createUser->fullname;
        $teacherLink = CHtml::link($teacherName, array('/user/view', 'id' => $item->Create_User_ID));
        $description = $item->Description;
        if (strlen($description) > 100)
        {
            $description = substr($description, 0, 100);
            $description .= ' ...';
        }

        $sessionHTML = 'Request';
        if ($item instanceof KClass)
        {
            if (($item->Tuition == null) || ($item->Tuition == 0) || (count($item->sessions) == 0))
            {
                $sessionHTML = 'This class is free!';
            }
            else
            {
                $sessionCount = count($item->sessions);
                $tuition = $item->Tuition * $sessionCount;

                $sessionHTML = "\${$tuition} ( {$sessionCount} lessons )";
            }
        }

        $itemNumber = $i + 1;

        $name = "<h5> {$item->Name} </h5>";
        if ($item instanceof KClass)
        {
            $name = CHtml::link($name, array('/class/view', 'id' => $item->Class_ID));
        }
        elseif ($item instanceof Request)
        {
            $name = CHtml::link($name, array('/request/view', 'id' => $item->Request_ID));
        }

        if ($item instanceof KClass)
        {
            //<span class="ribbon staffpick"></span>

            $imageHTML = "<img src='http://flickholdr.com/400/300/bbq' />";
            if (count($item->contents) > 0)
            {
                $link = $item->contents[0]->Link;
                $imageHTML = "<img src='{$link}' />";
            }

            $enrollees = '';
            foreach ($item->students as $student)
            {
                $picLink = 'http://placeskull.com/100/100/868686';

                if ($student->profilePic != null)
                {
                    $picLink = $student->profilePic;
                }

                $enrollees .= "<img src='{$picLink}' alt='{$student->fullname}' title='{$student->fullname}' />\n";
            }

            echo <<<BLOCK

    <!----------- 1 tile ---------->
    <div id="resultContainer{$i}" class="four columns">
        <div id="result{$i}" class="classTile">
            <span class="tilenumber">{$itemNumber}</span>
            {$imageHTML}
            {$name}
            <span class="tileInstructor">by {$teacherLink}</span>
            <span class="tileDescription">{$description}</span>
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
        elseif ($item instanceof Request)
        {
            $joinLink = CHtml::link('Quick Join', array('/request/join', 'id' => $item->Request_ID));

            $enrollees = '';
            foreach ($item->requestors as $student)
            {
                $picLink = 'http://placeskull.com/100/100/868686';

                if ($student->profilePic != null)
                {
                    $picLink = $student->profilePic;
                }

                $enrollees .= "<img src='{$picLink}' alt='{$student->fullname}' title='{$student->fullname}' />\n";
            }

            echo <<<BLOCK
<!----- 1 tile/result REQUEST ------->
<div id="resultContainer{$i}" class="four columns spacebot20 {$end}">
<span class="ribbon request"></span>
  <div id="result{$i}" class="requestTile">
    <div class="row" class="spacebot10"></div>
  {$name}
  <span class="resultsCategory food">in {$item->category->Name}</span>
  <span class="resultsDescription spacebot10"> {$description} </span>
  <!----- row with the current enrollees thumbnails---->
  <div class="row">
    <div class="twelve columns enrollees">
        {$enrollees}
    </div>
  </div>
  <!---- end enrollees ----->
</div>
    <div class="requestQuickjoin">
    {$joinLink}
    </div>
</div>
<!----- End 1 tile/result REQUEST---->
BLOCK;

        }

        if (($itemNumber % 3) == 0)
        {
            echo "</div>\n";
            echo "<div class='row'>\n";
        }

        $remaining = 3 - ($itemNumber % 3);
    }

    for ($i = 0; $i < $remaining; $i++)
    {
        echo "<div class='four columns'>\n";
        echo "</div>\n";
    }

    echo "</div>\n";
    ?>

    <!--- pagination --->
    <ul class="pagination">
        <li class="arrow unavailable"><a href="">&laquo;</a></li>
        <li class="current"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">4</a></li>
        <li class="unavailable"><a href="">&hellip;</a></li>
        <li><a href="">12</a></li>
        <li><a href="">13</a></li>
        <li class="arrow"><a href="">&raquo;</a></li>
    </ul>
    <!----- end pagination--->
</div>
<!------ end left column------------------>

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
            <?php echo $form->dropDownList($model, 'category', Category::GetCategories(), array('class' => 'stretch')); ?>

            <label>Tution</label>

            <div class="row">
                <div class="six columns">
                    <?php echo $form->textField($model, 'minTuition', array('placeholder' => 'min')); ?>
                </div>
                <div class="six columns">
                    <?php echo $form->textField($model, 'maxTuition', array('placeholder' => 'max')); ?>
                </div>
            </div>
            <label>Next class starts by:</label>
            <?php echo $form->textField($model, 'nextClassStartsBy'); ?>

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
</div>
<!------- end right column --------------->

<!------- end main content container----->
</div>


<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP2gShdAHGCHYoJLjoxhLjZITx5XKHYa4&sensor=false">
</script>
<script type="text/javascript" src="/yii/kowop/js/gmap3.min.js"></script>

<script>
    $(document).ready(function () {
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

                        var map = $("#map").gmap3("get");

                        $("#map").gmap3({
                            get:{
                                name:"marker",
                                all:true,
                                full:true,
                                callback:function (objs) {
                                    $.each(objs, function (i, obj) {
                                        if (!map.getBounds().contains(obj.object.getPosition())) {
                                            $('#resultContainer' + obj.data.index).hide();
                                        }
                                        else {
                                            $('#resultContainer' + obj.data.index).show();
                                        }
                                    });
                                }
                            }
                        });
                    },
                    center_changed:function () {
                        if (!$('#redoSearch').is(':checked')) {
                            return;
                        }

                        var map = $("#map").gmap3("get");

                        $("#map").gmap3({
                            get:{
                                name:"marker",
                                all:true,
                                full:true,
                                callback:function (objs) {
                                    $.each(objs, function (i, obj) {
                                        if (!map.getBounds().contains(obj.object.getPosition())) {
                                            $('#resultContainer' + obj.data.index).hide();
                                        }
                                        else {
                                            $('#resultContainer' + obj.data.index).show();
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            },
            marker:{
                values:[
                <?php
                $markerValues = '';

                foreach ($results as $i => $item)
                {
                    if ($item->location != null)
                    {
                        $address = str_replace("'", "\\'", $item->location->fullAddress);

                        if ($item instanceof KClass)
                        {
                            $link = $this->createUrl('/class/view', array('id' => $item->Class_ID));
                        }
                        elseif ($item instanceof Request)
                        {
                            $link = $this->createUrl('/request/view', array('id' => $item->Request_ID));
                        }

                        $markerValues .= "{ address: '{$address}', data: { index: '{$i}', link: '{$link}' } },\n";
                    }
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
</script>