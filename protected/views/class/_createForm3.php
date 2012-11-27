<?php
/* @var $this ClassController */
/* @var $model KClass */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'class-create-form',
    'enableAjaxValidation' => false,
    'stateful' => true
)); ?>

    <div id="external-events" style="width: 200px;">
        <?php
        for ($i = 1; $i <= $model->numSessions; $i++)
        {
            echo "<div class='external-event'>{$model->name}</div>\n";
        }
        ?>
    </div>

    <div>
        <div id="calendar" style="width: 600px;"></div>
    </div>

    <div class="row">
        <?php echo $form->hiddenField($model, 'sessions'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Create', array('name' => 'submit', 'id' => 'submit')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<div id="hover">
    Starts:
    <select id="startHour">
        <option value="12">12</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>
    :
    <select id="startMinute">
        <option value="00">00</option>
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="45">45</option>
    </select>
    &nbsp;
    <select id="startAMPM">
        <option value="AM">AM</option>
        <option value="PM">PM</option>
    </select>
    <br/>

    Ends:
    <select id="endHour">
        <option value="12">12</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>
    :
    <select id="endMinute">
        <option value="00">00</option>
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="45">45</option>
    </select>
    &nbsp;
    <select id="endAMPM">
        <option value="AM">AM</option>
        <option value="PM">PM</option>
    </select>
    <br/>
</div>

<script type='text/javascript'>

    $(document).ready(function () {

        $('#hover').hide();

        $('#submit').click(function () {

            var remaining = $('#external-events div.external-event').length;
            if (remaining > 0) {
                alert('Please assign all class sessions before proceeding.');
                return false;
            }

            var events = $('#calendar').fullCalendar('clientEvents');
            var data = {
                sessions:[]
            };

            for (var i in events) {
                data.sessions[i] = {
                    title:events[i].title,
                    start:events[i].start,
                    end:events[i].end
                };
            }

            $('#ClassCreateForm_sessions').val(JSON.stringify(data));
        });

        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title:$.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex:999,
                revert:true, // will cause the event to go back to its
                revertDuration:0  //  original position after the drag
            });

        });

        /* initialize the calendar
        -----------------------------------------------------------------*/

        $('#calendar').fullCalendar(
                {
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    },
                    editable:true,
                    droppable:true, // this allows things to be dropped onto the calendar !!!
                    drop:function (date, allDay) { // this function is called when something is dropped

                        if (
                                (date < (new Date()))
                                        || (date < Date.parse("<?php echo $model->start; ?>"))
                                        || (date > Date.parse("<?php echo $model->end; ?>"))
                                ) {
                            return;
                        }
                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;

                        var endDate = new Date(date);
                        endDate.setHours(endDate.getHours() + 1);
                        copiedEventObject.end = endDate;

                        copiedEventObject.allDay = false;

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                        $(this).remove();
                    },
                    eventDrop:function (event, dayDelta, minuteDelta, allDay, revertFunc) {
                        if (
                                (event.start < (new Date()) || allDay)
                                        || (event.start < Date.parse("<?php echo $model->start; ?>"))
                                        || (event.end > Date.parse("<?php echo $model->end; ?>"))
                                ) {
                            revertFunc();
                        }

                    },
                    eventClick:function (event, jsEvent, view) {
                        var startHour = event.start.getHours();
                        if (startHour >= 12) {
                            $('#startAMPM').val('PM');
                            $('#startHour').val(startHour - 12);
                        }
                        else {
                            $('#startAMPM').val('AM');
                            $('#startHour').val(startHour);
                        }
                        $('#startMinute').val(event.start.getMinutes());

                        var endHour = event.end.getHours();
                        if (endHour >= 12) {
                            $('#endAMPM').val('PM');
                            $('#endHour').val(endHour - 12);
                        }
                        else {
                            $('#endAMPM').val('AM');
                            $('#endHour').val(endHour);
                        }
                        $('#endMinute').val(event.end.getMinutes());

                        $('#hover').dialog({
                            position:{
                                my:"center bottom",
                                at:"center top",
                                of:this
                            },
                            minWidth:400,
                            title:"Time for " + event.title,
                            buttons:{
                                Save:function () {
                                    var startTime = new Date();
                                    var endTime = new Date();

                                    startTime.setSeconds(0);
                                    endTime.setSeconds(0);

                                    var startHour = parseInt($('#startHour').val());
                                    var endHour = parseInt($('#endHour').val());

                                    if ($('#startAMPM').val() == 'PM') {
                                        if (startHour != 12) {
                                            startHour += 12;
                                        }
                                    }
                                    else if (startHour == 12) {
                                        startHour = 0;
                                    }

                                    if ($('#endAMPM').val() == 'PM') {
                                        if (endHour != 12) {
                                            endHour += 12;
                                        }
                                    }
                                    else if (endHour == 12) {
                                        endHour = 0;
                                    }

                                    startTime.setHours(startHour);
                                    endTime.setHours(endHour);

                                    startTime.setMinutes(parseInt($('#startMinute').val()));
                                    endTime.setMinutes(parseInt($('#endMinute').val()));

                                    var calendarDate = event.start.getDate();

                                    startTime.setDate(calendarDate);
                                    endTime.setDate(calendarDate);

                                    if (endTime <= startTime) {
                                        alert('End time must be after the start time');
                                        return;
                                    }

                                    event.start = startTime;
                                    event.end = endTime;

                                    $('#calendar').fullCalendar('updateEvent', event);

                                    $(this).dialog("close");
                                },
                                Cancel:function () {
                                    $(this).dialog("close");
                                }
                            }
                        }).dialog("open");
                    }
                });
    });
</script>