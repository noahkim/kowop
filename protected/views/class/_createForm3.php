<!--------- main content container------>
<div class="row" id="wrapper">
    <!--------- end left column ------------->
    <div class="eight columns">
        <div class="createContainer">
            <h1>Class Schedule</h1>

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
                        <input class='datepicker' id="date{$i}" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Start Time</label>
                    </div>
                    <div class="five columns end">
                        <input class='timepicker' id="startTime{$i}" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="three columns">
                        <label class="right inline">End Time</label>
                    </div>
                    <div class="five columns end">
                        <input type="text" id="endTime{$i}" readonly>
                    </div>
                </div>
                <!----- end lesson---->

BLOCK;
                }
                ?>
            </div>
            <div class="row borderTop">
                <div class="twelve columns alignRight">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'class-create-form',
                    'enableAjaxValidation' => false,
                    'stateful' => true,
                    'htmlOptions' => array('style' => 'margin: 0;')
                )); ?>
                    <?php echo $form->hiddenField($model, 'sessions', array('id' => 'sessions')); ?>

                    <div class="twelve columns alignRight">
                        <a href="#" onclick='addSession(); return false;' class="button radius">Add a session</a>
                        <?php echo CHtml::submitButton('Finalize & Submit', array('id' => 'submit', 'name' => 'step4', 'class' => 'button radius')); ?>
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

        <div class="addedSession">
            <a href="#" class="tiny secondary button radius">X</a>
            <h5>Session 1</h5>
            <ul>
                <li>December 5, 2012</li>
                <li>December 6, 2012</li>
                <li>December 7, 2012</li>
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

        $('#sessionNum').text(settings.currentSession);

        $('.datepicker').Zebra_DatePicker({
            direction:1
        });

        $('.timepicker').timepicker();

        for (var i = 1; i <= settings.numLessons; i++) {
            $('#startTime' + i).change(function () {
                alert(i + ':' + $(this).val());
                var start = Date.parse($('#startTime' + i).val());
                if (start != null) {
                    var end = start.addHours(settings.lessonDuration);
                    $('#endTime' + i).val(end.toString('h:mmtt').toLowerCase());
                }
            });
        }

        $('#submit').click(function () {
            $('#sessions').val(JSON.stringify(data));
            alert($('#sessions').val());
            return false;
        });
    });

    function addSession() {

        var session = {
            lessons:[]
        };

        for (var i = 1; i <= settings.numLessons; i++) {
            var lesson = {};

            lesson.start = Date.parse($('#date' + i).val() + ' ' + $('#startTime' + i).val());
            lesson.end = lesson.start.add({
                hours:settings.lessonDuration
            });

            session.lessons.push(lesson);

            $('#date' + i).val('');
            $('#startTime' + i).val('');
            $('#endTime' + i).val('');
        }

        sessions[settings.currentSession] = session;

        settings.currentSession++;
    }

    function displaySessions() {
        $('.addedSessions .addedSession').remove();
    }
</script>