<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>Classes I'm teaching</h1>
    <!---- Stats ------>
    <div class="row">
        <div class="detailStats">
            <div class="row">
                <div class="two columns">
                    <label class="right inline">Custom Range</label>
                </div>
                <div class="three columns">
                    <input id="datepicker-start" type="text">
                </div>
                <div class="three columns">
                    <input id="datepicker-end" type="text">
                </div>
                <div class="two columns">
                    <label class="right inline">Choose class</label>
                </div>
                <div class="two columns">
                    <select id='classFilter'>
                        <option value="active">All active classes</option>
                        <option value="all">All classes ever</option>
                        <option value="past">Past classes</option>
                        <?php
                            foreach($model->kClasses as $class)
                            {
                                echo "<option value='{$class->Class_ID}'>{$class->Name}</option>\n";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <h4>To Date</h4>

            <div class="statBox">
                Students<span id='studentsToDate'></span>
            </div>
            <div class="statBox">
                Net Income<span id='netIncomeToDate'></span>
            </div>
            <div class="statBox">
                Hours Taught<span id='hoursTaught'></span>
            </div>

            <h4>Enrolled</h4>

            <div class="statBox">
                Students<span id='studentsEnrolled'></span>
            </div>
            <div class="statBox">
                Projected Income<span id='projectedIncome'></span>
            </div>
            <div class="statBox">
                Hours to Teach<span id='hoursToTeach'></span>
            </div>

            <h4>Instructor Stats</h4>

            <div class="statBox">
                Avg. per Class<span id='avgPerClass'></span>
            </div>
            <div class="statBox">
                Avg. per Hour<span id='avgPerHour'></span>
            </div>
            <div class="statBox">
                Net Income<span id='netIncomeTeacher'></span>
            </div>
        </div>
    </div>
    <!----- end Stats----->
    <!----- currently teaching --------->
    <?php
    //Start <= now() AND
    $condition = 'End >= now() AND Status = ' . ClassStatus::Active;
    ?>
    <span class="profileCount"><?php echo count($model->kClasses(array('condition' => $condition))); ?></span>

    <h2>Currently teaching</h2>

    <div class="row">
        <?php

        $index = 1;

        $classes = $model->kClasses(array('condition' => $condition));

        foreach ($classes as $class)
        {
            $imgLink = 'http://placehold.it/400x300';

            if (count($class->contents) > 0)
            {
                $imgLink = $class->contents[0]->Link;
            }

            $classLink = CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID));

            $end = '';
            if ($index == count($classes))
            {
                $end = 'end';
            }

            echo <<<BLOCK
                <div class="three columns {$end}">
                    <div class="profileTile">
                        <img src="{$imgLink}">
                        <span class="profileClassTitle">
                            {$classLink}
                        </span>
                    </div>
                </div>
BLOCK;

            $index++;
        }
        ?>
    </div>
    <!------ end currently teaching -------->
    <!------ Past taught classes ------------->
    <?php
    $condition = 'End < now() AND Status = ' . ClassStatus::Active;
    ?>

    <span class="profileCount"><?php echo count($model->kClasses(array('condition' => $condition))); ?></span>

    <h2>Past taught classes</h2>

    <div class="row">
        <?php

        $index = 1;

        $classes = $model->kClasses(array('condition' => $condition));

        foreach ($classes as $class)
        {
            $imgLink = 'http://placehold.it/400x300';

            if (count($class->contents) > 0)
            {
                $imgLink = $class->contents[0]->Link;
            }

            $classLink = CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID));

            $end = '';
            if ($index == count($classes))
            {
                $end = 'end';
            }

            echo <<<BLOCK
                <div class="three columns {$end}">
                    <div class="profileTile">
                        <img src="{$imgLink}">
                        <span class="profileClassTitle">
                            {$classLink}
                        </span>
                    </div>
                </div>
BLOCK;

            $index++;
        }
        ?>
    </div>
    <!------ End Past taught classes ---->
    <!-------- end right column --------->
</div>

<script>
    $(document).ready(function () {

        $('#datepicker-start').Zebra_DatePicker({
            format:'m/d/Y',
            pair:$('#datepicker-end'),
            onSelect: function() {
                populateStats();
            },
            onClear: function() {
                populateStats();
            }
        });

        $('#datepicker-end').Zebra_DatePicker({
            format:'m/d/Y',
            direction:1,
            onSelect: function() {
                populateStats();
            },
            onClear: function() {
                populateStats();
            }
        });

        $('#classFilter').change(function() {
            populateStats();
        });

        populateStats();
    });

    function populateStats()
    {
        var start = $('#datepicker-start').val();
        var end = $('#datepicker-end').val();
        var classFilter = $('#classFilter').val();

        var filter = {
            start: start,
            end: end,
            classFilter: classFilter
        };

        var data = 'filter=' + JSON.stringify(filter);

        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl("user/classReport"); ?>',
            data: data,
            dataType: 'json',
            success: function(data) {
                $('#studentsToDate').text(data.studentsToDate);
                $('#netIncomeToDate').text('$' + data.netIncomeToDate);
                $('#hoursTaught').text(data.hoursTaught);

                $('#studentsEnrolled').text(data.studentsEnrolled);
                $('#projectedIncome').text('$' + data.projectedIncome);
                $('#hoursToTeach').text(data.hoursToTeach);

                $('#avgPerClass').text('$' + data.avgPerClass);
                $('#avgPerHour').text('$' + data.avgPerHour);
                $('#netIncomeTeacher').text('$' + data.netIncomeTeacher);
            }
        })
    }
</script>