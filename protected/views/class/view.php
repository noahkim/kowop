<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns classdetails">
        <!---------------------------------------
                     Main class details
    ---------------------------------------->
        <div class="detailsMain">
            <h1><?php echo $model->Name; ?></h1>

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
                        <span class="tuitionValue">
                            <sup class="dollarsign">$</sup> <?php echo $model->Tuition; ?>
                            <span class="persession">per lesson</span>
                        </span>
                        <?php

                        $numLessons = count($model->sessions[0]->lessons);
                        $total = $model->Tuition * $numLessons;

                        ?>
                        <span class="tuitionTotal">$<?php echo $total; ?> Total</span>
                    </div>

                    <?php
                    $instructorPic = 'http://placehold.it/300x300';

                    if ($model->createUser->profilePic != null)
                    {
                        $instructorPic = $model->createUser->profilePic;
                    }

                    echo "<img src='{$instructorPic}' class='detailsInstructorpic'>\n";
                    ?>

                    <div class="detailsInstructor">
                        <div class="detailsReccomendations">31</div>
                        <span class="detailsName">
                            <?php
                            $name = ($model->createUser->Teacher_alias == null) ? $model->createUser->fullname : $model->createUser->Teacher_alias;
                            echo CHtml::link($name, array('/user/view', 'id' => $model->Create_User_ID));
                            ?>
                        </span>
                    </div>
                </div>
                <!------------ Right column ------------------>
                <div class="four columns">
                    <?php
                    echo CHtml::link('Enroll for next available session',
                        array('/class/join', 'id' => $model->Class_ID),
                        array('class' => 'button twelve primary radius enrollButton')
                    );
                    ?>

                    <div class="detailsNextSession">
                        <span>Next session scheduled for</span>
                        <ul>
                            <?php

                            $nextSession = $model->sessions[0];

                            foreach ($nextSession->lessons as $lesson)
                            {
                                echo "<li>{$lesson->Start}</li>\n";
                            }

                            ?>
                        </ul>
                        </span>
                        <div class="enrollees">
                            <span>Classmates in the next session</span>
                            <?php

                            $nextSession = $model->sessions[0];

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
                        <div class="detailsShareclass">
                            <span>Think this class is perfect for somebody?</span>
                    <span class="shareIcons">
                    <a href="#" class="detailsShare twitter"></a>
                    <a href="#" class="detailsShare facebook"></a>
                    <a href="#" class="detailsShare googleplus"></a>
                    <a href="#" class="detailsShare linkedin"></a>
                    <a href="#" class="detailsShare pinterest"></a>
                    <a href="#" class="detailsShare email"></a>
                    </span>
                        </div>
                    </div>
                    <div class="detailsCategory">
                        <span>Category</span> <a href="#"><?php echo $model->category->Name; ?></a></div>
                    <div class="detailsTags">
                        <span>Tags</span>
                        <?php
                        foreach ($model->taglist as $tag)
                        {
                            echo "<a href='#'>{$tag}</a>\n";
                        }
                        ?>
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
                <div class="detailSidebar">
                    <div class="row">
                        <div class="six columns">
                            <ul>
                                <li><span>Type</span><?php echo ClassType::$Lookup[$model->Type]; ?></li>
                                <li>
                                    <span>Location</span><?php echo $model->location ? $model->location->Zip : 'Online'; ?>
                                </li>
                                <li><span>Total Seats</span><?php echo $model->Max_occupancy; ?></li>
                                <li><span>Needed to Start</span><?php echo $model->Min_occupancy; ?></li>
                                <li><span># of Lessons</span><?php echo count($model->sessions[0]->lessons); ?></li>
                                <li><span>1 Lesson time</span><?php echo $model->LessonDuration * 60; ?> min</li>
                                <li><span>Availability</span><?php echo $model->Start; ?>
                                    -
                                    <?php echo $model->End; ?></li>
                            </ul>
                        </div>
                        <div class="six columns spacebot10">
                            <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
                        </div>
                    </div>
                    <div class="detailEnrolllater">
                        <h4 class="spacebot10">Enroll for a later session</h4>

                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------- end main content container----->

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
                $link = $this->createAbsoluteUrl('/class/join', array('id' => $model->Class_ID, 'session' => $session->Session_ID));

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
                            url:'<?php echo $this->createAbsoluteUrl("/class/enrollDialog", array("id" => $model->Class_ID)); ?>' + '?session=' + event.session
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