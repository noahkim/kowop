<?php
/* @var $this ClassController */
/* @var $model KClass */
/* @var $form CActiveForm */
?>

<!--------- main content container------>
<div class="row" id="wrapper">
    <!--------- end left column ------------->
    <div class="nine columns">
        <div class="createContainer">
            <h1>Class Schedule</h1>

            <div class="row">
                <div class="three columns">
                    <div id='external-events'>
                    </div>
                    <a href="#" onclick='addSession(); return false;' class="button radius twelve">Add a session</a>
                </div>
                <div class="nine columns">
                    <div id='calendar'></div>
                </div>
            </div>

            <div class="row borderTop">
                <div class="twelve columns alignRight">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'class-create-form',
                    'enableAjaxValidation' => false,
                    'stateful' => true,
                    'htmlOptions' => array('style' => 'margin: 0;')
                )); ?>
                    <?php echo $form->hiddenField($model, 'sessions'); ?>

                    <?php echo CHtml::submitButton('Review your class', array('name' => 'submit', 'id' => 'submit', 'class' => 'button radius')); ?>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-------------- end left column ----------->
    <!-------------- right column -------------->
    <div class="three columns">
        <h3>FAQ</h3>
    </div>
    <!---------------end right column---------->
    <!------- end main content container----->
</div>

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

var settings = {};

$(document).ready(function () {

    $('#hover').hide();

    settings.currentSession = 0;
    settings.numLessons = <?php echo $model->numLessons; ?>;
    settings.className = "<?php echo $model->name; ?>";
    addSession();

    $('#submit').click(function () {

        var remaining = $('#external-events div.external-event').length;
        if (remaining > 0) {
            alert('Please assign all class sessions before proceeding.');
            return false;
        }

        var events = $('#calendar').fullCalendar('clientEvents');
        var data = {};
        var sessions = {};

        for (var i in events) {
            var eventData = {
                title:events[i].title,
                start:events[i].start,
                end:events[i].end,
                session:events[i].session
            };

            sessionArray = new Array();

            if (sessions[events[i].session] != null) {
                sessionArray = sessions[events[i].session];
            }

            sessionArray.push(eventData);

            sessions[events[i].session] = sessionArray;
        }

        data.sessions = sessions;

        $('#ClassCreateForm_sessions').val(JSON.stringify(data));
    });

    /* initialize the calendar
    -----------------------------------------------------------------*/

    $('#calendar').fullCalendar(
            {
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month'
                },
                editable:true,
                droppable:true, // this allows things to be dropped onto the calendar !!!
                disableResizing:true,
                eventDragStop:function (event, jsEvent, ui, view) {
                    $(this).qtip("hide");
                },
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
                eventRender:function (event, element, view) {
                    if (event.start.getMonth() !== view.start.getMonth()) {
                        return false;
                    }
                },
                eventMouseover:function (event, jsEvent, view) {
                    if (typeof $(this).data("qtip") !== "object") {
                        $(this).qtip({
                            content:$('#hover').html(),
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
                            },
                            api:{
                                beforeShow:function () {
                                    var elements = $(this.elements.content);

                                    var startHour = event.start.getHours();
                                    if (startHour >= 12) {
                                        elements.find('#startAMPM').val('PM');
                                        elements.find('#startHour').val(startHour - 12);
                                    }
                                    else {
                                        elements.find('#startAMPM').val('AM');
                                        elements.find('#startHour').val(startHour);
                                    }
                                    elements.find('#startMinute').val(event.start.getMinutes());

                                    var endHour = event.end.getHours();
                                    if (endHour >= 12) {
                                        elements.find('#endAMPM').val('PM');
                                        elements.find('#endHour').val(endHour - 12);
                                    }
                                    else {
                                        elements.find('#endAMPM').val('AM');
                                        elements.find('#endHour').val(endHour);
                                    }
                                    elements.find('#endMinute').val(event.end.getMinutes());
                                },
                                onHide:function () {
                                    var elements = $(this.elements.content);

                                    var startTime = new Date();
                                    var endTime = new Date();

                                    startTime.setSeconds(0);
                                    endTime.setSeconds(0);

                                    var startHour = parseInt(elements.find('#startHour').val());
                                    var endHour = parseInt(elements.find('#endHour').val());

                                    if (elements.find('#startAMPM').val() == 'PM') {
                                        if (startHour != 12) {
                                            startHour += 12;
                                        }
                                    }
                                    else if (startHour == 12) {
                                        startHour = 0;
                                    }

                                    if (elements.find('#endAMPM').val() == 'PM') {
                                        if (endHour != 12) {
                                            endHour += 12;
                                        }
                                    }
                                    else if (endHour == 12) {
                                        endHour = 0;
                                    }

                                    startTime.setHours(startHour);
                                    endTime.setHours(endHour);

                                    startTime.setMinutes(parseInt(elements.find('#startMinute').val()));
                                    endTime.setMinutes(parseInt(elements.find('#endMinute').val()));

                                    var calendarDate = event.start.getDate();

                                    startTime.setDate(calendarDate);
                                    endTime.setDate(calendarDate);

                                    if (endTime <= startTime) {
                                        alert('End time must be after the start time');
                                        return;
                                    }

                                    if (event.start != startTime || event.end != endTime) {
                                        event.start = startTime;
                                        event.end = endTime;

                                        $('#calendar').fullCalendar('updateEvent', event);
                                    }
                                }
                            }
                        });
                    }
                },
                eventMouseout:function (event, jsEvent, view) {

                    /*                    var propStr = "";
                                        for (var prop in jsEvent) {
                                            propStr += prop + ":" + jsEvent[prop] + "<br />\n";
                                            for (var innerProp in jsEvent[prop]) {
                                                propStr += "\t&nbsp;&nbsp;&nbsp;&nbsp;" + innerProp + ":" + jsEvent[prop][innerProp] + "<br />\n";
                                            }
                                        }

                                        var popup = window.open('', 'PopUpWindow', 'width=600,height=600');
                                        popup.document.open();
                                        popup.document.write(propStr);
                                        popup.document.close();

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

                                        $('#calendar').fullCalendar('updateEvent', event);*/
                },
                eventClick:function (event, jsEvent, view) {
                    /*                    var startHour = event.start.getHours();
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
                                        $('#endMinute').val(event.end.getMinutes());*/


                    /*$('#hover').dialog({
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
                    }).dialog("open");*/
                }
            });
})
;

function addSession() {
    settings.currentSession++;

    var eventsDiv = $('#external-events');

    for (var i = 0; i < settings.numLessons; i++) {
        var name = settings.className + ' ' + settings.currentSession;
        var newDiv = $('<div class="external-event">' + name + '</div>');

        eventsDiv.append(newDiv);

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title:name, // use the element's text as the event title
            session:settings.currentSession
        };

        // store the Event Object in the DOM element so we can get to it later
        newDiv.data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        newDiv.draggable({
            zIndex:999,
            revert:true, // will cause the event to go back to its
            revertDuration:0  //  original position after the drag
        });
    }
}
</script>