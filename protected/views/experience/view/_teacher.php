<!--------- main content container------>
<div class="row" id="wrapper">
<div class="twelve columns classdetails">
<!---------------------------------------
             Main class details
---------------------------------------->
<h1><?php echo $model->Name; ?></h1>

<div class="detailsMain">
    <div class="row">
        <div class="six columns">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    <?php

                    foreach ($model->contents as $content)
                    {
                        echo "<img src='{$content->Link}' data-thumb='{$content->Link}' alt=''/>\n";
                    }

                    ?>
                </div>
            </div>
        </div>
        <!---------- Middle column ------------------->
        <div class="two columns">
            <div class=" infoTuition">
                <span class="classTuition">
                    <sup class="dollarsign">$</sup><?php echo $model->Price; ?>
                </span>
            </div>

            <?php
            $instructorPic = 'http://placehold.it/300x300';

            if ($model->createUser->profilePic != null)
            {
                $instructorPic = $model->createUser->profilePic;
            }

            echo CHtml::link("<img src='{$instructorPic}' class='detailsInstructorpic' />",
                             array('/user/view', 'id' => $model->Create_User_ID));
            ?>

            <div class="detailsInstructor">
                Instructor
                        <span class="detailsName">
                        <?php
                            $name = ($model->createUser->Teacher_alias == null) ? $model->createUser->fullname : $model->createUser->Teacher_alias;
                            echo CHtml::link($name, array('/user/view', 'id' => $model->Create_User_ID));
                            ?>
                        </span>

                <div class="detailsReccomendations"><a href="#">31</a></div>
            </div>
        </div>
        <!------------ Right column ------------------>
        <div class="four columns">
            <div class="detailsNextSession">
                <span>Next session you're teaching is on</span>
            <ul>
                <?php

                $nextSession = $model->nextAvailableSession;

                if ($nextSession != null) :
                    $startTime = strtotime($nextSession->Start);
                    $endTime = strtotime($nextSession->End);

                    $dayOfWeek = date('l', $startTime);
                    $date = date('F j', $startTime);
                    $start = date('g:i a', $startTime);
                    $end = date('g:i a', $endTime);

                    echo "<li><span>{$dayOfWeek}</span> {$date} <span class='time'>{$start}-<br />{$end}</span></li>\n";
                    ?>
                        </ul>
                        </span>
                    <div class="enrollees">
                        <span>People in the next session</span>
                        <?php

                        foreach ($nextSession->enrolled as $enrollee)
                        {
                            $imgLink = 'http://placeskull.com/100/100/01a4a4';

                            if ($enrollee->profilePic != null)
                            {
                                $imgLink = $enrollee->profilePic;
                            }

                            $imgHTML = "<img src='{$imgLink}' alt='{$enrollee->fullname}' />";
                            echo CHtml::link($imgHTML, array('/user/view', 'id' => $enrollee->User_ID),
                                             array('title' => $enrollee->fullname));
                        }

                        ?>
                    </div>

                    <?php endif; ?>

            </div>

            <div class="spacebot10">
                <?php echo CHtml::link("Edit experience details",
                                       array('/experience/update', 'id' => $model->Experience_ID),
                                       array('class' => 'button large twelve')); ?>
            </div>

            <div class="spacebot10">
                <?php echo CHtml::link("Manage sessions",
                                       array('/experience/updateSessions', 'id' => $model->Experience_ID),
                                       array('class' => 'button large twelve')); ?>
            </div>

            <div>
                <a href="#" class="button twelve large" data-reveal-id="confirmCancel">Cancel Class</a>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------
                 Left Column
