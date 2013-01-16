<h4>Session <?php echo $session->Session_ID; ?> Info</h4>
<ul>
    <?php
    foreach ($session->lessons as $i => $lesson)
    {
        $lessonNum = $i + 1;

        echo "<li>Lesson {$lessonNum}: {$lesson->Start} - {$lesson->End}</li>\n";
    }
    ?>
</ul>
<div class="enrollees spacebot10">
    <?php
    foreach ($session->students as $student)
    {
        $imageLink = 'http://placeskull.com/100/100/01a4a4';

        if ($student->profilePic != null)
        {
            $imageLink = $student->profilePic;
        }

        $imageHTML = "<img src='{$imageLink}' alt='{$student->fullname}' title='{$student->fullname}' />\n";

        echo CHtml::link($imageHTML, array('/user/view', 'id' => $student->User_ID));
    }
    ?>
</div>

<?php
echo CHtml::link('Enroll',
    array('/class/join', 'id' => $model->Class_ID, 'session' => $session->Session_ID),
    array('class' => 'button radius stretch')
);
?>

<!--<a href="<?php /*echo $this->createAbsoluteUrl('//class/join', array('id' => $model->Class_ID, 'session' => $session->Session_ID)); */?>"
   class="button radius stretch">Enroll</a>-->