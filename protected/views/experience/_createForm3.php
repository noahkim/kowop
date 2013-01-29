<!--------- main content container------>
<div class="row" id="wrapper">
    <!--------- end left column ------------->
    <div class="eight columns">
        <div class="createContainer">
            <h1>Class Schedule</h1>

            <!---- alert box--->
            <div id="noSessionsAlert" class="alert-box alert" style="display: none;">
                You haven't added any sessions to this class. Please add at least 1 session before<br/> moving on.
                <a href="" class="close">&times;</a>
            </div>
            <!--- end alert box--->

            <p>Add as many sessions as you'd like to make available to potential students.</p>

            <div class="createLesson">
                <h2 class="spacebot20">Session <span id="sessionNum"></span></h2>

                <?php
                for ($i = 1; $i <= $model->numLessons; $i++)
                {
                    echo <<<BLOCK
                <!---one lesson------->
                <h5>Lesson {$i}</h5>

                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Date</label>
                    </div>
                    <div class="three columns end">
                        <input class='datepicker' id="date{$i}" type="text" />
                    </div>
                </div>
                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Start Time</label>
                    </div>
                    <div class="five columns end">
                        <input class='timepicker' id="startTime{$i}" type="text" />
                    </div>
                </div>
                <div class="row">
                    <div class="three columns">
                        <label class="right inline">End Time</label>
                    </div>
                    <div class="five columns end">
                        <input type="text" id="endTime{$i}" readonly="readonly" />
                    </div>
                </div>
                <!----- end lesson---->

BLOCK;
                }
                ?>
            </div>
            <div class="row borderTop">
                <div class="twelve columns">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'class-create-form',
                    'enableAjaxValidation' => false,
                    'stateful' => true,
                    'htmlOptions' => array('style' => 'margin: 0;')
                )); ?>
                    <?php echo $form->hiddenField($model, 'sessions', array('id' => 'sessions')); ?>

                    <div class="twelve columns alignRight">
                        <?php echo CHtml::link('Cancel', array('site/index'), array('class' => 'button large')); ?>
                        <a href="#" onclick='addSession(); return false;' class="button large">Add a session</a>
                        <?php
                        echo CHtml::submitButton('Finalize & Submit', array(
                            'id' => 'submit',
                            'name' => 'step4',
                            'class' => 'button large',
                            'onclick' => 'return validateSessions();'
                        ));
                        ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
            </div>

        </div>
    </div>
    <!-------------- end left column ----------->
    <!-------------- right column -------------->
    <div id="addedSessions" class="four columns">
        <h3>Added Sessions</h3>

        <div id="sessionPrototype" style="display: none;">
            <a href="#" class="tiny secondary button radius">X</a>
            <h5>Session Number</h5>
            <ul>
            </ul>
        </div>
    </div>
    <!---------------end right column---------->
    <!------- end main content container----->
</div>

<script type='text/javascript'>
    var settings = {};
    var sessions = [];

    $(document).ready(function () {
        settings.currentSession = 1;
        settings.numLessons = <?php echo $model->numLessons; ?>;
        settings.lessonDuration = <?php echo $model->lessonDuration; ?>;
        settings.availabilityStart = Date.parse('<?php echo $model->start; ?>');
        settings.availabilityEnd = Date.parse('<?php echo $model->end; ?>');

        var existingSessions = '<?php echo $model->sessions; ?>';
        if (existingSessions.length > 0) {
            sessions = jQuery.parseJSON(existingSessions);
            for (i in sessions) {
                for (j in sessions[i].lessons) {
                    var dateFormat = "yyyy-MM-ddTHH:mm:ss.000Z"; // 2012-12-21T17:15:00.000Z
                    sessions[i].lessons[j].start = Date.parseExact(sessions[i].lessons[j].start, dateFormat);
                    sessions[i].lessons[j].end = Date.parseExact(sessions[i].lessons[j].end, dateFormat);
                }
            }

            settings.currentSession = sessions.length + 1;
        }

        displaySessions();

        $('.datepicker').Zebra_DatePicker({
            direction:[settings.availabilityStart.toString('yyyy-MM-dd'), settings.availabilityEnd.toString('yyyy-MM-dd')]
        });

        $('.timepicker').timepicker({
            step:15
        });

        for (var i = 1; i <= settings.numLessons; i++) {
            $('#startTime' + i).on('changeTime', function () {
                var index = parseInt($(this).attr('id').replace('startTime', ''));
                var start = Date.parse($(this).val());
                var end = start.addHours(settings.lessonDuration);
                var endString = end.toString('h:mmtt').toLowerCase();
                $('#endTime' + index).val(endString);
            });
        }

        $('#submit').click(function (event) {
            $('#sessions').val(JSON.stringify(sessions));
        });
    });

    function addSession() {

        var session = {
            lessons:[]
        };

        for (var i = 1; i <= settings.numLessons; i++) {
            var lesson = {};

            lesson.start = Date.parse($('#date' + i).val() + ' ' + $('#startTime' + i).val());
            lesson.end = Date.parse($('#date' + i).val() + ' ' + $('#endTime' + i).val());

            session.lessons.push(lesson);

            $('#date' + i).val('');
            $('#startTime' + i).val('');
            $('#endTime' + i).val('');
        }

        sessions.push(session);
        settings.currentSession++;
        displaySessions();
    }

    function displaySessions() {
        $('#addedSessions .addedSession').remove();

        for (var i = 1; i < settings.currentSession; i++) {
            var newSession = $('#sessionPrototype').clone();
            newSession.removeAttr('style id');
            newSession.addClass('addedSession');
            newSession.attr('id', 'session' + i);

            newSession.find('h5').text('Session ' + i);
            newSession.find('a').attr('onclick', 'removeSession(' + i + '); return false;');

            for (var j = 0; j < sessions[i - 1].lessons.length; j++) {
                var startTime = sessions[i - 1].lessons[j].start.toString('MMMM d, yyyy');
                newSession.find('ul').append('<li>' + startTime + '</li>');
            }

            newSession.appendTo('#addedSessions');
        }

        $('#sessionNum').text(settings.currentSession);
    }

    function removeSession(session) {
        sessions.splice(session - 1, 1);
        settings.currentSession--;
        displaySessions();
    }

    function validateSessions()
    {
        if(settings.currentSession == 1)
        {
            $('#noSessionsAlert').show();
            return false;
        }

        return true;
    }
</script>