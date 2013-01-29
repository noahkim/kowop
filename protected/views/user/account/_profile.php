<!--------- main content container------>
<div class="row" id="wrapper">
    <!---- left sidebar------>
    <div class="three columns">
        <div class="spacebot10">
            <?php
            $imageLink = 'http://placehold.it/300x300';

            if ($model->profilePic != null)
            {
                $imageLink = $model->profilePic;
            }

            echo "<img src='{$imageLink}' alt='{$model->fullname}' title='{$model->fullname}' />\n";
            ?>
        </div>
        <div class="spacebot10">
            <a href="#" class="twelve button" data-reveal-id="myModal">Send a message</a>
        </div>
        <div>
            <?php
            $showFriendRequest = true;

            if (!Yii::app()->user->isGuest)
            {
                $user = User::model()->findByPk(Yii::app()->user->id);
                if ($user->isFriendsWith($model->User_ID))
                {
                    $showFriendRequest = false;
                }
            }
            ?>
            <?php if ($showFriendRequest) : ?>
                <a href="#" class="twelve button" data-reveal-id="homieRequest">Homie request</a>
            <?php else: ?>
                <a href="#" class="twelve button">You are homies</a>
            <?php endif; ?>
        </div>
        <div class="profileBadges">
            <div class="helptip">
                <span class="has-tip tip-top noradius" data-width="300"
                      title="Merit badges are awarded by the instructor once you've completed a class. Each one represents a meaningful experience and new powers acquired. Wear them with honor!">?</span>
            </div>
            <span class="profileCount">16</span>

            <h2>Merit Badges</h2>

            <div class="meritBadges">
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="class_detail.html"><img src="http://placeskull.com/100/100/01a4a4"></a>
            </div>
        </div>
    </div>
    <!---- Right side----------->
    <div class="nine columns profilePublic">
        <h1><?php echo $model->fullname; ?></h1>
        <span class="profileRating"><a href="user_profile_reviews.html">95</a></span>
        <span class="profileLocation">Los Angeles, California</span>
        <span class="profileSince">Kowop'ing since <?php echo date('F Y', strtotime($model->Created)); ?></span>
        <span class="profileDescription"><?php echo $model->Description; ?></span>
        <span class="profileCount"><?php echo count($model->experiences); ?></span>

        <h2>Classes I'm teaching</h2>

        <div class="row">
            <?php

            $index = 1;

            foreach ($model->experiences as $class)
            {
                $imgLink = 'http://placehold.it/400x300';

                if (count($class->contents) > 0)
                {
                    $imgLink = $class->contents[0]->Link;
                }

                $classLink = CHtml::link($class->Name, array('/experience/view', 'id' => $class->Experience_ID));

                $end = '';
                if ($index == count($model->experiences))
                {
                    $end = 'end';
                }

                echo <<<BLOCK
                <div class="three columns {$end}">
                    <div class="profileTile">
                        <img src="{$imgLink}">
                        <span class="profileClassTitle">
                            {$classLink}
                        </span>
                    </div>
                </div>
BLOCK;

                $index++;
            }
            ?>
        </div>
        <span class="profileCount"><?php echo count($model->enrolledIn); ?></span>

        <h2>Classes I'm enrolled in</h2>

        <div class="row">
            <?php

            $index = 1;

            foreach ($model->enrolledIn as $class)
            {
                $imgLink = 'http://placehold.it/400x300';
                if (count($class->contents) > 0)
                {
                    $imgLink = $class->contents[0]->Link;
                }

                $classLink = CHtml::link($class->Name, array('/experience/view', 'id' => $class->Experience_ID));

                $end = '';
                if ($index == count($model->enrolledIn))
                {
                    $end = 'end';
                }

                echo <<<BLOCK
        <div class="three columns {$end}">
            <div class="profileTile">
                <img src="{$imgLink}">
                    <span class="profileClassTitle">
                        {$classLink}
                    </span>
            </div>
        </div>
BLOCK;

                $index++;
            }

            ?>
        </div>
        <span class="profileCount"><?php echo count($model->requests); ?></span>

        <h2>My class requests</h2>

        <div class="row">
            <?php

            $index = 1;

            foreach ($model->requests as $request)
            {
                $requestLink = CHtml::link($request->Name, array('/request/view', 'id' => $request->Request_ID));

                $end = '';
                if ($index == count($model->requests))
                {
                    $end = 'end';
                }

                echo <<<BLOCK
        <div class="three columns {$end}">
            <div class="profileTile">
                <img src="http://placehold.it/400x300">
                <span class="profileClassTitle">
                    {$requestLink}
                </span>
            </div>
        </div>
BLOCK;

                $index++;
            }

            ?>
        </div>
        <span class="profileCount">0</span>

        <h2>Classes I've taught</h2>

        <div class="row">
        </div>
    </div>
    <!------- end main content container----->
</div>

<!----------------- Modal--------------------->
<div id="myModal" class="reveal-modal small">
    <h2>Send <?php echo $model->First_name; ?> a message</h2>

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'send-message-form',
    'action' => Yii::app()->createUrl('/user/sendMessage', array('id' => $model->User_ID)),
    'enableAjaxValidation' => false
)); ?>

    <textarea name="message" rows="10"></textarea>
    <input type="submit" value="send" class="button secondary radius">

    <?php $this->endWidget('CActiveForm'); ?>

    <a class="close-reveal-modal">&#215;</a>
</div>

<!----------------- Modal--------------------->
<div id="homieRequest" class="reveal-modal small">
    <h2>Homie Request</h2>

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'add-homie-form',
    'action' => Yii::app()->createUrl('/user/friendRequest', array('id' => $model->User_ID)),
    'enableAjaxValidation' => false
)); ?>

    <textarea name="message" rows="10"></textarea>
    <input type="submit" value="Request" class="button secondary radius">

    <?php $this->endWidget('CActiveForm'); ?>

    <a class="close-reveal-modal">&#215;</a>
</div>