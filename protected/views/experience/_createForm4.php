<!-----------title---------->
<div class="createLastLook">
    <div class="row">
        <div class="twelve columns">
            <h1>One Last Look</h1>

            <p>This is how your class will appear. Just make sure everything looks right, then post. Don't worry if you
                missed a detail or need to change something in the future. You can always come back to it and edit it
                later.</p>

            <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'class-create-form',
            'enableAjaxValidation' => false,
            'stateful' => true,
            'htmlOptions' => array('style' => 'margin: 0;')
        )); ?>

            <?php echo CHtml::submitButton('Make Changes', array('name' => 'change', 'class' => 'button large radius')); ?>
            <?php echo CHtml::submitButton('Post my class', array('name' => 'submit', 'id' => 'submit', 'class' => 'button large primary radius')); ?>

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
        <h1><?php echo $model->name; ?></h1>

        <div class="detailsMain">
            <div class="row">
                <div class="six columns">
                    <div class="slider-wrapper theme-default">
                        <div id="slider" class="nivoSlider">
                            <?php
                                foreach($model->imageFiles as $imageFile)
                                {
                                    $link = Yii::app()->params['siteBase'] . '/temp/' . $imageFile;
                                    echo "<img src='{$link}' data-thumb='{$link}' alt=''/>\n";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!---------- Middle column ------------------->
                <div class="two columns">

                    <?php
                    $total = $model->tuition * $model->numLessons;
                    ?>

                    <div class=" infoTuition">
                        <span class="classTuition">
                            <sup class="dollarsign">$</sup><?php echo $total; ?><span
                                class="persession"><?php echo $model->numLessons; ?> lesson class</span>
                        </span>
                        <span class="breakdown">$<?php echo $model->tuition; ?> per lesson</span>
                    </div>

                    <?php
                    $instructorPic = 'http://placehold.it/300x300';

                    if (isset($model->user) && $model->user->profilePic != null)
                    {
                        $instructorPic = $model->user->profilePic;
                    }

                    echo "<img src='{$instructorPic}' class='detailsInstructorpic' />\n";
                    ?>

                    <div class="detailsInstructor">
                        Instructor
                        <span class="detailsName">
                            <?php
                            $name = ($model->user->Teacher_alias == null) ? $model->user->fullname : $model->user->Teacher_alias;
                            echo CHtml::link($name, array('/user/view', 'id' => $model->user->User_ID));
                            ?>
                        </span>

                        <div class="detailsReccomendations"><a href="#">31</a></div>
                    </div>
                </div>
                <!------------ Right column ------------------>
                <div class="four columns">
                    <div class="detailsNextSession">
                        <span>Next available session scheduled for</span>
                        <ul>
                            <?php

                            $nextSession = json_decode($model->sessions)[0];

                            foreach ($nextSession->lessons as $lesson)
                            {
                                $time = strtotime($lesson->start);

                                $dayOfWeek = date('l', $time);
                                $date = date('F j', $time);
                                $start = date('g:i a', $time);

                                // Get lesson duration in seconds
                                $offset = $model->lessonDuration * 60 * 60;

                                $end = date('g:i a', ($time + $offset));

                                echo "<li><span>{$dayOfWeek}</span> {$date} <span class='time'>{$start}-<br />{$end}</span></li>\n";
                            }

                            ?>
                        </ul>
                        </span>
                        <div class="enrollees">
                            <span>Classmates in the next session</span>
                            <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
                            <a href="#"><img src="http://placeskull.com/100/100/d70060"></a>
                            <a href="#"><img src="http://placeskull.com/100/100/113f8c"></a>
                            <a href="#"><img src="http://placehold.it/100x100"></a>
                            <a href="#"><img src="http://placehold.it/100x100"></a>
                            <a href="#"><img src="http://placehold.it/100x100"></a>
                        </div>

                    </div>
                    <div class="spacebot10">
                        <a href="#" class="button large twelve enrollButton">Enroll for this session</a>
                    </div>
                    <div>
                        <a href="#enrolllater" class="button large twelve enrollButton">Enroll for a later
                            session</a>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------
                         Left Column
        ---------------------------------------->
        <div class="row">
            <div class="six columns detailsDescription">
                <?php echo $model->description; ?>
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
                                Graduates<span>32</span>
                            </div>
                            <div class="statBox">
                                Enrollees<span>23</span>
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
                                <li><span>Location</span><?php echo $model->locationZip; ?></li>
                                <?php
                                $availability = date('n.j', strtotime($model->start)) . '-' . date('n.j', strtotime($model->end));
                                echo "<li><span>Availability</span>{$availability}</li>\n";
                                ?>
                                <li><span>Max. seats</span><?php echo $model->maxOccupancy; ?></li>
                                <li><span>Min. seats</span><?php echo $model->minOccupancy; ?></li>
                                <li><span># of Lessons</span><?php echo $model->numLessons; ?></li>
                                <li><span>1 lesson time</span><?php echo $model->lessonDuration * 60; ?> min</li>
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
