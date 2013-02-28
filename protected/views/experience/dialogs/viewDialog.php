<h4><?php echo $model->experience->Name; ?></h4>
<ul>
    <li>Start Time: <?php echo $model->Start; ?></li>
    <li>End Time: <?php echo $model->End; ?></li>
</ul>
<div class="enrollees spacebot10">
    <?php
    foreach ($model->enrolled as $enrollee)
    {
        $imageHTML = "<img src='{$enrollee->profilePic}' alt='{$enrollee->fullname}' title='{$enrollee->fullname}' />\n";

        echo CHtml::link($imageHTML, array('/user/view', 'id' => $enrollee->User_ID));
    }
    ?>
</div>

<?php echo CHtml::link('View Details', array('/experience/view', 'id' => $model->experience->Experience_ID),
                       array('class' => 'button radius stretch')); ?>
