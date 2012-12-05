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
                        <a href="#" class="tiny button radius secondary twelve">ask a question</a>
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
                            <!--                            <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
                                                        <a href="#"><img src="http://placeskull.com/100/100/d70060"></a>
                                                        <a href="#"><img src="http://placeskull.com/100/100/113f8c"></a>
                                                        <a href="#"><img src="http://placehold.it/100x100"></a>
                                                        <a href="#"><img src="http://placehold.it/100x100"></a>
                                                        <a href="#"><img src="http://placehold.it/100x100"></a>-->
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
                    <a href="#" class="button twelve secondary radius" data-reveal-id="enrollLater">Enroll in a later
                        session</a>
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
                             middle column
            ---------------------------------------->
            <div class="two columns">
      	<span class="infopoint">
        <h5>Type</h5>
              <?php echo ClassType::$Lookup[$model->Type]; ?>
        </span>
        <span class="infopoint">
        <h5>Location</h5>
            <?php echo $model->location ? $model->location->Zip : 'Online'; ?>
        </span>
        <span class="infopoint">
        <h5>Total Seats</h5>
            <?php echo $model->Max_occupancy; ?>
        </span>
        <span class="infopoint">
        <h5>Needed to start</h5>
            <?php echo $model->Min_occupancy; ?>
        </span>
        <span class="infopoint">
        <h5>Total Sessions</h5>
            <?php echo count($model->sessions); ?>
        </span>
        <span class="infopoint">
        <h5>Length per Session</h5>
        1 hour
        </span>
        <span class="infopoint">
        <h5>Category</h5>
            <?php echo $model->category->Name; ?>
        </span>

        <span class="infopoint">
        <h5>Availability</h5>
            <?php echo $model->Start; ?>
            -
            <?php echo $model->End; ?>
        </span>
            </div>
            <!--- end middle column---->

            <!---------------------------------------
                          Right Column
            ---------------------------------------->
            <div class="four columns">
                <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
            </div>
            <!--- end right column ----->
        </div>
        <!------- end main content container----->
    </div>
</div>

<script type="text/javascript" src="/ui/site/javascripts/jquery.nivo.slider.js"></script>
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
