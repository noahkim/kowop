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

            <?php echo $this->renderPartial($view, array('model' => $model, 'section' => 'signedup', 'user' => $user)); ?>

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
                    $hostPic = 'http://placehold.it/300x300';

                    if ($model->createUser->profilePic != null)
                    {
                        $hostPic = $model->createUser->profilePic;
                    }

                    echo CHtml::link("<img src='{$hostPic}' class='detailsInstructorpic' />",
                        array('/user/view', 'id' => $model->Create_User_ID));
                    ?>

                    <div class="detailsInstructor"> Host
                        <span class="detailsName">
                            <?php
                            $name = ($model->createUser->DisplayName == null) ? $model->createUser->fullname : $model->createUser->DisplayName;
                            echo CHtml::link($name, array('/user/view', 'id' => $model->Create_User_ID));
                            ?>
                        </span>

                        <div class="detailsReccomendations"><a href="user_profile_reviews.html">31</a></div>
                    </div>
                </div>

                <!------------ Right column ------------------>
                <?php echo $this->renderPartial($view, array('model' => $model, 'section' => 'rightColumnTop', 'user' => $user)); ?>

            </div>
        </div>
        <!---------------------------------------
                     Left Column
        ---------------------------------------->
        <div class="row">
            <div class="six columns ">
                <dl class="tabs">
                    <dd class="active"><a href="#simple1">Description</a></dd>
                    <dd><a href="#simple2">Photos</a></dd>
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

            <?php echo $this->renderPartial($view, array('model' => $model, 'section' => 'rightColumnBottom', 'user' => $user)); ?>

        </div>
    </div>
    <!------- end main content container----->
</div>

<script type="text/javascript">
    $(document).ready(function () {
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
