<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>My listings</h1>

    <!----- current listings --------->
    <span class="profileCount"><?php echo count($model->experiences(array('scopes' => array('active', 'current')))); ?></span>

    <h2>Current listings</h2>

    <div class="row">
        <?php

        $index = 1;

        $experiences = $model->experiences(array('scopes' => array('active', 'current')));

        foreach ($experiences as $experience)
        {
            $link = CHtml::link($experience->Name, array('/experience/view', 'id' => $experience->Experience_ID));

            $end = '';
            if ($index == count($experiences))
            {
                $end = 'end';
            }

            echo <<<BLOCK
                <div class="three columns {$end}">
                    <div class="profileTile">
                        <img src="{$experience->picture}">
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
    <!------ end current listings -------->

    <!------ Past listings ------------->
    <span class="profileCount"><?php echo count($model->experiences(array('scopes' => array('active', 'past')))); ?></span>

    <h2>Past listings</h2>

    <div class="row">
        <?php

        $index = 1;

        $experiences = $model->experiences(array('scopes' => array('active', 'past')));

        foreach ($experiences as $experience)
        {
            $link = CHtml::link($class->Name, array('/experience/view', 'id' => $class->Experience_ID));

            $end = '';
            if ($index == count($experiences))
            {
                $end = 'end';
            }

            echo <<<BLOCK
                <div class="three columns {$end}">
                    <div class="profileTile">
                        <img src="{$experience->picture}">
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
    <!------ End past listings ---->

    <!-------- end right column --------->
</div>