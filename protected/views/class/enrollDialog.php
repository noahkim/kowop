<h4>Session <?php echo $session->Session_ID; ?> Info</h4>
<ul>
    <?php
        foreach($session->lessons as $i => $lesson)
        {
            $lessonNum = $i + 1;

            echo "<li>Lesson {$lessonNum}: {$lesson->Start} - {$lesson->End}</li>\n";
        }
    ?>
<!--    <li>Lesson 1: Friday the 7th, 7:30pm-8:30pm</li>
    <li>Lesson 2: Saturday the 8th, 7:30pm-8:30pm</li>
    <li>Lesson 3: Sunday the 9th, 7:30pm-8:30pm</li>-->
</ul>
<div class="enrollees spacebot10">
    <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
    <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
    <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
    <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
    <img src="http://placehold.it/100x100">
    <img src="http://placehold.it/100x100">
</div>

<a href="#" class="button radius stretch">Enroll</a>