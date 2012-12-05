<!--------- main content container------>
<div class="row" id="wrapper">
<!---- left sidebar------>
<div class="three columns">

    <?php
    $imageLink = 'http://placehold.it/300x300';

    if($model->profilePic != null)
    {
        $imageLink = $model->profilePic;
    }

    echo "<img src='{$imageLink}' alt='{$model->fullname}' title='{$model->fullname}' />\n";
    ?>

    <a href="#" class="twelve button secondary" data-reveal-id="myModal">Send a message</a>

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'update-form',
    'enableAjaxValidation' => false,
    'action' => array('user/update'),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <?php echo CHtml::fileField('profilePic'); ?>
    <?php echo CHtml::submitButton(); ?>

    <?php $this->endWidget(); ?>

    <div class="profileBadges">
        <span class="profileCount">15</span>

        <h2>Merit Badges</h2>

        <p>Merit badges are awarded by the instructor once you've completed a class. Each one represents a
            meaningful experience and new knowledge acquired. Wear them with honor.</p>
        <a href="#" class="button tiny secondary spacebot10">List view</a>

        <div class="row">
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/01a4a4"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/d70060"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/f18d05"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/113f8c"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/d70060"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/61ae24"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/d70060"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/01a4a4"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/d70060"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/f18d05"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/113f8c"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/d70060"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/61ae24"></a>
                </div>
            </div>
            <div class="three columns">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/d70060"></a>
                </div>
            </div>
            <div class="three columns end">
                <div class="oneBadge"><a href="class_detail.html"><img
                        src="http://placeskull.com/100/100/01a4a4"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!---- Right side----------->
<div class="nine columns profilePublic">
    <h1>
        <?php echo $model->fullname; ?>
    </h1>
        <span class="profileRating">
            <a href="user_profile_reviews.html">95</a>
        </span>
    <span class="profileStar">15</span>
    <span class="profileLocation">Los Angeles, California</span>
    <span class="profileSince">Kowop'ing since <?php echo $model->Created; ?></span>
    <span class="profileDescription"><?php echo $model->Description; ?></span>

    <span class="profileCount"><?php echo count($model->kClasses); ?></span>

    <h2>Classes I'm teaching</h2>

    <div class="row">
        <?php
        foreach ($model->kClasses as $class)
        {
            $imgLink = 'http://placehold.it/400x300';

            if (count($class->contents) > 0)
            {
                $imgLink = $class->contents[0]->Link;
            }

            $classLink = CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID));

            echo <<<BLOCK
                <div class="three columns end">
                    <div class="profileTile">
                        <img src="{$imgLink}">
                        <span class="profileClassTitle">
                            {$classLink}
                        </span>
                    </div>
                </div>
BLOCK;
        }
        ?>
    </div>
    <span class="profileCount"><?php echo count($model->enrolledIn); ?></span>

    <h2>Classes I'm enrolled in</h2>

    <div class="row">
        <?php

        foreach ($model->enrolledIn as $class)
        {
            $imgLink = 'http://placehold.it/400x300';
            if (count($class->contents) > 0)
            {
                $imgLink = $class->contents[0]->Link;
            }

            $classLink = CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID));

            echo <<<BLOCK
        <div class="three columns">
            <div class="profileTile">
                <img src="{$imgLink}">
                    <span class="profileClassTitle">
                        {$classLink}
                    </span>
            </div>
        </div>
BLOCK;

        }

        ?>
    </div>

    <span class="profileCount"><?php echo count($model->requests); ?></span>

    <h2>My class requests</h2>

    <div class="row">
        <?php

        foreach ($model->requests as $request)
        {
            $requestLink = CHtml::link($request->Name, array('/request/view', 'id' => $request->Request_ID));

            echo <<<BLOCK
        <div class="three columns">
            <div class="profileTile">
                <img src="http://placehold.it/400x300">
                <span class="profileClassTitle">
                    {$requestLink}
                </span>
            </div>
        </div>
BLOCK;
        }

        ?>
    </div>
    <span class="profileCount">0</span>

    <h2>Classes I've taught</h2>

    <div class="row">
        <!--        <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>-->
    </div>
</div>
<!------- end main content container----->
</div>
