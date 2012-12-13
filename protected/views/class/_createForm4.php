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
        <div class="detailsMain">
            <h1><?php echo $model->name; ?></h1>

            <div class="row">
                <div class="six columns">
                    <div class="slider-wrapper theme-default">
                        <div id="slider" class="nivoSlider">
                            <?php echo "<img src='/yii/kowop/temp/{$model->imageFile}' data-thumb='/yii/kowop/temp/{$model->imageFile}' alt=''/>\n"; ?>
                        </div>
                    </div>
                </div>
                <!---------- Middle column ------------------->
                <div class="two columns">
                    <div class=" infoTuition">
                        <span class="tuitionValue">
                            <sup class="dollarsign">$</sup> <?php echo $model->tuition; ?>
                            <span class="persession">per lesson</span>
                        </span>
                        <?php

                        $numLessons = count(json_decode($model->sessions)[0]);
                        $total = $model->tuition * $numLessons;

                        ?>
                        <span class="tuitionTotal">$<?php echo $total; ?> Total</span>
                    </div>

                    <?php
                    $instructorPic = 'http://placehold.it/300x300';

                    if ($model->user->profilePic != null)
                    {
                        $instructorPic = $model->user->profilePic;
                    }

                    echo "<img src='{$instructorPic}' class='detailsInstructorpic'>\n";
                    ?>

                    <div class="detailsInstructor">
                        <div class="detailsReccomendations">31</div>
                        <span class="detailsName">
                            <?php
                            $name = ($model->user->Teacher_alias == null) ? $model->user->fullname : $model->user->Teacher_alias;
                            echo CHtml::link($name, array('/user/view', 'id' => $model->user->User_ID));
                            ?>
                        </span>
                    </div>
                </div>
                <!------------ Right column ------------------>
                <div class="four columns">
                    <a href="#" class="button twelve primary radius enrollButton">Enroll for next available session</a>

                    <div class="detailsNextSession">
                        <span>Next session scheduled for</span>
                        <ul>
                            <?php

                            $nextSession = json_decode($model->sessions)[0];

                            foreach ($nextSession->lessons as $lesson)
                            {
                                echo "<li>{$lesson->start}</li>\n";
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
                        <span>Category</span> <a href="#"><?php echo Category::GetCategories()[$model->category]; ?></a></div>
                    <div class="detailsTags">
                        <span>Tags</span>
                        <?php
                        $tagsArray = Tag::model()->string2array($model->tags);

                        foreach ($tagsArray as $tag)
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
                <?php echo $model->description; ?>
            </div>
            <!--- end left column---->
            <!---------------------------------------
                             right column
            ---------------------------------------->
            <div class="six columns">
                <div class="detailSidebar">
                    <div class="row">
                        <div class="six columns spacebot10">
                            <ul>
                                <li><span>Type</span><?php echo ClassType::$Lookup[$model->classType]; ?></li>
                                <li>
                                    <span>Location</span><?php echo $model->locationZip ? $model->locationZip : 'Online'; ?>
                                </li>
                                <li><span>Total Seats</span><?php echo $model->maxOccupancy; ?></li>
                                <li><span>Needed to Start</span><?php echo $model->minOccupancy; ?></li>
                                <li><span># of Lessons</span><?php echo count(json_decode($model->sessions)[0]); ?></li>
                                <li><span>1 Lesson time</span><?php echo $model->lessonDuration * 60; ?> min</li>
                                <li><span>Availability</span>
                                    <?php echo $model->start; ?>
                                    -
                                    <?php echo $model->end; ?>
                                </li>

                            </ul>
                        </div>
                        <div class="six columns spacebot10">
                            <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
                        </div>
                    </div>
                    <h4 class="spacebot10">Enroll for a later session</h4>

                    <div id='calendar'></div>
                </div>
            </div>
        </div>
        <!------- end main content container----->
    </div>
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
