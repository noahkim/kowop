<h4>Session Info</h4>
<ul>
    <?php
    echo "<li>" . date('g a', strtotime($session->Start)) . " - " . date('g a', strtotime($session->End)) . "</li>\n";
    ?>
</ul>
<div class="enrollees spacebot10">
    <?php
    foreach ($session->enrolled as $enrollee)
    {
        $imageHTML = "<img src='{$enrollee->profilePic}' alt='{$enrollee->fullname}' title='{$enrollee->fullname}' />\n";

        echo CHtml::link($imageHTML, array('/user/view', 'id' => $enrollee->User_ID));
    }
    ?>
</div>

<?php
echo CHtml::link('Enroll',
    array('/experience/signup', 'id' => $model->Experience_ID, 'session' => $session->Session_ID),
    array('class' => 'button radius stretch')
);
?>
