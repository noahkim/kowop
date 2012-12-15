<h4><?php echo $model->class->Name; ?></h4>
<ul>
    <li>Start Time: <?php echo $model->Start; ?></li>
    <li>End Time: <?php echo $model->End; ?></li>
    <li>Duration: <?php echo $model->class->LessonDuration; ?> hour(s)</li>
</ul>
<div class="enrollees spacebot10">
    <?php
        foreach($model->session->students as $student)
        {
            $imageLink = 'http://placeskull.com/100/100/01a4a4';

            if($student->profilePic != null)
            {
                $imageLink = $student->profilePic;
            }

            $imageHTML = "<img src='{$imageLink}' alt='{$student->fullname}' title='{$student->fullname}' />\n";

            echo CHtml::link($imageHTML, array('/user/view', 'id' => $student->User_ID));
        }
    ?>
</div>

<?php echo CHtml::link('View Class Details', array('/class/view', 'id' => $model->class->Class_ID), array('class' => 'button radius stretch')); ?>
