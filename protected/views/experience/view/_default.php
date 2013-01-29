<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns classdetails">
        <!---------------------------------------
                     Main class details
        ---------------------------------------->
        <!----- Class title------->
        <div class="row">
            <div class="twelve columns">
                <div class="followClass"><a href="#" class="button ">Follow Class</a></div>
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
                            <sup class="dollarsign">$</sup><?php echo count($model->sessions[0]->lessons) * $model->Price; ?>
                            <span class="persession"><?php echo count($model->sessions[0]->lessons); ?> lesson class</span>
                        </span>
                        <span class="breakdown">$<?php echo $model->Price; ?> per lesson</span>
                    </div>

                    <?php
                    $instructorPic = 'http://placehold.it/300x300';

                    if ($model->createUser->profilePic != null)
                    {
                        $instructorPic = $model->createUser->profilePic;
                    }

                    echo CHtml::link("<img src='{$instructorPic}' class='detailsInstructorpic' />", array('/user/view', 'id' => $model->Create_User_ID));
                    ?>

                    <div class="detailsInstructor">
                        Instructor
                        <span class="detailsName">
                            <?php
                            $name = ($model->createUser->Teacher_alias == null) ? $model->createUser->fullname : $model->createUser->Teacher_alias;
                            echo CHtml::link($name, array('/user/view', 'id' => $model->Create_User_ID));
                            ?>
                        </span>

                        <div class="detailsReccomendations"><a href="user_profile_reviews.html">31</a></div>
                    </div>
                </div>
                <!------------ Right column ------------------>
                <div class="four columns">
                    <div class="detailsNextSession">
                        <span>Next available session scheduled for</span>
                        <ul>
                            <?php

                            $nextSession = $model->nextAvailableSession;

                            foreach ($nextSession->lessons as $lesson)
                            {
                                $time = strtotime($lesson->Start);

                                $dayOfWeek = date('l', $time);
                                $date = date('F j', $time);
                                $start = date('g:i a', $time);

                                // Get lesson duration in seconds
                                $offset = $model->LessonDuration * 60 * 60;

                                $end = date('g:i a', ($time + $offset));

                                echo "<li><span>{$dayOfWeek}</span> {$date} <span class='time'>{$start}-<br />{$end}</span></li>\n";
                            }

                            ?>
                        </ul>
                        </span>
                        <div class="enrollees">
                            <span>Classmates in the next session</span>
                            <?php

                            foreach ($nextSession->students as $student)
                            {
                                $imgLink = 'http://placeskull.com/100/100/01a4a4';

                                if ($student->profilePic != null)
                                {
                                    $imgLink = $student->profilePic;
                                }

                                $imgHTML = "<img src='{$imgLink}' alt='{$student->fullname}' />";
                                echo CHtml::link(
                                    $imgHTML,
                                    array('/user/view', 'id' => $student->User_ID),
                                    array('title' => $student->fullname)
                                );
                            }

                            ?>
                        </div>

                    </div>
                    <div class="spacebot10">
                        <?php
                        echo CHtml::link('Enroll for this session',
                            array('/experience/join', 'id' => $model->Experience_ID, array('session' => $nextSession->Session_ID)),
                            array('class' => 'button large twelve enrollButton')
                        );
                        ?>
                    </div>
                    <div>
                        <a href="#enrolllater" class="button large twelve enrollButton">Enroll for a later session</a>
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
            <!--- end left column---->
            <!---------------------------------------
                             right column
            ---------------------------------------->
            <div class="six columns">
                <!------- Stats------->
                <div class="row">
                    <div class="twelve columns">
                        <div class="detailStats">
                            <div class="statBox">
                                Graduates<span><?php echo count($model->students); ?></span>
                            </div>
                            <div class="statBox">
                                Enrollees<span><?php echo count($model->students); ?></span>
                            </div>
                            <div class="statBox">
                                Views<span>536</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-------- end stats---------->
                <div class="detailSidebar">
                    <div class="row">
                        <div class="twelve columns">
                            <ul>
                                <li><span>Location</span><?php echo $model->location->Zip; ?></li>
                                <?php
                                $availability = date('n.j', strtotime($model->Start)) . '-' . date('n.j', strtotime($model->End));
                                echo "<li><span>Availability</span>{$availability}</li>\n";
                                ?>
                                <li><span>Max. seats</span><?php echo $model->Max_occupancy; ?></li>
                                <li><span>Min. seats</span><?php echo $model->Min_occupancy; ?></li>
                                <li><span># of Lessons</span><?php echo count($model->sessions[0]->lessons); ?></li>
                                <li><span>1 lesson time</span><?php echo $model->LessonDuration * 60; ?> min</li>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns spacebot10 detailsMap">
                            <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
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
    <!------- end main content container----->
</div>

<script type="text/javascript">
    $(window).load(function () {
        $('#slider').nivoSlider({
            effect:'fade', // Specify sets like: 'fold,fade,sliceDown'
            slices:15, // For slice animations
            boxCols:8, // For box animations
            boxRows:4, // For box animations
            animSpeed:1000, // Slide transition speed
            pauseTime:4000, // How long each slide will show
            startSlide:0, // Set starting Slide (0 index)
            directionNav:true, // Next & Prev navigation
            controlNav:true, // 1,2,3... navigation
            controlNavThumbs:true, // Use thumbnails for Control Nav
            pauseOnHover:true, // Stop animation while hovering
            manualAdvance:false, // Force manual transitions
            prevText:'Prev', // Prev directionNav text
            nextText:'Next', // Next directionNav text
            randomStart:false, // Start on a random slide
            beforeChange:function () {
            }, // Triggers before a slide transition
            afterChange:function () {
            }, // Triggers after a slide transition
            slideshowEnd:function () {
            }, // Triggers after all slides have been shown
            lastSlide:function () {
            }, // Triggers when last slide is shown
            afterLoad:function () {
            } // Triggers when slider has loaded
        });
    });
</script>

<script type='text/javascript'>

    $(document).ready(function () {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header:{
                left:'',
                center:'title',
                right:'prev,next'
            },
            editable:false,
            events:[
            <?php
            $calendarJS = '';
            foreach ($model->sessions as $i => $session)
            {
                $title = 'Session ' . ($i + 1);
                $link = $this->createAbsoluteUrl('/experience/join', array('id' => $model->Experience_ID, 'session' => $session->Session_ID));

                foreach ($session->lessons as $lesson)
                {
                    $calendarJS .= <<<BLOCK
                {
                    id: {$lesson->Lesson_ID},
                    title: '{$title}',
                    start: new Date('{$lesson->Start}'),
                    end: new Date('{$lesson->End}'),
                    allDay: false,
                    url: '{$link}',
                    session: {$session->Session_ID}
                },
BLOCK;
                }
            }

            $calendarJS = rtrim($calendarJS, ",");
            echo $calendarJS;
            ?>
            ],
            eventMouseover:function (event, jsEvent, view) {
                if (typeof $(this).data("qtip") !== "object") {
                    $(this).qtip({
                        content:{
                            url:'<?php echo $this->createAbsoluteUrl("/experience/enrollDialog", array("id" => $model->Experience_ID)); ?>' + '?session=' + event.session
                        },
                        position:{
                            corner:{
                                target:'topLeft',
                                tooltip:'bottomMiddle'
                            }
                        },
                        hide:{
                            fixed:true // Make it fixed so it can be hovered over
                        },
                        style:{
                            padding:'10px' // Give it some extra padding
                        }});
                }
            }
        });

    });

</script>