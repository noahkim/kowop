<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns classdetails">
        <!---------------------------------------
                     Main class details
    ----------------------------------------><!----- Experience Title------->
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
                    <div class=" infoTuition"><span class="detailPrice">
                        <sup class="dollarsign">$</sup>120</span>
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
                            $name = ($model->createUser->Teacher_alias == null) ? $model->createUser->fullname : $model->createUser->Teacher_alias;
                            echo CHtml::link($name, array('/user/view', 'id' => $model->Create_User_ID));
                            ?>
                        </span>

                        <div class="detailsReccomendations"><a href="user_profile_reviews.html">31</a></div>
                    </div>
                </div>

                <!------------ Right column ------------------>
                <?php echo $this->renderPartial($view, array('model' => $model, 'section' => 'rightColumnTop')); ?>

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

            <?php echo $this->renderPartial($view, array('model' => $model, 'section' => 'rightColumnBottom')); ?>

            <div class="six columns">
                <!-------- end stats---------->
                <div class="row">
                    <div class="twelve columns spacebot10 detailsMap">
                        <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
                    </div>
                </div>
                <!------- Stats------->
                <div class="row">
                    <div class="twelve columns">
                        <div class="detailStats">
                            <div class="statBox"> Attended<span>32</span></div>
                            <div class="statBox"> Signed Up<span>23</span></div>
                            <div class="statBox"> Views<span>536</span></div>
                        </div>
                    </div>
                </div>
                <!---- end stats---->
                <div class="detailEnrolllater" id="enrolllater">
                    <h4 class="spacebot10">Enroll for a later session</h4>

                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>
    <!------- end main content container----->
</div>

<script type="text/javascript">
    $(document).ready(function ()
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
