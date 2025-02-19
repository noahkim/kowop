<!--------- main content container------>
<div class="row" id="wrapper">
    <!--------- end left column ------------->
    <div class="eight columns">

        <?php
        $navForm = $this->beginWidget('CActiveForm',
                                      array('id' => 'experience-create-form-nav', 'enableAjaxValidation' => false,
                                            'stateful' => true, 'htmlOptions' => array('style' => 'margin: 0;'),));
        ?>
        <input id="step" name="step" type="hidden" />
        <?php $this->endWidget(); ?>

        <script>
            function navigateTo(page)
            {
                $('#step').val(page);
                document.forms['experience-create-form-nav'].submit();
            }
        </script>

        <!---- progress bar ------>
        <div class="row">
            <div class="twelve columns">
                <ul class="progress">
                    <li class="done"><a href="#" onclick='navigateTo(1); return false;'>1</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(2); return false;'>2</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(3); return false;'>3</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(4); return false;'>4</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(5); return false;'>5</a></li>
                    <li class="active">6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->

        <h1>Setup your availability</h1>

        <p>
            <a href="#" class="button" onclick="submitForm(false); return false;">Skip this step</a>
        </p>

        <p>While this step is optional, providing it gives you some benefits (look to the right). Add any time and day
           you'd like to make available. Don't worry about getting them all in now. You can always come back and add
           more. Make it as specific (like 10am-11am) or as general (8am-8pm) as you'd like.</p>

        <?php
        $form = $this->beginWidget('CActiveForm',
                                   array('id' => 'experience-create-form', 'enableAjaxValidation' => false,
                                         'stateful' => true,
                                         'htmlOptions' => array('enctype' => 'multipart/form-data'),));
        ?>

        <input type='hidden' name='step' value='7' />
        <?php echo $form->hiddenField($model, 'sessions', array('id' => 'sessions')); ?>

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

        <div class="row borderTop">
            <div class="six columns offset-by-six">
                <a href="#" class="button" onclick="submitForm(false); return false;">Skip this step</a>
                <a href="#" class="button" onclick="submitForm(true); return false;">Finalize and post!</a>
            </div>
        </div>
    </div>
    <!-------------- end left column -----------><!-------------- right column -------------->
    <div class="four columns">
        <h3>What are the advantages?</h3>
  	    <span class="circleList">
            People can sign up for a specific day and time in 1 click. No calling in after signing up to make an appointment.
        </span>
        <span class="circleList">
            People can search for classes and activities that take place on specific days. You'll rank higher if you provide an availability.
        </span>
        <span class="circleList">
            We regularly feature classes &amp; activities on the homepage. If you create a schedule, you're more likely to be featured on our homepage.
        </span>
        <span class="circleList">
            You can manage your sign ups all on Kowop. See who is coming on what day and time.
        </span>

        <h3>Put-stuff-in-fast Tips</h3>
        <ul>
            <li>Click and drag timeslots to quickly create them</li>
            <li>Drag between days</li>
            <li>Adjust length by dragging the bottom side up and down</li>
            <li>Click and drag in the "all day" row up top for multiple days</li>
            <li>Zoom out to "month" view</li>
        </ul>

    </div>
    <!---------------end right column----------><!------- end main content container----->
</div>

<script>
    var lastID = 0;

    $(document).ready(function ()
    {
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
                            id    :'session' + (lastID++)
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
            }
        });
    });

    function submitForm(addSessions)
    {
        if (addSessions)
        {
            var clientEvents = $('#calendar').fullCalendar('clientEvents');
            var sessions = [];

            for (var i in clientEvents)
            {
                var start = clientEvents[i].start.toString('yyyy-MM-dd HH:mm:ss');
                var end = clientEvents[i].end.toString('yyyy-MM-dd HH:mm:ss');

                var session = {
                    Start:start,
                    End  :end
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
            document.forms['experience-create-form'].submit();
        }
        else
        {
            $('#minOccupancy').val('');
            $('#maxOccupancy').val('');
            $('#sessions').val('');
            document.forms['experience-create-form'].submit();
        }
    }
</script>
