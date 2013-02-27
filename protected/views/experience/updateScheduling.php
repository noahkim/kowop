<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="three columns sideNav">
        <h2>Edit your listing</h2>
        <ul class="side-nav">
            <li>
                <?php echo CHtml::link('General Information', array('/experience/update', 'id' => $model->Experience_ID)); ?>
            </li>
            <li>
                <?php echo CHtml::link('Pricing &amp; Description', array('/experience/updateDescription', 'id' => $model->Experience_ID)); ?>
            </li>
            <li class="active"><a href="#">Scheduling</a></li>
        </ul>
    </div>
    <div class="nine columns">
        <h1>Editing "<?php echo $model->Name; ?>"</h1>

        <p>While this step is optional, providing it gives you some benefits (look to the right). Add any time and day
            you'd like to make available. Don't worry about getting them all in now. You can always come back and add
            more. Make it as specific (like 10am-11am) or as general (8am-8pm) as you'd like.</p>

        <?php
        $form = $this->beginWidget('CActiveForm',
            array('id' => 'experience-update-form', 'enableAjaxValidation' => false,
                'stateful' => true,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),));
        ?>

        <input type='hidden' name='step' value='7' />
        <?php echo $form->hiddenField($model, 'sessionsJSON', array('id' => 'sessions')); ?>

        <div class="row">
            <div class="four columns">
                <label class="inline right">Available seats each session</label>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, 'Min_occupancy', array('placeholder' => 'min', 'maxlength' => '3',
                'id' => 'minOccupancy')); ?>
            </div>
            <div class="one column"><label class="text-center inline">-</label></div>
            <div class="two columns">
                <?php echo $form->textField($model, 'Max_occupancy', array('placeholder' => 'max', 'maxlength' => '3',
                'id' => 'maxOccupancy')); ?>
            </div>
            <div class="two columns end">
                <label class="inline">(optional)</label>
            </div>
        </div>

        <?php $this->endWidget(); ?>

        <div id='calendar' class="scheduleCalendar"></div>

        <div class="row">
            <div class="four columns offset-by-four">
                <?php echo CHtml::link('Cancel', array('/experience/view', 'id' => $model->Experience_ID), array('class' => 'button twelve')); ?>
            </div>
            <div class="four columns">
                <a href="#" class="button twelve" onclick="submitForm(); return false;">Save</a>
            </div>
        </div>
    </div>
    <!------- end main content container----->
</div>

<script>
    var lastID = 0;

    $(document).ready(function ()
    {
        var events = [];
        var eventsJSON = $('<div/>').text($('#sessions').val()).html();
        var eventsData = jQuery.parseJSON(eventsJSON);

        for (var i in eventsData)
        {
            var session = {
                title :'',
                start :eventsData[i].Start,
                end   :eventsData[i].End,
                new   :eventsData[i].New,
                id    :eventsData[i].Session_ID,
                allDay:false
            };

            events.push(session);
        }

        $('#calendar').fullCalendar({
            header:{
                left  :'prev,next today',
                center:'title',
                right :'month,agendaWeek,agendaDay'
            },

            defaultView :'agendaWeek',
            selectable  :true,
            selectHelper:true,
            editable    :true,
            select      :function (start, end, allDay)
            {
                $('#calendar').fullCalendar('renderEvent',
                        {
                            title :'',
                            start :start,
                            end   :end,
                            allDay:allDay,
                            id    :'newSession' + (lastID++),
                            new   :1
                        },
                        true // make the event "stick"
                );
                $('#calendar').fullCalendar('unselect');
            },
            eventRender :function (event, element)
            {
                element.bind("contextmenu", function (e)
                {
                    $('#calendar').fullCalendar('removeEvents', event.id);
                    return false;
                });
            },
            events      :events
        });
    });

    function submitForm()
    {
        var clientEvents = $('#calendar').fullCalendar('clientEvents');
        var sessions = [];

        for (var i in clientEvents)
        {
            var start = clientEvents[i].start.toString('yyyy-MM-dd HH:mm:ss');
            var end = clientEvents[i].end.toString('yyyy-MM-dd HH:mm:ss');

            var session = {
                Start:start,
                End  :end,
                New  :clientEvents[i].new
            };

            sessions.push(session);
        }

        if (sessions.length == 0)
        {
            $('#sessions').val('');
        }
        else
        {
            var sessionsJSON = JSON.stringify(sessions);
            $('#sessions').val(sessionsJSON);
        }
        document.forms['experience-update-form'].submit();
    }
</script>
