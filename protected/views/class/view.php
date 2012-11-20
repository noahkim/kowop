<!--------- main content container------>
<div class="row" id="wrapper">


    <!---------------------------------------
                   Left Column
    ---------------------------------------->
    <div class="six columns classdetails">
        <div class="row">
            <div class="twelve columns">
                <img src="/ui/site/images/merit_badge.png" class="meritbadge">

                <h1><?php echo $model->Name; ?></h1>
            </div>
        </div>
        <div class="row"><!---- instructor/avaialability info---->
            <div class="two columns"><img src="http://placehold.it/100x100"></div>
            <div class="four columns detailsInstructor">
                <?php $name = ($model->createUser->Teacher_alias == null) ? $model->createUser->fullname : $model->createUser->Teacher_alias; ?>
                <span class="detailsName">by <?php echo $name; ?></span>
                <?php echo CHtml::link('Meet the instructor', array('/user/view', 'id' => $model->Create_User_ID)); ?>
            </div>
            <div class="two columns detailsReccomendations">
                <?php echo isset($model->ratings) ? count($model->ratings) : 0; ?>
            </div>
            <div class="four columns detailsAvailability">
                <label>Available from</label>
                <?php echo $model->Start; ?>
                -
                <?php echo $model->End; ?>
            </div>
        </div>
        <!---- end instructor/avaialability info---->
        <?php if (count($model->contents) > 0) : ?>
        <img src="<?php echo $model->contents[0]->Link ?>" class="detailsMainpic">
        <?php else : ?>
        <img src="http://placehold.it/800x600" class="detailsMainpic">
        <?php endif; ?>

        <div class="row"><!---- main description area----->
            <div class="twelve columns detailsDescription">
                <?php echo $model->Description; ?>
            </div>
        </div>
        <!---- end main description area----->
    </div>
    <!---------------------------------------
                   Right Column
    ---------------------------------------->
    <div class="six columns classinfo">
        <!----- Class Information----------------->
        <div class="row infoDetails">
            <div class="four columns">
                <?php if ($model->Tuition == null): ?>
                <div class=" infoTuition">
                    <span class="tuitionLabel">Tuition</span>
                    <span class="tuitionValue">
                        <sup class="dollarsign">$</sup> 0
                        <span class="persession">per session</span>
                    </span>
                    <span class="tuitionTotal">$0 Total</span>
                </div>
                <?php else: ?>
                <div class=" infoTuition">
                    <span class="tuitionLabel">Tuition</span>
                    <span class="tuitionValue">
                        <sup class="dollarsign">$</sup> <?php echo $model->Tuition; ?>
                        <span class="persession">per session</span>
                    </span>
                    <span class="tuitionTotal">$<?php echo count($model->sessions) * $model->Tuition; ?> Total</span>
                </div>
                <?php endif; ?>

            </div>
            <div class="four columns"> <span class="infopoint">
        <h5>Type</h5>
        Local </span> <span class="infopoint">
        <h5># of Seats</h5>
                <?php echo $model->Max_occupancy; ?> </span> <span class="infopoint">
        <h5>Minimum to Start</h5>
                <?php echo $model->Min_occupancy; ?> </span> <span class="infopoint">
        <h5>Total Sessions</h5>
                <?php echo count($model->sessions); ?> </span> <span class="infopoint">
        <h5>Length per Session</h5>
        1 hour </span> <span class="infopoint">
        <h5>Category</h5>
                <?php echo $model->category->Name; ?> </span></div>

            <?php if ($model->location != null) : ?>
            <div class="four columns"> <span class="infopoint">
        <h5>Location</h5>
                <?php echo $model->location->Zip; ?> </span>
                <iframe class="infoMap" width="100%" height="200" frameborder="0" scrolling="no" marginheight="0"
                        marginwidth="0"
                        src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020479,-118.411732&amp;sspn=0.835458,1.451569&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;ll=34.023688,-118.39002&amp;spn=0.052213,0.090723&amp;t=m&amp;z=14&amp;output=embed"></iframe>
            </div>
            <?php endif; ?>
        </div>
        <!----- End Class Information----------->
        <div class="row"><!----- Enroll in Class---------------->
            <div class="twelve columns enroll">
                <h2>Enroll in the next available class</h2>

                <p>Click on an empty seat to join the next available class.Please remember, classes only start with at
                    least 2 people.</p>

                <div class="enrollStudents"><a href="#"><img src="http://placehold.it/100x100"></a> <a href="#"><img
                        src="http://placehold.it/100x100"></a> <a href="#"><img src="http://placehold.it/100x100"></a>
                    <a href="#"><img src="http://placehold.it/100x100"></a> <a href="#"><img
                            src="http://placehold.it/100x100"></a> <a href="#"><img
                            src="http://placehold.it/100x100"></a></div>

                <?php echo CHtml::link('Enroll', array('/class/join', 'id' => $model->Class_ID), array('class' => 'button large radius')); ?>

                <h2>Enroll in a later class</h2>

                <p>Click on a class in the calendar to enroll for a later date</p>

                <div id='calendar'></div>
            </div>
        </div>
        <!----- End Enroll in Class------------->
        <!--- end right column ----->
    </div>

    <!------- end main content container----->
</div>