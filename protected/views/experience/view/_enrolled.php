<?php if ($section == 'rightColumnTop') : ?>

<?php if ($model->hasSessions && ($model->nextAvailableSession != null)) : ?>

    <div class="four columns">
        <div class="detailsNextSession">
            <h5>Next available session</h5>
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
                    echo CHtml::link("<img src='{$user->profilePic}' />", array('/user/view', 'id' => $enrollee->User_ID));
                }
                ?>
            </div>
        </div>

        <div class="spacebot10">
            <?php echo CHtml::link('Sign up for this session', array('/experience/signup', 'id' => $model->Experience_ID, 'session' => $model->nextAvailableSession->Session_ID), array('class' => 'button large twelve enrollButton')); ?>
        </div>
        <div>
            <a href="#enrolllater" class="button large twelve enrollButton">Sign up for a later session</a>
        </div>

    </div>

    <?php else : ?>

    <div class="four columns">

        <?php if ($model->MaxPerPerson != null) : ?>

        <div class="row">
            <div class="four columns">
                <label class="inline right">Quantity</label>
            </div>
            <div class="eight columns">
                <select id='selectQuantity'>
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
            <a href='#' class='button large twelve enrollButton' onclick='signUp(); return false;'> Sign up </a>
        </div>
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
    </div>

    <?php endif; ?>

<?php elseif ($section == 'rightColumnBottom') : ?>

<?php if ($model->hasSessions && ($model->nextAvailableSession != null)) : ?>

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
                    <div class="statBox"> Available
                        Until<span><?php echo date('n.j.y', strtotime($model->End)); ?></span>
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
        <div class="detailEnrolllater" id="enrolllater">
            <h4 class="spacebot10">Sign up for a later session</h4>

            <div id='calendar'></div>
        </div>
    </div>

    <script type='text/javascript'>

        $(document).ready(function ()
        {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header        :{
                    left  :'',
                    center:'title',
                    right :'prev,next'
                },
                editable      :false,
                events        :[
                    <?php
                    $calendarJS = '';
                    foreach ($model->currentSessions as $i => $session)
                    {
                        $title = 'Session ' . ($i + 1);
                        $link = $this->createAbsoluteUrl('/experience/signup', array('id' => $model->Experience_ID,
                            'session' => $session->Session_ID));
                        $calendarJS .= <<<BLOCK
                {
                    id: {$i},
                    title: '{$title}',
                    start: new Date('{$session->Start}'),
                    end: new Date('{$session->End}'),
                    allDay: false,
                    url: '{$link}',
                    session: {$session->Session_ID}
                },
BLOCK;
                    }

                    $calendarJS = rtrim($calendarJS, ",");
                    echo $calendarJS;
                    ?>
                ],
                eventMouseover:function (event, jsEvent, view)
                {
                    if (typeof $(this).data("qtip") !== "object")
                    {
                        $(this).qtip({
                            content :{
                                url:'<?php echo $this->createAbsoluteUrl("/experience/enrollDialog",
                                    array("id" => $model->Experience_ID)); ?>' + '?session=' + event.session
                            },
                            position:{
                                corner:{
                                    target :'topLeft',
                                    tooltip:'bottomMiddle'
                                }
                            },
                            hide    :{
                                fixed:true // Make it fixed so it can be hovered over
                            },
                            style   :{
                                padding:'10px' // Give it some extra padding
                            }});
                    }
                }
            });

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

    <?php else : ?>

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
                    <div class="statBox"> Available
                        Until<span><?php echo date('n.j.y', strtotime($model->End)); ?></span>
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

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'signup-form', 'enableAjaxValidation' => false, 'action' => array('/experience/signup', 'id' => $model->Experience_ID))); ?>

    <input type='hidden' name='quantity' id='quantity' />

    <?php $this->endWidget('CActiveForm'); ?>

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

        function signUp()
        {
            if ($('#selectQuantity').length > 0)
            {
                var quantity = $('#selectQuantity').val();
                $('#quantity').val(quantity);
            }
            $('#signup-form').submit();
        }
    </script>

    <?php endif; ?>

<?php
elseif ($section == 'signedup') : ?>

<div class="alert-box">
    You signed up on
    <?php
    $signups = $user->userToExperiences(array('condition' => 'Experience_ID = ' . $model->Experience_ID, 'order' => 'Created desc'));
    $signup = $signups[0];
    echo date('F j, Y', strtotime($signup->Created));
    ?>
    <a href="" class="close">&times;</a>
</div>

<?php endif; ?>

