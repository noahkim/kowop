<?php
/* @var $this RequestController */
/* @var $model Request */
?>
<!--------- main content container------>
<div class="row" id="wrapper">
    <!---------------------------------------
                   Left Column
    ---------------------------------------->
    <div class="six columns requestdetails">
        <h1><?php echo $model->Name; ?></h1>
        <!---- main description area----->
        <span class="requestCategory">in <?php echo $model->category->Name; ?></span>
        <span class="requestTags">
            <?php
            foreach ($model->taglist as $tag)
            {
                echo "<a href='#'>$tag</a>";
            }
            ?>
        </span>
        <span class="requestLocation">
            <?php
            if ($model->location != null)
            {
                echo "This is a local request centered in <span>{$model->location->Zip}</span>";
            }
            else
            {
                echo "This is a request for an online class";
            }
            ?>
        </span>

        <div class="requestMap">
            <iframe class="infoMap" width="100%" height="200" frameborder="0" scrolling="no" marginheight="0"
                    marginwidth="0"
                    src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020479,-118.411732&amp;sspn=0.835458,1.451569&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;ll=34.023688,-118.39002&amp;spn=0.052213,0.090723&amp;t=m&amp;z=14&amp;output=embed"></iframe>
        </div>
        <div class="row">
            <div class="twelve columns requestDescription">
                <p>
                    <?php echo $model->Description; ?>
                </p>
            </div>
        </div>
    </div>
    <!---------------------------------------
                   Right Column
    ---------------------------------------->
    <div class="six columns requestdetails">
        <!----- Main callout buttons ----------->
        <div class="row">
            <div class="six columns">
                <p>The following people are also interested in this request. If you are too, join with no obligation.
                    The more interested people with similar availability, the more likely this request will get picked
                    up by a potential instructor.</p>
            </div>
            <div class="six columns">
                <?php if ($model->hasUserJoined(Yii::app()->user->id)) : ?>
                <span class="requestJoinedlabel">You've joined this class request!</span>
                <a href="#" class="button large radius twelve" data-reveal-id="leaveRequest">Leave this request</a>
                <?php else : ?>

                <?php

                $formTeach = $this->beginWidget('CActiveForm', array(
                    'id' => 'request-teach-form',
                    'enableAjaxValidation' => false,
                    'action' => array('/class/create'),
                    'htmlOptions' => array('style' => 'margin: 0;')
                ));

                $modelTeach = new ClassCreateForm;

                echo $formTeach->hiddenField($modelTeach, 'name', array('value' => $model->Name));
                echo $formTeach->hiddenField($modelTeach, 'category', array('value' => $model->Category_ID));
                echo $formTeach->hiddenField($modelTeach, 'tags', array('value' => $model->tagstring));

                if($model->location != null)
                {
                    echo $formTeach->hiddenField($modelTeach, 'locationZip', array('value' => $model->location->Zip));
                }

                echo CHtml::submitButton('Teach this class', array('name' => 'teachClassSubmit', 'class' => 'button large radius twelve spacebot10'));
                $this->endWidget();

                ?>

                <a href="#" class="button large radius twelve" data-reveal-id="joinRequest">Join this request</a>
                <?php endif; ?>
            </div>
        </div>
        <!-------- end main callout buttons------->
        <!---- legend ---->
        <div class="row">
            <div class="twelve columns legend">
                <img src="/ui/site/images/icon_dontknow.png">
                <span>Don't know</span>
                <img src="/ui/site/images/icon_na.png">
                <span>Not Available</span>
                <img src="/ui/site/images/icon_daytime.png">
                <span>Daytime</span>
                <img src="/ui/site/images/icon_evening.png">
                <span>Evening</span>
                <img src="/ui/site/images/icon_allday.png">
                <span>All Day</span>
            </div>
        </div>
        <!---- end legend --->

        <?php

        $users = array();
        $usersAvailability = array();
        foreach ($model->requestToUsers as $requestToUser)
        {
            $usersAvailability[$requestToUser->User_ID][$requestToUser->Day] = $requestToUser->Time_of_day;
            $users[$requestToUser->User_ID] = $requestToUser->user;
        }

        foreach ($usersAvailability as $userID => $days)
        {
            $profileImageLink = CHtml::link('<img src="http://placehold.it/200x200">', array('/user/view', 'id' => $userID));
            $profileLink = CHtml::link($users[$userID]->fullname, array('/user/view', 'id' => $userID));

            $creator = '';
            $creatorClass = 'requestJoiner';

            if($userID == $model->Create_User_ID)
            {
                $creator = '<span>creator</span>';
                $creatorClass = 'requestRequestor';
            }

            echo <<<BLOCK
        <!---- 1 student ----->
        <div class="row">
            <div class="two columns">
                {$profileImageLink}
            </div>
            <div class="two columns {$creatorClass}">
                {$profileLink}{$creator}
            </div>
            <div class="eight columns">
                <table class="requestAvailability twelve">
                    <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

BLOCK;

            $classLookup = array();
            $classLookup[TimeOfDay::NotAvailable] = 'availableNa';
            $classLookup[TimeOfDay::Daytime] = 'availableDaytime';
            $classLookup[TimeOfDay::Evening] = 'availableEvening';
            $classLookup[TimeOfDay::AllDay] = 'availableAllday';

            foreach (DayOfWeek::$Lookup as $day => $name)
            {
                $class = 'availableDontknow';

                if (isset($days[$day]))
                {
                    $class = $classLookup[$days[$day]];
                }

                echo "                    <td class='{$class}'></td>\n";
            }

            echo <<<BLOCK
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!---- end 1 student----->

BLOCK;

        }

        ?>
        <!--- end right column ----->
    </div>
    <!------- end main content container----->
