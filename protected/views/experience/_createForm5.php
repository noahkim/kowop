<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="nine columns">

        <?php
        $navForm = $this->beginWidget('CActiveForm',
                                      array('id' => 'experience-create-form-nav', 'enableAjaxValidation' => false,
                                            'stateful' => true, 'htmlOptions' => array('style' => 'margin: 0;'),));
        ?>
        <input id="step" name="step" type="hidden"/>
        <?php $this->endWidget(); ?>

        <script>
            function navigateTo(page) {
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
                    <li class="active">5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->

        <h1>Pricing &amp; Description</h1>

        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'experience-create-form', 'enableAjaxValidation' => false,
                                                        'stateful' => true,));
        ?>

        <input type="hidden" name="step" value="6" />

        <div class="row">
            <div class="four columns">
                <label class="right inline">Price - $</label>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, 'Price', array('maxlength' => '4', 'placeholder' => '39')); ?>
            </div>
            <div class="three columns end">
                <?php echo $form->checkBox($model, 'free', array('value' => 'yes')); ?>
                I'm offering this for free
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="right inline">What do you get for this price?</label>
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
                <p>Provide a detailed description of what your experience is all about, as well as any instructions
                    or information people should know.</p>

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

                <?php echo $form->textArea($model, 'Description', array('rows' => '20', 'id' => 'description')); ?>

                <label>Provide any conditions, or fine print</label>

                <?php echo $form->textArea($model, 'FinePrint', array('rows' => '10')); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>

        <div class="row">
            <div class="four columns offset-by-eight">
                <a href="#" class="button twelve" onclick="document.forms['experience-create-form'].submit(); return false;">Scheduling</a>
            </div>
        </div>
    </div>
    <!------- end main content container----->
</div>

<script>
    $(document).ready(function () {
        var editor = new wysihtml5.Editor("description", {
            toolbar:"toolbar",
            stylesheets:"/ui/sitev2/stylesheets/wysiwyg.css",
            parserRules:wysihtml5ParserRules
        });
    });
</script>
