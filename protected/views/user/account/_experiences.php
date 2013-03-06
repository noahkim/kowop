<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>My Experiences</h1>
    <!---- Need to review ----------><!--    <span class="profileCount">0</span>

    <h2>Leave Feedback for the following experiences</h2>

    <div class="row">
    </div>-->

    <!---- enrolled classes ---------->
    <span class="profileCount"><?php echo count($model->enrolledIn); ?></span>

    <h2>Upcoming experiences you've signed up for</h2>

    <div class="row">
        <?php

        $index = 1;


        foreach ($model->enrolledIn as $experience)
        {
            $link = CHtml::link($experience->Name, array('/experience/view', 'id' => $experience->Experience_ID));

            $end = '';
            if ($index == count($model->enrolledIn))
            {
                $end = 'end';
            }

            echo <<<BLOCK
        <div class="three columns {$end}">
            <div class="profileTile">
                <img src="{$experience->picture}" />
                    <span class="profileClassTitle">
                        {$link}
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

    <h2>Your requests</h2>

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
    <span class="profileCount"><?php echo count($model->pastExperiences); ?></span>

    <h2>Past experiences</h2>

    <div class="row">
        <?php

        $index = 1;


        foreach ($model->pastExperiences as $experience)
        {
            $link = CHtml::link($experience->Name, array('/experience/view', 'id' => $experience->Experience_ID));

            $end = '';
            if ($index == count($model->pastExperiences))
            {
                $end = 'end';
            }

            echo <<<BLOCK
        <div class="three columns {$end}">
            <div class="profileTile">
                <img src="{$experience->picture}" />
                    <span class="profileClassTitle">
                        {$link}
                    </span>
            </div>
        </div>
BLOCK;

            $index++;
        }

        ?>
    </div>
    <!-------- end right column --------->
</div>