<?php if ($section == 'rightColumnTop') : ?>

<?php if ($model->hasSessions && ($model->nextAvailableSession != null)) : ?>

    <div class="four columns">
        <div class="detailsNextSession">
            <h5>Next session taking place on</h5>
            <span class="nextDay">
                <?php echo date('D', strtotime($model->nextAvailableSession->Start)); ?>
            </span>
            <span class="nextDate">
                <?php echo substr(date('F', strtotime($model->nextAvailableSession->Start)), 0, 3); ?>
                <?php echo date('j', strtotime($model->nextAvailableSession->Start)); ?>
            </span>
            <span class="nextTime">
                <?php echo date('ga', strtotime($model->nextAvailableSession->Start)); ?>
                -
                <?php echo date('ga', strtotime($model->nextAvailableSession->End)); ?>
            </span>

            <div class="enrollees">
                <h5>People in the next session</h5>

                <?php
                foreach ($model->nextAvailableSession->enrolled as $enrollee)
                {
                    echo CHtml::link("<img src='{$enrollee->profilePic}' />", array('/user/view', 'id' => $enrollee->User_ID));
                }
                ?>
            </div>
        </div>

        <div class="spacebot10">
            <?php echo CHtml::link("Edit experience details",
            array('/experience/update', 'id' => $model->Experience_ID),
            array('class' => 'button large twelve')); ?>
        </div>

        <div class="spacebot10">
            <?php echo CHtml::link("Scheduling",
            array('/experience/updateScheduling', 'id' => $model->Experience_ID),
            array('class' => 'button large twelve')); ?>
        </div>

        <div>
            <a href="#" class="button twelve large" data-reveal-id="confirmCancel">Cancel Experience</a>
        </div>

        <div class="sharebuttons">
                    <span>
                        <?php
                        $shareURL = urlencode($this->createAbsoluteUrl('/experience/view', array('id' => $model->Experience_ID)));
                        $shareImage = $model->picture;
                        if (strncmp($shareImage, '/', strlen('/')) == 0)
                        {
                            $shareImage = 'http://' . $_SERVER['SERVER_NAME'] . $shareImage;
                        }
                        $shareImage = urlencode($shareImage);
                        $shareName = urlencode($model->Name);
                        ?>

                        <a data-pin-config="beside"
                           href="//pinterest.com/pin/create/button/?url=<?php echo $shareURL; ?>&media=<?php echo $shareImage; ?>&description=<?php echo $shareName; ?>"
                           data-pin-do="buttonPin">

                            <img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />

                        </a>
                    </span>

            <div class="fb-like"
                 data-send="true"
                 data-layout="button_count"
                 data-width="100"
                 data-show-faces="false"></div>

            <!--- facebook like script---->
            <div id="fb-root"></div>
            <script>
                (function (d, s, id)
                {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                    {
                        return;
                    }
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
        </div>
    </div>

    <?php else : ?>

    <div class="four columns">
        <div class="detailsNextSession">
            <div class="enrollees">
                <h5>Recently signed up</h5>
                <?php
                foreach ($model->enrolled as $enrollee)
                {
                    echo CHtml::link("<img src='{$enrollee->profilePic}' />", array('/user/view', 'id' => $enrollee->User_ID));
                }
                ?>
            </div>
        </div>

        <div class="spacebot10">
            <?php echo CHtml::link("Edit experience details",
            array('/experience/update', 'id' => $model->Experience_ID),
            array('class' => 'button large twelve')); ?>
        </div>

        <div>
            <a href="#" class="button twelve large" data-reveal-id="confirmCancel">Cancel Experience</a>
        </div>

        <div class="sharebuttons">
                    <span>
                        <?php
                        $shareURL = urlencode($this->createAbsoluteUrl('/experience/view', array('id' => $model->Experience_ID)));
                        $shareImage = $model->picture;
                        if (strncmp($shareImage, '/', strlen('/')) == 0)
                        {
                            $shareImage = 'http://' . $_SERVER['SERVER_NAME'] . $shareImage;
                        }
                        $shareImage = urlencode($shareImage);
                        $shareName = urlencode($model->Name);
                        ?>

                        <a data-pin-config="beside"
                           href="//pinterest.com/pin/create/button/?url=<?php echo $shareURL; ?>&media=<?php echo $shareImage; ?>&description=<?php echo $shareName; ?>"
                           data-pin-do="buttonPin">

                            <img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />

                        </a>
                    </span>

            <div class="fb-like"
                 data-send="true"
                 data-layout="button_count"
                 data-width="100"
                 data-show-faces="false"></div>

            <!--- facebook like script---->
            <div id="fb-root"></div>
            <script>
                (function (d, s, id)
                {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                    {
                        return;
                    }
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
        </div>
    </div>

    <?php endif; ?>

<?php elseif ($section == 'rightColumnBottom') : ?>


<div class="six columns">
    <div class="row">
        <div class="twelve columns spacebot10 detailsMap">
            <div id="map"></div>
        </div>
    </div>

    <!------- Stats------->
    <div class="row">
        <div class="twelve columns">
            <div class="detailStats">
                <div class="statBox"> Signed Up<span><?php echo count($model->enrolled); ?></span></div>
                <div class="statBox"> Views<span></span></div>
                <div class="statBox"> Available Until<span><?php echo date('n.j.y', strtotime($model->End)); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="twelve columns">
            <div class="detailStats">
                <div class="statBox">
                    Type<span><?php echo ExperienceType::$Lookup[$model->ExperienceType]; ?></span></div>
                <div class="statBox"> For
                    <span>
                        <?php
                        $for = 'Everyone';

                        if ($model->AppropriateAges > 0)
                        {
                            $minMaxAges = ExperienceAppropriateAges::GetMinMaxAges($model->AppropriateAges);

                            $minAge = $minMaxAges[0];
                            $maxAge = $minMaxAges[1];

                            $for = 'Ages ' . $minAge . ' to ' . $maxAge;
                        }

                        echo $for;
                        ?>
                    </span>
                </div>
                <div class="statBox"> Category<span><?php echo $model->category->Name; ?></span></div>
            </div>
        </div>
    </div>

    <?php if (($model->Min_occupancy != null) || ($model->Max_occupancy != null)) : ?>

    <div class="row">
        <div class="twelve columns">
            <div class="detailStats">
                <?php
                if ($model->Min_occupancy != null)
                {
                    echo "<div class='statBox'> Min. Seats<span>{$model->Min_occupancy}</span></div>\n";
                }
                ?>

                <?php
                if ($model->Max_occupancy != null)
                {
                    echo "<div class='statBox'> Max. Seats<span>{$model->Max_occupancy}</span></div>\n";
                }
                ?>
                <div class="statBox"></div>
            </div>
        </div>
    </div>

    <?php endif; ?>
    <!---- end stats---->
</div>

<!----------------- Modal--------------------->
<div id="confirmCancel" class="reveal-modal small">
    <h2>Confirm experience cancellation</h2>

    <p>
        Do you really want to cancel the experience "<?php echo $model->Name; ?>"? </p>

    <div>
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'experience-delete-form', 'enableAjaxValidation' => false,
            'action' => Yii::app()->createUrl('//experience/delete',
                array('id' => $model->Experience_ID))));
        ?>

        <input type="submit" value="Confirm Cancellation" class="button secondary radius" />

        <?php $this->endWidget(); ?>
    </div>

    <a class="close-reveal-modal">&#215;</a>
</div>

<script>
    $(document).ready(function ()
    {
        google.load('maps', '3.x', {other_params:'sensor=true', callback:function ()
        {
            $("#map").gmap3({
                map   :{
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
                        zoom              :15,
                        center            :[<?php echo $model->location->Latitude . ', ' . $model->location->Longitude; ?>]
                    },
                    callback:function ()
                    {
                    }
                },
                marker:{
                    latLng:[<?php echo $model->location->Latitude . ', ' . $model->location->Longitude; ?>]
                }
            });
        }});
    });
</script>

<?php endif; ?>


