<!----- Left Column for search results---->
<div class="nine columns">

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
    $teacherName = $item->createUser->Teacher_alias ? $item->createUser->Teacher_alias : $item->createUser->fullname;
    $teacherLink = CHtml::link($teacherName, array('/user/view', 'id' => $item->Create_User_ID));
    $description = $item->Description;
    if (strlen($description) > 85)
    {
        $description = substr($description, 0, 85);
        $description .= ' ...';
    }

    $sessionHTML = 'Request';
    if ($item instanceof KClass)
    {
        if (($item->Tuition == null) || ($item->Tuition == 0) || (count($item->sessions) == 0))
        {
            $sessionHTML = 'This class is free!';
        }
        else
        {
            $lessonCount = count($item->sessions[0]->lessons);
            $tuition = $item->Tuition * $lessonCount;

            $sessionHTML = "\${$tuition} ( {$lessonCount} lessons )";
        }
    }

    $itemNumber = $i + 1;

    $name = "<h5> {$item->Name} </h5>";
    if ($item instanceof KClass)
    {
        $name = CHtml::link($name, array('/class/view', 'id' => $item->Class_ID));
    }
    elseif ($item instanceof Request)
    {
        $name = CHtml::link($name, array('/request/view', 'id' => $item->Request_ID));
    }

    if ($item instanceof KClass)
    {
        //<span class="ribbon staffpick"></span>

        $imageHTML = "<img src='http://flickholdr.com/400/300/bbq' />";
        if (count($item->contents) > 0)
        {
            $link = $item->contents[0]->Link;
            $imageHTML = "<img src='{$link}' />";
        }

        $imageLink = CHtml::link($imageHTML, array('/class/view', 'id' => $item->Class_ID));

        $enrollees = '';
        foreach ($item->students as $student)
        {
            $picLink = 'http://placeskull.com/100/100/868686';

            if ($student->profilePic != null)
            {
                $picLink = $student->profilePic;
            }

            $enrolleeText = "<img src='{$picLink}' alt='{$student->fullname}' title='{$student->fullname}' />";
            $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $student->User_ID)) . "\n";
        }

        echo <<<BLOCK

    <!----------- 1 tile ---------->
    <div id="resultContainer{$i}" class="four columns">
        <div id="result{$i}" class="classTile">
            <span class="tilenumber">{$itemNumber}</span>
            {$imageLink}
            {$name}
            <span class="tileInstructor">by {$teacherLink}</span>
            <span class="tileDescription">{$description}</span>
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
        foreach ($item->requestors as $student)
        {
            $picLink = 'http://placeskull.com/100/100/868686';

            if ($student->profilePic != null)
            {
                $picLink = $student->profilePic;
            }

            $enrolleeText = "<img src='{$picLink}' alt='{$student->fullname}' title='{$student->fullname}' />";
            $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $student->User_ID)) . "\n";
        }

        echo <<<BLOCK

    <!----------- 1 REQUEST tile ---------->
    <div id="resultContainer{$i}" class="four columns">
    <span class="ribbon request"></span>
      <div id="result{$i}" class="requestTile">
      <span class="tilenumber">{$itemNumber}</span>
        {$name}
        <span class="tileInstructor">by {$teacherLink}</span>
        <span class="tileDescription">{$description}</span>
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
        $link = CHtml::link('&laquo;', array('class/search', 'ClassSearchForm[page]' => $model->page - 1));
        echo "<li class='arrow'>{$link}</li>\n";
    }

    for ($i = 1; ($i <= $model->totalPages) && ($i <= 3); $i++)
    {
        $current = '';
        if ($i == $model->page)
        {
            $current = "class='current'";
        }

        $link = CHtml::link($i, array('class/search', 'ClassSearchForm[page]' => $i));

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

            $link = CHtml::link($i, array('class/search', 'ClassSearchForm[page]' => $i));

            echo "<li {$current}>{$link}</li>\n";
        }
    }

    if ($model->page == $model->totalPages)
    {
        echo "<li class='arrow unavailable'>&raquo;</li>\n";
    }
    else
    {
        $link = CHtml::link('&raquo;', array('class/search', 'ClassSearchForm[page]' => $model->page + 1));
        echo "<li class='arrow'>{$link}</li>\n";
    }

    ?>
</ul>
<!----- end pagination--->

</div>
<!------ end left column------------------>