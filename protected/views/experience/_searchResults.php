<?php

echo "<div class='row'>\n";

$remaining = 0;

$user = null;
if (!Yii::app()->user->isGuest)
{
    $user = User::model()->findByPk(Yii::app()->user->id);
}

foreach ($results as $i => $item)
{
    $hostLink = CHtml::link($item->createUser->display, array('/user/view', 'id' => $item->Create_User_ID));

    $sessionHTML = 'Request';
    if ($item instanceof Experience)
    {
        if (($item->Price == null) || ($item->Price == 0))
        {
            $type = strtolower(ExperienceType::$Lookup[$item->ExperienceType]);

            $sessionHTML = "This {$type} is free!";
        }
        else
        {
            $sessionHTML = "\${$item->Price}";
        }
    }

    $itemNumber = $i + 1;

    $itemName = $item->Name;
    if (strlen($itemName) > 50)
    {
        $itemName = substr($itemName, 0, 50);
        $itemName .= ' ...';
    }
    $name = "<h5> {$itemName} </h5>";
    $type = 'experience';

    if ($item instanceof Experience)
    {
        $name = CHtml::link($name, array('/experience/view', 'id' => $item->Experience_ID));
    }
    elseif ($item instanceof Request)
    {
        $name = CHtml::link($name, array('/request/view', 'id' => $item->Request_ID));
        $type = 'request';
    }

    if ($item instanceof Experience)
    {
        //<span class="ribbon staffpick"></span>

        $imageHTML = "<img src='http://flickholdr.com/400/300/bbq' />";
        if (count($item->contents) > 0)
        {
            $link = $item->contents[0]->Link;
            $imageHTML = "<img src='{$link}' />";
        }

        $imageLink = CHtml::link($imageHTML, array('/experience/view', 'id' => $item->Experience_ID));

        $enrollees = '';
        foreach ($item->enrolled as $enrollee)
        {
            $picLink = 'http://placeskull.com/100/100/868686';

            if ($enrollee->profilePic != null)
            {
                $picLink = $enrollee->profilePic;
            }

            $enrolleeText = "<img src='{$picLink}' alt='{$enrollee->fullname}' title='{$enrollee->fullname}' />";
            $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $enrollee->User_ID)) . "\n";
        }

        echo <<<BLOCK

    <!----------- 1 tile ---------->
    <div class="four columns">
        <div id="result{$type}{$item->Experience_ID}" class="classTile">
            <span class="tilenumber">{$itemNumber}</span>
            {$imageLink}
            {$name}
            <span class="tileInstructor">by {$hostLink}</span>
            <div class="tileStudents">
                {$enrollees}
            </div>
        </div>
        <div class="classCost">
            {$sessionHTML}
        </div>
    </div>
    <!------- end 1 tile -------->

BLOCK;
    }
    elseif ($item instanceof Request)
    {
        $joinLink = CHtml::link('Quick Join', array('/request/join', 'id' => $item->Request_ID));

        if ($user != null && (count($user->requestsJoined(array('condition' => 'requestsJoined.Request_ID = ' . $item->Request_ID))) > 0))
        {
            $joinLink = CHtml::link("You've joined this request", array('/request/view', 'id' => $item->Request_ID));
        }

        $enrollees = '';
        foreach ($item->requestors as $enrollee)
        {
            $picLink = 'http://placeskull.com/100/100/868686';

            if ($enrollee->profilePic != null)
            {
                $picLink = $enrollee->profilePic;
            }

            $enrolleeText = "<img src='{$picLink}' alt='{$enrollee->fullname}' title='{$enrollee->fullname}' />";
            $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $enrollee->User_ID)) . "\n";
        }

        echo <<<BLOCK

    <!----------- 1 REQUEST tile ---------->
    <div class="four columns">
    <span class="ribbon request"></span>
      <div id="result{$type}{$item->Request_ID}" class="requestTile">
      <span class="tilenumber">{$itemNumber}</span>
        {$name}
        <span class="tileInstructor">by {$hostLink}</span>
        <div class="tileStudents">
            {$enrollees}
        </div>
      </div>
        <div class="requestJoin">
            {$joinLink}
        </div>
    </div>
    <!------- end 1 tile -------->

BLOCK;

    }

    if (($itemNumber % 3) == 0)
    {
        echo "</div>\n";
        echo "<div class='row'>\n";
    }

    $remaining = 3 - ($itemNumber % 3);
}

for ($i = 0; $i < $remaining; $i++)
{
    echo "<div class='four columns'>\n";
    echo "</div>\n";
}

echo "</div>\n";
?>

<!--- pagination --->
<ul class="pagination">
    <?php
    if ($model->page == 1)
    {
        echo "<li class='arrow unavailable'>&laquo;</li>\n";
    }
    else
    {
        $link = CHtml::link('&laquo;', array('experience/search', 'ExperienceSearchForm[page]' => $model->page - 1));
        echo "<li class='arrow'>{$link}</li>\n";
    }

    for ($i = 1; ($i <= $model->totalPages) && ($i <= 3); $i++)
    {
        $current = '';
        if ($i == $model->page)
        {
            $current = "class='current'";
        }

        $link = CHtml::link($i, array('experience/search', 'ExperienceSearchForm[page]' => $i));

        echo "<li {$current}>{$link}</li>\n";
    }

    if ($model->totalPages > 3)
    {
        echo "<li class='unavailable'><a href=''>&hellip;</a></li>\n";

        for ($i = $model->totalPages; $i >= ($model->totalPages - 3); $i--)
        {
            $current = '';
            if ($i == $model->page)
            {
                $current = "class='current'";
            }

            $link = CHtml::link($i, array('experience/search', 'ExperienceSearchForm[page]' => $i));

            echo "<li {$current}>{$link}</li>\n";
        }
    }

    if ($model->page == $model->totalPages)
    {
        echo "<li class='arrow unavailable'>&raquo;</li>\n";
    }
    else
    {
        $link = CHtml::link('&raquo;', array('experience/search', 'ExperienceSearchForm[page]' => $model->page + 1));
        echo "<li class='arrow'>{$link}</li>\n";
    }

    ?>
</ul>
<!----- end pagination--->
