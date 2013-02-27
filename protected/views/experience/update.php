<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="three columns sideNav">
        <h2>Edit your listing</h2>
        <ul class="side-nav">
            <li class="active"><a href="#">General Information</a></li>
            <li>
                <?php echo CHtml::link('Pricing &amp; Description', array('/experience/updateDescription', 'id' => $model->Experience_ID)); ?>
            </li>
            <li>
                <?php echo CHtml::link('Scheduling', array('/experience/updateScheduling', 'id' => $model->Experience_ID)); ?>
            </li>
        </ul>
    </div>

    <div class="nine columns">
        <h1>Editing "<?php echo $model->Name; ?>"</h1>

        <?php
        $form = $this->beginWidget('CActiveForm',
            array('id' => 'experience-update-form', 'enableAjaxValidation' => false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),));
        ?>

        <input name="step" type="hidden" value="5" />

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
                <div class="helptip">
                    <span class="has-tip tip-top noradius"
                          data-width="300"
                          title="Tags are any words you'd like to associate with your experience. It'll help people discover it when they search.">?</span>
                </div>
                <label class="right inline">Tags</label>
            </div>
            <div class="eight columns">
                <?php echo $form->textField($model, 'tagString',
                array('placeholder' => 'ex. risky, adrenaline, skydiving, birthday suit, bucket list')); ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="right inline">Upload new images</label>
            </div>
            <div class="eight columns">
                <?php
                $this->widget('xupload.XUpload',
                    array('url' => Yii::app()->createUrl("//experience/uploadImages"), 'model' => $images,
                        //We set this for the widget to be able to target our own form
                        'htmlOptions' => array('id' => 'experience-update-form'), 'attribute' => 'file',
                        'multiple' => true, 'showForm' => false,
                        'options' => array('acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i'),));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="right inline">Existing images</label>
            </div>
            <div class="eight columns" id='images'></div>
        </div>
        <div class="row">
            <div class="four columns">
                <div class="helptip">
                    <span class="has-tip tip-top noradius"
                          data-width="300"
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
                <?php echo $form->dropDownList($model, 'locationState', array_combine(Location::GetStates(), Location::GetStates())); ?>
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
                <div class="checkboxDiv">
                    <?php echo $form->checkBoxList($model, 'AppropriateAges', ExperienceAppropriateAges::$Lookup,
                    array('template' => '{input} {label}', 'separator' => "\n")); ?>
                </div>
            </div>
        </div>
        <!----- End conditional div--------->

        <?php endif; ?>

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
</div>

<script>
    $(document).ready(function ()
    {
        var start = $('#experience-start').val();

        $('#experience-start').Zebra_DatePicker({
            direction:start,
            pair     :$('#experience-end')
        });

        $('#experience-end').Zebra_DatePicker({
            direction:1
        });

        loadImages();
    });

    function loadImages()
    {
        $.ajax({
            type   :'get',
            url    :"<?php echo Yii::app()->createAbsoluteUrl('/experience/getPictures', array('id' => $model->Experience_ID)); ?>",
            success:function (results)
            {
                var imageData = jQuery.parseJSON(results);

                $('#images').empty();

                for (var i in imageData)
                {
                    var html = "<div class='classImage'>\n";
                    html += "    <img src='" + imageData[i].Link + "' />\n"
                    html += "    <button class='button small' onclick='deleteImage(" + imageData[i].Content_ID + "); return false'>Delete</button>\n";
                    html += "</div>\n";

                    $('#images').append(html);
                }
            }
        });
    }

    function deleteImage(imageID)
    {
        $.ajax({
            type   :'post',
            url    :"<?php echo Yii::app()->createAbsoluteUrl('/experience/deletePicture', array('id' => $model->Experience_ID)); ?>",
            data   :{ Content_ID:imageID },
            success:function (results)
            {
                loadImages();
            }
        });
    }
</script>

<style>
    .checkboxDiv label {
        display: inline;
    }

    .classImage {
        padding-bottom: 10px;
    }

    .classImage img, .classImage button {
        display: inline-block;
        vertical-align: top;
    }

    .classImage img {
        width: 140px;
    }
</style>
