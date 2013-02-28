<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="three columns sideNav">
        <h2>Edit your listing</h2>
        <ul class="side-nav">
            <li>
                <?php echo CHtml::link('General Information', array('/experience/update', 'id' => $model->Experience_ID)); ?>
            </li>
            <li class="active"><a href="#">Pricing &amp; Description</a></li>
            <li>
                <?php echo CHtml::link('Scheduling', array('/experience/updateScheduling', 'id' => $model->Experience_ID)); ?>
            </li>
        </ul>
    </div>
    <div class="nine columns">
        <h1>Editing "<?php echo $model->Name; ?>"</h1>

        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'experience-update-form', 'enableAjaxValidation' => false));
        ?>

        <input type="hidden" name="step" value="6" />

        <?php if ($model->Price != null) : ?>

        <div class="row">
            <div class="four columns">
                <label class="right inline">Price - $</label>
            </div>
            <div class="two columns end">
                <?php echo $form->textField($model, 'Price',
                array('maxlength' => '4', 'placeholder' => '39', 'id' => 'price')); ?>
            </div>
        </div>

        <?php if ($model->ExperienceType != ExperienceType::Class_): ?>

            <div class="row">
                <div class="four columns">
                    <label class="inline right">How many can 1 person buy?</label>
                </div>
                <div class="two columns end">
                    <?php echo $form->textField($model, 'MaxPerPerson', array('maxlength' => '3')); ?>
                </div>
            </div>

            <div class="row">
                <div class="four columns">
                    <label class="inline right">Can they buy more then once?</label>
                </div>
                <div class="eight columns">
                    <?php echo $form->hiddenField($model, 'MultipleAllowed', array('id' => 'multipleAllowed')); ?>
                    <input type="checkbox" id='multipleAllowed1' class='multipleAllowedCheckboxes' value="1">Yes <input
                        type="checkbox"
                        id='multipleAllowed0'
                        class='multipleAllowedCheckboxes'
                        value="0">No
                </div>
            </div>

            <?php endif; ?>

        <?php endif; ?>

        <div class="row">
            <div class="four columns">
                <label class="right inline">What do you get?</label>
            </div>
            <div class="eight columns">
                <?php echo $form->textArea($model, 'Offering', array('rows' => '10')); ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="right inline">Description</label>
            </div>
            <div class="eight columns">
                <p>Provide a detailed description of what your experience is all about, as well as any instructions or
                    information people should know.</p>

                <div id="toolbar" style="display: none;">
                    <a data-wysihtml5-command="bold" title="CTRL+B">bold</a> | <a data-wysihtml5-command="italic"
                                                                                  title="CTRL+I">italic</a> | <a
                        data-wysihtml5-command="formatBlock"
                        data-wysihtml5-command-value="h2">Heading</a> | <a data-wysihtml5-command="insertUnorderedList">List</a>
                    | <a data-wysihtml5-command="insertOrderedList">Ordered List</a> |
                    <a data-wysihtml5-command="insertSpeech">Speech Input</a>

                    <div data-wysihtml5-dialog="createLink" style="display: none;">
                        <label> Link: <input data-wysihtml5-dialog-field="href" value="http://"> </label> <a
                            data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                    </div>

                    <div data-wysihtml5-dialog="insertImage" style="display: none;">
                        <label> Image: <input data-wysihtml5-dialog-field="src" value="http://"> </label> <label> Align:
                        <select data-wysihtml5-dialog-field="className">
                            <option value="">default</option>
                            <option value="wysiwyg-float-left">left</option>
                            <option value="wysiwyg-float-right">right</option>
                        </select> </label> <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a
                            data-wysihtml5-dialog-action="cancel">Cancel</a>
                    </div>

                </div>

                <?php echo $form->textArea($model, 'Description', array('rows' => '20', 'id' => 'description')); ?>

                <label>Provide any conditions, or fine print</label>

                <?php echo $form->textArea($model, 'FinePrint', array('rows' => '10')); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>

        <div class="row">
            <div class="four columns offset-by-four">
                <?php echo CHtml::link('Cancel', array('/experience/view', 'id' => $model->Experience_ID), array('class' => 'button twelve')); ?>
            </div>
            <div class="four columns">
                <a href="#"
                   class="button twelve"
                   onclick="document.forms['experience-update-form'].submit(); return false;">Save</a>
            </div>
        </div>
    </div>
    <!------- end main content container----->
</div>

<script>
    $(document).ready(function ()
    {
        var editor = new wysihtml5.Editor("description", {
            toolbar    :"toolbar",
            stylesheets:"<?php echo Yii::app()->params['siteBase']; ?>/css/wysiwyg.css",
            parserRules:wysihtml5ParserRules
        });

        var $unique = $('input.multipleAllowedCheckboxes');
        $unique.click(function ()
        {
            $unique.removeAttr('checked');
            $(this).attr('checked', true);
            $('#multipleAllowed').val($(this).val());
        });

        $unique.removeAttr('checked');

        var multipleAllowed = $('#multipleAllowed').val();
        if ((multipleAllowed == null) || (multipleAllowed.length == 0))
        {
            multipleAllowed = 0;
            $('#multipleAllowed').val(multipleAllowed);
        }

        $('#multipleAllowed' + multipleAllowed).attr('checked', true);
    });
</script>
