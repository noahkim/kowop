<h4>Session Info</h4>
<ul>
    <?php
        echo "<li>{$session->Start} - {$session->End}</li>\n";
    ?>
</ul>
<div class="enrollees spacebot10">
    <?php
    foreach ($session->enrolled as $enrollee)
    {
        $imageLink = 'http://placeskull.com/100/100/01a4a4';

        if ($enrollee->profilePic != null)
        {
            $imageLink = $enrollee->profilePic;
        }

        $imageHTML = "<img src='{$imageLink}' alt='{$enrollee->fullname}' title='{$enrollee->fullname}' />\n";

        echo CHtml::link($imageHTML, array('/user/view', 'id' => $enrollee->User_ID));
    }
    ?>
</div>

<?php
echo CHtml::link('Enroll',
    array('/experience/join', 'id' => $model->Experience_ID, 'session' => $session->Session_ID),
    array('class' => 'button radius stretch')
);
?>
