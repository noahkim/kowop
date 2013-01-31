<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="nine columns">

        <?php
        $navForm = $this->beginWidget('CActiveForm',
                                      array('id' => 'class-create-form-nav', 'enableAjaxValidation' => false,
                                            'stateful' => true, 'htmlOptions' => array('style' => 'margin: 0;'),));
        ?>
        <input id="step" name="step" type="hidden"/>
        <?php $this->endWidget(); ?>

        <script>
            function navigateTo(page) {
                $('#step').val(page);
                document.forms['class-create-form-nav'].submit();
            }
        </script>

        <!---- progress bar ------>
        <div class="row">
            <div class="twelve columns">
                <ul class="progress">
                    <li class="done"><a href="#" onclick='navigateTo(1); return false;'>1</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(2); return false;'>2</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(3); return false;'>3</a></li>
                    <li class="active">4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->

        <h1>Let's start with the basics...</h1>

        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'class-create-form', 'enableAjaxValidation' => false,
                                                        'stateful' => true,
                                                        'htmlOptions' => array('enctype' => 'multipart/form-data'),));
        ?>

        <input name="step" type="hidden" value="5"/>

        <div class="row">
            <div class="four columns">
                <label class="right inline">Name your experience</label>
            </div>
            <div class="eight columns">
                <?php echo $form->textField($model, 'Name'); ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="right inline">Category</label>
            </div>
            <div class="eight columns">
                <?php echo $form->dropDownList($model, 'Category_ID', Category::GetCategories(),
                                               array('class' => 'five')); ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <div class="helptip"><span class="has-tip tip-top noradius" data-width="300"
                                           title="Tags are any words you'd like to associate with your experience. It'll help people discover it when they search.">?</span>
                </div>
                <label class="right inline">Tags</label>
            </div>
            <div class="eight columns">
                <?php echo $form->textField($model, 'tags',
                                            array('placeholder' => 'ex. risky, adrenaline, skydiving, birthday suit, bucket list')); ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="right inline">Image</label>
            </div>
            <div class="eight columns">
                <?php
                $this->widget('xupload.XUpload',
                              array('url' => Yii::app()->createUrl("//experience/uploadImages"), 'model' => $images,
                                    //We set this for the widget to be able to target our own form
                                    'htmlOptions' => array('id' => 'class-create-form'), 'attribute' => 'file',
                                    'multiple' => true, 'showForm' => false,
                                    'options' => array('acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i'),));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <div class="helptip"><span class="has-tip tip-top noradius" data-width="300"
                                           title="These are the dates your class or activity will remain available on Kowop. It can be as short or as long as you'd like.">?</span>
                </div>
                <label class="right inline">Availability</label>
            </div>
            <div class="three columns">
                <?php echo $form->textField($model, 'Start', array('id' => 'experience-start')); ?>
            </div>
            <div class="three columns end">
                <?php echo $form->textField($model, 'End', array('id' => 'experience-end')); ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="right inline">Location</label>
            </div>
            <div class="eight columns">
                <?php echo $form->textField($model, 'locationStreet', array('maxlength' => 2000,
                                                                            'placeholder' => 'Street ex. 444 Charles Ave')); ?>
            </div>
        </div>
        <div class="row">
            <div class="three columns offset-by-four">
                <?php echo $form->textField($model, 'locationCity',
                                            array('maxlength' => 255, 'placeholder' => 'City')); ?>
            </div>
            <div class="three columns">
                <?php echo $form->dropDownList($model, 'locationState', Location::GetStates()); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, 'locationZip', array('maxlength' => 5)); ?>
            </div>
        </div>

        <?php if (isset($model->Audience) && ($model->Audience == ExperienceAudience::Kids)) : ?>

        <!----- Only show this if they previously selected that this is a kids experience------>
        <div class="row">
            <div class="four columns">
                <label class="right inline">Age appropriateness</label>
            </div>
            <div class="eight columns">
                <?php echo $form->checkBoxList($model, 'AppropriateAges', ExperienceAppropriateAges::$Lookup); ?>
            </div>
        </div>
        <!----- End conditional div--------->

        <?php endif; ?>

        <?php $this->endWidget(); ?>

        <div class="row">
            <div class="four columns offset-by-eight">
                <a href="#" class="button twelve" onclick="document.forms['class-create-form'].submit(); return false;">
                    Pricing &amp; Description
                </a>
            </div>
        </div>
    </div>
    <!------- end main content container----->
</div>

<script>
    $(document).ready(function () {
        $('#experience-start').Zebra_DatePicker({
            direction:true,
            pair:$('#experience-end')
        });

        $('#experience-end').Zebra_DatePicker({
            direction:1
        });
    });
</script>