</div>

<!----- Modal ------------->
<div id="joinRequest" class="reveal-modal xlarge">
    <h2>Join this Request</h2>

    <p>Enter your approximate availability below. It'll help potential teachers decide if they can teach the class or
        not. We'll notify you if someone decides to teach the class. There's no obligation to join even if the class is
        picked up.</p>

    <?php

    $formJoin = $this->beginWidget('CActiveForm', array(
        'id' => 'request-join-form',
        'enableAjaxValidation' => false,
        'action' => array('/request/join', 'id' => $model->Request_ID)
    ));

    $modelJoin = new RequestJoinForm;

    $dayOptions = array(
        0 => "don't know",
        1 => 'n/a',
        2 => 'daytime',
        3 => 'evening',
        4 => 'all day'
    );

    ?>
    <table>
        <thead>
        <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tues</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php

            foreach (DayOfWeek::$Lookup as $i => $name)
            {
                echo "<td>\n";
                echo $formJoin->dropDownList($modelJoin, "availability[{$i}]", $dayOptions);
                echo "</td>\n";
            }

            ?>
        </tr>
        </tbody>
    </table>
    <?php echo CHtml::submitButton('Join request', array('name' => 'submit', 'class' => 'button primary radius')); ?>
    <?php $this->endWidget(); ?>
    <a class="close-reveal-modal">&#215;</a>
</div>

<!----- Modal ------------->
<div id="leaveRequest" class="reveal-modal small">
    <h2>Leave this Request</h2>

    <p>Are you sure you want to leave this class request? You won't receive a notification if it get's picked up. You
        can join again later if you'd like.</p>
    <a href="#" onclick="$('#leaveRequest').trigger('reveal:close'); return false;"
       class="button secondary radius stretch spacebot10">No, take me back</a>
    <?php echo CHtml::link('Yes, leave this request', array('/request/leave', 'id' => $userID), array('class' => 'button secondary radius stretch twelve')); ?>
    <a class="close-reveal-modal">&#215;</a>
</div>