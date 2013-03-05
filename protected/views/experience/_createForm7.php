<!-----------title---------->
<div class="createLastLook">
    <div class="row">
        <div class="twelve columns">
            <h1>One Last Look</h1>

            <p>This is how your experience will appear. Just make sure everything looks right, then post. Don't worry if
                you missed a detail or need to change something in the future. You can always come back to it and edit
                it later.</p>

            <?php $form = $this->beginWidget('CActiveForm',
            array('id' => 'experience-create-form', 'enableAjaxValidation' => false,
                'stateful' => true,
                'htmlOptions' => array('style' => 'margin: 0;'))); ?>

            <?php echo CHtml::submitButton('Make Changes',
            array('name' => 'change', 'class' => 'button large radius')); ?>
            <?php echo CHtml::submitButton("Let's post it!", array('name' => 'submit', 'id' => 'submit',
            'class' => 'button large primary radius')); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>


<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns classdetails">
        <!---------------------------------------
                     Main class details
        ---------------------------------------->

        <!----- Experience Title------->
        <div class="row">
            <div class="twelve columns">
                <h1><?php echo $model->Name; ?></h1>
            </div>
        </div>
        <!-------- main class details ---->
        <div class="detailsMain">
            <div class="row">
                <div class="six columns">
                    <div class="slider-wrapper theme-default">
                        <div id="slider" class="nivoSlider">
                            <?php

                            if (isset($model->imageFiles) && is_array($model->imageFiles))
                            {
                                foreach ($model->imageFiles as $imageFile)
                                {
                                    $imageLink = Yii::app()->params['siteBase'] . '/temp/' . $imageFile;
                                    echo "<img src='{$imageLink}' data-thumb='{$imageLink}' alt=''/>\n";
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <!---------- Middle column ------------------->
                <div class="two columns">
                    <div class=" infoTuition">
                    <span class="detailPrice">
                        <?php if ($model->Price) : ?>

                        <sup class="dollarsign">$</sup>
                        <?php echo $model->Price; ?>

                        <?php else: ?>

                        Free

                        <?php endif;?>
                    </span>
                    </div>

                    <?php
                    echo "<img src='{$user->profilePic}' class='detailsInstructorpic' />\n";
                    ?>

                    <div class="detailsInstructor">
                        Host
                        <span class="detailsName">
                            <?php echo CHtml::link($user->display, array('/user/view', 'id' => $user->User_ID)); ?>
                        </span>
                    </div>
                </div>

                <!------------ Right column ------------------>
                <div class="four columns">

                    <?php if ($model->MaxPerPerson != null) : ?>

                    <div class="row">
                        <div class="four columns">
                            <label class="inline right">Quantity</label>
                        </div>
                        <div class="eight columns">
                            <select>
                                <?php
                                for ($i = 1; $i <= $model->MaxPerPerson; $i++)
                                {
                                    echo "<option>{$i}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <?php endif; ?>

                    <div class="spacebot10">
                        <a href="#" class="button large twelve enrollButton">Sign up</a>
                    </div>
                    <div class="detailsNextSession">
                        <div class="enrollees">
                            <h5>Recently signed up</h5>
                            <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
                            <a href="#"><img src="http://placeskull.com/100/100/d70060"></a>
                            <a href="#"><img src="http://placeskull.com/100/100/113f8c"></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!---------------------------------------
                     Left Column
        ---------------------------------------->
        <div class="row">
            <div class="six columns ">
                <dl class="tabs">
                    <dd class="active"><a href="#simple1">Description</a></dd>
                </dl>
                <ul class="tabs-content">
                    <li class="active" id="simple1Tab">
                        <h5>Description</h5>

                        <p>
                            <?php echo $model->Description; ?>
                        </p>

                        <h5>What to expect</h5>

                        <p>
                            <?php echo $model->Offering; ?>
                        </p>

                        <h5>Fine Print</h5>

                        <p>
                            <?php echo $model->FinePrint; ?>
                        </p>
                    </li>
                    <li id="simple2Tab">This is where instagram photos will go!</li>
                </ul>
            </div>
            <!--- end left column---->

            <!---------------------------------------
                       right column
            ---------------------------------------->
            <div class="six columns">
                <div class="row">
                    <div class="twelve columns spacebot10 detailsMap">
                        <div id="map"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!------- end main content container----->
</div>

<style>
    #map {
        width: 100%;
        height: 200px;
    }
</style>

<?php
$address = $model->locationStreet . ', ' . $model->locationCity . ', ' . Location::GetStates()[$model->locationState];
?>

<script type="text/javascript">
    $(document).ready(function ()
    {
        google.load('maps', '3.x', {other_params:'sensor=true', callback:function ()
        {
            $("#map").gmap3({
                map   :{
                    address :'<?php echo $address; ?>',
                    options :{
                        mapTypeId         :google.maps.MapTypeId.ROADMAP,
                        mapTypeControl    :false,
                        streetViewControl :false,
                        zoomControlOptions:{
                            position:google.maps.ControlPosition.TOP_RIGHT
                        },
                        panControlOptions :{
                            position:google.maps.ControlPosition.TOP_RIGHT
                        },
                        zoom              :15

                    },
                    callback:function ()
                    {
                    }
                },
                marker:{
                    address:'<?php echo $address; ?>'
                }
            });
        }});

        $('#slider').nivoSlider({
            effect          :'fade', // Specify sets like: 'fold,fade,sliceDown'
            slices          :15, // For slice animations
            boxCols         :8, // For box animations
            boxRows         :4, // For box animations
            animSpeed       :1000, // Slide transition speed
            pauseTime       :4000, // How long each slide will show
            startSlide      :0, // Set starting Slide (0 index)
            directionNav    :true, // Next & Prev navigation
            controlNav      :true, // 1,2,3... navigation
            controlNavThumbs:true, // Use thumbnails for Control Nav
            pauseOnHover    :true, // Stop animation while hovering
            manualAdvance   :false, // Force manual transitions
            prevText        :'Prev', // Prev directionNav text
            nextText        :'Next', // Next directionNav text
            randomStart     :false, // Start on a random slide
            beforeChange    :function ()
            {
            }, // Triggers before a slide transition
            afterChange     :function ()
            {
            }, // Triggers after a slide transition
            slideshowEnd    :function ()
            {
            }, // Triggers after all slides have been shown
            lastSlide       :function ()
            {
            }, // Triggers when last slide is shown
            afterLoad       :function ()
            {
            } // Triggers when slider has loaded
        });
    });
</script>

