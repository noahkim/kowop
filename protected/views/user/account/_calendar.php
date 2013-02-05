<!------- right column ------------->
<h1>Class Calendar</h1>
<div class="nine columns accountCalendar">
    <p>Click on a scheduled class in the calendar for more information.</p>
    <!---- legend ---->
    <div class="row">
        <div class="twelve columns legend">
            <span class="accountLegendEnrolled"></span>
            <span>Enrolled classes</span>
            <span class="accountLegendTeaching"></span>
            <span>Classes I'm teaching</span>
        </div>
    </div>
    <!---- end legend --->
    <div id='calendar'></div>
</div>
<!-------- end right column --------->

<script type='text/javascript'>

    $(document).ready(function () {

        $('#calendar').fullCalendar({
            editable:false,
            eventMouseover:function (event, jsEvent, view) {
                if (typeof $(this).data("qtip") !== "object") {
                    $(this).qtip({
                        content: {
                            url:'<?php echo $this->createAbsoluteUrl("/experience/viewDialog"); ?>' + '?session=' + event.session
                        },
                        position:{
                            corner:{
                                target:'topLeft',
                                tooltip:'bottomMiddle'
                            }
                        },
                        hide:{
                            fixed:true // Make it fixed so it can be hovered over
                        },
                        style:{
                            padding:'10px' // Give it some extra padding
                        }
                    });
                }
            },
            events:[
            <?php
            foreach ($model->enrolledIn as $class)
            {
                $classLink = Yii::app()->createUrl('/experience/view', array('id' => $class->Experience_ID));

                foreach ($class->lessons as $lesson)
                {
                    echo <<<BLOCK
                    {
                        title:"{$class->Name}",
                        start: Date.parse('{$lesson->Start}'),
                        end: Date.parse('{$lesson->End}'),
                        lesson: {$lesson->Lesson_ID}
                    },
BLOCK;
                }
            }

            foreach ($model->experiences as $class)
            {
                $classLink = Yii::app()->createUrl('/experience/view', array('id' => $class->Experience_ID));

                foreach ($class->lessons as $lesson)
                {
                    echo <<<BLOCK
                    {
                        title:"{$class->Name}",
                        start: Date.parse('{$lesson->Start}'),
                        end: Date.parse('{$lesson->End}'),
                        lesson: {$lesson->Lesson_ID},
                        color: '#D70060'
                    },
BLOCK;
                }
            }
            ?>
            ]
        });

    });
</script>



