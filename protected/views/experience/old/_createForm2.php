<!--------- main content container------>
<div class="row" id="wrapper">
<!--------- end left column ------------->
<div class="nine columns">
    <div class="createContainer">
        <h1>Class Details</h1>
        <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'class-create-form',
        'enableAjaxValidation' => false,
        'stateful' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
        <div class="row">
            <div class="three columns">
                <label class="right inline">Image(s)</label>
            </div>
            <div class="nine columns">
                <?php
                $this->widget('xupload.XUpload', array(
                        'url' => Yii::app()->createUrl("//experience/uploadImages"),
                        'model' => $images,
                        //We set this for the widget to be able to target our own form
                        'htmlOptions' => array('id' => 'class-create-form'),
                        'attribute' => 'file',
                        'multiple' => true,
                        /*'formView' => 'application.views.somemodel._form',*/
                        'showForm' => false,
                        'options' => array(
                            'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i'
                        ),
                    )
                );
                ?>
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <label class="right inline">Availability</label>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, 'start', array('id' => 'startDate', 'placeholder' => 'from')); ?>
            </div>
            <div class="two columns end">
                <?php echo $form->textField($model, 'end', array('id' => 'endDate', 'placeholder' => 'to')); ?>
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <label class="right inline">Seats</label>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, 'minOccupancy', array('placeholder' => 'minimum')); ?>
            </div>
            <div class="two columns end">
                <?php echo $form->textField($model, 'maxOccupancy', array('placeholder' => 'maximum')); ?>
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <label class="right inline">How many lessons make up one session?</label>
            </div>
            <div class="nine columns">
                <?php echo $form->textField($model, 'numLessons', array('placeholder' => 'ex. 3', 'class' => 'three')); ?>
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <label class="right inline">What's the length of one lesson?</label>
            </div>
            <div class="two columns">
                <select id="hourPicker">
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                </select>
            </div>
            <div class="one column end">
                <label class="left inline">hours</label>
            </div>
            <div class="two columns">
                <select id="minutePicker">
                    <option>0</option>
                    <option>30</option>
                </select>
            </div>
            <div class="one column end">
                <label class="left inline">minutes</label>
            </div>
        </div>

        <div class="row">
            <div class="three columns">
                <label class="right inline">Tuition</label>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, 'tuition', array('placeholder' => 'ex. 25.00')); ?>
            </div>
            <div class="one column end">
                per lesson
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <label class="right inline">Location</label>
            </div>
            <div class="nine columns">
                <?php echo $form->dropDownList($model, 'locationType', LocationType::$Lookup, array('class' => 'five')); ?>
            </div>
        </div>
        <div class="row">
            <div class="nine columns offset-by-three">
                <?php echo $form->textField($model, 'locationStreet', array('size' => 60, 'maxlength' => 2000, 'placeholder' => 'Street')); ?>
            </div>
        </div>
        <div class="row">
            <div class="three columns offset-by-three">
                <?php echo $form->textField($model, 'locationCity', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'City')); ?>
            </div>
            <div class="three columns">
                <?php echo $form->textField($model, 'locationState', array('size' => 60, 'maxlength' => 2, 'placeholder' => 'State')); ?>
            </div>
            <div class="three columns">
                <?php echo $form->textField($model, 'locationZip', array('size' => 60, 'maxlength' => 5, 'placeholder' => 'ZIP')); ?>
            </div>
        </div>
        <div class="row">
            <div class="nine offset-by-three">
                <h5>Description</h5>

                <p class="createDescription">Provide a detailed description of what you'll be teaching, and what
                    students can expect from this class. Remember to include any prerequisites, such as things
                    students should already know before taking your class or class materials they need to bring that
                    you won't be providing.</p>

                <div id="toolbar" style="display: none;">
                    <a data-wysihtml5-command="bold" title="CTRL+B">bold</a> |
                    <a data-wysihtml5-command="italic" title="CTRL+I">italic</a> |
                    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">Heading</a> |
                    <a data-wysihtml5-command="insertUnorderedList">List</a> |
                    <a data-wysihtml5-command="insertOrderedList">Ordered List</a> |
                    <a data-wysihtml5-command="insertSpeech">Speech Input</a>

                    <div data-wysihtml5-dialog="createLink" style="display: none;">
                        <label>
                            Link:
                            <input data-wysihtml5-dialog-field="href" value="http://">
                        </label>
                        <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                    </div>

                    <div data-wysihtml5-dialog="insertImage" style="display: none;">
                        <label>
                            Image:
                            <input data-wysihtml5-dialog-field="src" value="http://">
                        </label>
                        <label>
                            Align:
                            <select data-wysihtml5-dialog-field="className">
                                <option value="">default</option>
                                <option value="wysiwyg-float-left">left</option>
                                <option value="wysiwyg-float-right">right</option>
                            </select>
                        </label>
                        <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                    </div>

                </div>

                <?php echo $form->textArea($model, 'description', array('id' => 'description', 'maxlength' => 2000, 'rows' => 20)); ?>
            </div>
        </div>

        <div class="row borderTop">
            <div class="four columns offset-by-eight">
                <?php echo CHtml::submitButton('Save & Continue', array('name' => 'step3', 'class' => 'button large twelve')); ?>
            </div>
        </div>
        <?php echo $form->hiddenField($model, 'lessonDuration', array('id' => 'lessonDuration')); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>
<!-------------- end left column ----------->
<!-------------- right column -------------->
<div class="three columns">
    <h3>Tips</h3>
    <ul>
        <li>All classes need at least 2 people to start, but you can set this limit higher</li>
        <li>If you enter in your address and choose "Private", it will only be provided to enrollees 2 days before
            the class after they've been "locked" in
        </li>
    </ul>
</div>
<!---------------end right column---------->
<!------- end main content container----->
</div>

<script>
    $(document).ready(function () {

        var existingDuration = parseFloat('<?php echo $model->lessonDuration; ?>') || 0;

        $('#startDate').Zebra_DatePicker({
            direction:1,
            format:'m/d/Y',
            pair:$('#endDate')
        });

        $('#endDate').Zebra_DatePicker({
            format:'m/d/Y',
            direction:1
        });

        $('#hourPicker, #minutePicker').change(function () {
            var duration = Number($('#hourPicker').val());
            if (Number($('#minutePicker').val()) != 0) {
                duration += 0.5;
            }

            $('#lessonDuration').val(duration);
        });

        if (existingDuration > 0) {
            var hours = Math.floor(existingDuration);
            var minutes = existingDuration - hours;

            $('#hourPicker').val(hours);
            $('#minutePicker').val(minutes);
        }

        var editor = new wysihtml5.Editor("description", {
            toolbar:"toolbar",
            stylesheets:"/ui/sitev2/stylesheets/wysiwyg.css",
            parserRules:wysihtml5ParserRules
        });
    });
</script>