---------------------------------------->
<div class="row">
    <div class="six columns detailsDescription">
        <?php echo $model->Description; ?>
    </div>
    <!--- end left column----><!---------------------------------------
                     right column
    ---------------------------------------->
    <div class="six columns">
        <!-------- Class Stats----------------><!--        <div class="detailStats">
            <h4>To Date</h4>

            <?php
    /*            $lessonsToDate = count($model->sessions(array('condition' => 'Start < now()')));
                $pastStudents = 0;

                foreach ($model->sessions(array('with' => 'lessons', 'condition' => 'lessons.Start < now()')) as $session)
                {
                    $pastStudents += count($session->enrolled);
                }

                $netIncome = $lessonsToDate * $model->Price * $pastStudents;
                $hoursTaught = $lessonsToDate * $model->LessonDuration;
                */?>
            <div class="statBox">
                Students<span><?php /*echo $pastStudents; */?></span>
            </div>
            <div class="statBox">
                Net Income<span>$<?php /*echo $netIncome; */?></span>
            </div>
            <div class="statBox">
                Hours Taught<span><?php /*echo $hoursTaught; */?></span>
            </div>
            <h4>Enrolled</h4>

            <?php
    /*            $lessonsToTeach = count($model->lessons(array('condition' => 'Start >= now()')));
                $projectedIncome = $lessonsToTeach * $model->Price * $model->Max_occupancy;
                $hoursToTeach = $lessonsToTeach * $model->LessonDuration;
                */?>
            <div class="statBox">
                Students<span><?php /*echo count($model->enrolled); */?></span>
            </div>
            <div class="statBox">
                Projected Income<span>$<?php /*echo $projectedIncome; */?></span>
            </div>
            <div class="statBox">
                Hours to Teach<span><?php /*echo $hoursToTeach; */?></span>
            </div>
            <h4>Instructor Stats</h4>

            <?php
    /*            $totalTuition = 0;
                $totalHours = 0;

                foreach ($model->createUser->experiences as $class)
                {
                    $totalTuition += $class->Price;
                    $totalHours += $class->LessonDuration;
                }

                $avgPerClass = $totalTuition / count($model->createUser->experiences);
                $avgPerHour = $totalTuition / $totalHours;

                */?>
            <div class="statBox">
                Avg. per Class<span>$<?php /*echo number_format($avgPerClass, 2); */?></span>
            </div>
            <div class="statBox">
                Avg. per Hour<span>$<?php /*echo number_format($avgPerHour, 2); */?></span>
            </div>
            <div class="statBox">
                Net Income<span>$<?php /*echo $totalTuition; */?></span>
            </div>
            <h4>Class stats</h4>

            <?php
    /*            $totalSeats = 0;
                $daysOfWeek = array();

                foreach ($model->sessions(array('with' => 'lessons', 'condition' => 'lessons.Start < now()')) as $session)
                {
                    $totalSeats += count($session->enrolled);
                }

                foreach ($model->sessions as $session)
                {
                    foreach ($session->lessons as $lesson)
                    {
                        $dayOfWeek = date('l', strtotime($lesson->Start));
                        if (!isset($daysOfWeek[$dayOfWeek]))
                        {
                            $daysOfWeek[$dayOfWeek] = 0;
                        }
                        $daysOfWeek[$dayOfWeek]++;
                    }
                }

                arsort($daysOfWeek);
                reset($daysOfWeek);
                $busiestDay = key($daysOfWeek);

                $pastSessionCount = count($model->sessions(array('with' => 'lessons',
                                                                 'condition' => 'lessons.Start < now()')));
                $avgClassSize = $pastSessionCount > 0 ? $totalSeats / $pastSessionCount : 0;

                */?>

            <div class="statBox">
                Avg Class Size<span><?php /*echo number_format($avgClassSize, 2); */?></span>
            </div>
            <div class="statBox">
                Busiest Day<span><?php /*echo $busiestDay; */?></span>
            </div>
            <div class="statBox">
                Views<span>268</span>
            </div>
        </div>--><!-------- end Class Stats------------>

        <div class="detailSidebar">
            <div class="row">
                <div class="twelve columns">
                    <ul>
                        <li><span>Location</span><?php echo $model->location->Zip; ?></li>
                        <?php
                        $availability = date('n.j', strtotime($model->Start)) . '-' . date('n.j',
                                                                                           strtotime($model->End));
                        echo "<li><span>Availability</span>{$availability}</li>\n";
                        ?>
                        <li><span>Max. seats</span><?php echo $model->Max_occupancy; ?></li>
                        <li><span>Min. seats</span><?php echo $model->Min_occupancy; ?></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="twelve columns spacebot10 detailsMap">
                    <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
                </div>
            </div>
            <div class="detailEnrolllater" id="enrolllater">
                <h4 class="spacebot10">Enroll for a later session</h4>

                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
</div>

<!----------------- Modal--------------------->
<div id="confirmCancel" class="reveal-modal small">
    <h2>Confirm class cancellation</h2>

    <p>
        Do you really want to cancel the class "<?php echo $model->Name; ?>"? </p>

    <div>
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'class-delete-form', 'enableAjaxValidation' => false,
                                                        'action' => Yii::app()->createUrl('//experience/delete',
                                                                                          array('id' => $model->Experience_ID))));
        ?>

        <input type="submit" value="Confirm Cancellation" class="button secondary radius" />

        <?php $this->endWidget(); ?>
    </div>

    <a class="close-reveal-modal">&#215;</a>
</div>

<!------- end main content container----->
</div>

<script type="text/javascript">
    $(window).load(function ()
    {
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
            foreach ($model->sessions as $i => $session)
            {
                $title = 'Session ' . ($i + 1);
                $link = $this->createAbsoluteUrl('/experience/join', array('id' => $model->Experience_ID,
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

    });

</script>
