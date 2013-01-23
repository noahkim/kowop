<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>My Classes</h1>
    <!---- Need to review ---------->
    <span class="profileCount">0</span>

    <h2>Leave Feedback for the following classes</h2>

    <div class="row">
        <!--        <div class="three columns">
                    <div class="profileTile"> <img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a href="class_detail.html" class="spacebot10">Class Title</a></span>
                        <a href="#" class="button radius tiny secondary twelve" data-reveal-id="leaveFeedback">Leave Feedback</a>
                    </div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"> <img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a href="class_detail.html" class="spacebot10">Class Title</a></span>
                        <a href="#" class="button radius tiny secondary twelve" data-reveal-id="leaveFeedback">Leave Feedback</a>
                    </div>
                </div>-->
    </div>

    <!---- enrolled classes ---------->
    <?php
        $enrolledIn = $model->enrolledIn(array('condition' => 'Status = ' . ClassStatus::Active));
    ?>
    <span class="profileCount"><?php echo count($enrolledIn); ?></span>

    <h2>Enrolled classes</h2>

    <div class="row">
        <?php

        $index = 1;


        foreach ($enrolledIn as $class)
        {
            $imgLink = 'http://placehold.it/400x300';
            if (count($class->contents) > 0)
            {
                $imgLink = $class->contents[0]->Link;
            }

            $classLink = CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID));

            $end = '';
            if ($index == count($enrolledIn))
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
    <!---- class requests classes ---------->
    <span class="profileCount"><?php echo count($model->requestsJoined); ?></span>

    <h2>Class requests</h2>

    <div class="row">
        <?php

        $index = 1;

        foreach ($model->requestsJoined as $request)
        {
            $requestLink = CHtml::link($request->Name, array('/request/view', 'id' => $request->Request_ID));

            $end = '';
            if ($index == count($model->requestsJoined))
            {
                $end = 'end';
            }

            echo <<<BLOCK
        <div class="three columns {$end}">
            <div class="profileTile">
                {$requestLink}
            </div>
        </div>

BLOCK;

            $index++;
        }

        ?>
    </div>
    <!---- copmleted classes ---------->
    <span class="profileCount">0</span>

    <h2>Completed classes</h2>

    <div class="row">
        <!--        <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>
                <div class="three columns end">
                    <div class="profileTile"><img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a
                            href="class_detail.html">Class Title</a></span></div>
                </div>-->
    </div>
    <!-------- end right column --------->
</div>