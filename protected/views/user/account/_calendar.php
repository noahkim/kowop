<!------- right column ------------->
<h1>Experience Calendar</h1>
<div class="nine columns accountCalendar">
    <p>Click on a scheduled experience in the calendar for more information.</p>
    <!---- legend ---->
    <div class="row">
        <div class="twelve columns legend">
            <span class="accountLegendEnrolled"></span>
            <span>Experiences I've signed up for</span>
            <span class="accountLegendTeaching"></span>
            <span>Experiences I'm hosting</span>
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
            foreach ($model->enrolledIn as $experience)
            {
                $experienceLink = Yii::app()->createUrl('/experience/view', array('id' => $experience->Experience_ID));

                foreach ($experience->sessions as $session)
                {
                    echo <<<BLOCK
                    {
                        title:"{$experience->Name}",
                        start: Date.parse('{$session->Start}'),
                        end: Date.parse('{$session->End}'),
                        session: {$session->Session_ID}
                    },
BLOCK;
                }
            }

            foreach ($model->experiences as $experience)
            {
                $experienceLink = Yii::app()->createUrl('/experience/view', array('id' => $experience->Experience_ID));

                foreach ($experience->sessions as $session)
                {
                    echo <<<BLOCK
                    {
                        title:"{$experience->Name}",
                        start: Date.parse('{$session->Start}'),
                        end: Date.parse('{$session->End}'),
                        session: {$session->Session_ID},
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



