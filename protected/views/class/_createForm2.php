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
                    <label class="right inline">Image</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textField($model, 'imageURL', array('placeholder' => 'image URL')); ?>
                    or upload
                    <?php echo $form->fileField($model, 'imageFile'); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Merit Badge</label>
                </div>
                <div class="nine columns">
                    <input name='badge' type="text" placeholder="upload"/>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Availability</label>
                </div>
                <div class="two columns">
                    <?php echo $form->textField($model, 'start', array('placeholder' => 'from')); ?>
                </div>
                <div class="two columns end">
                    <?php echo $form->textField($model, 'end', array('placeholder' => 'to')); ?>
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
                    <label class="right inline">How many sessions in a class?</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textField($model, 'numSessions', array('placeholder' => 'ex. 3', 'class' => 'three')); ?>
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
                    per hour
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Location</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->dropDownList($model, 'locationType', LocationType::$Lookup, array('class' => 'five')); ?>
                    <!--<select class="five">
                        <option>Public</option>
                        <option>Private</option>
                        <option>Online (Google+ Hangout)</option>
                    </select>-->
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
                    <?php echo $form->textArea($model, 'description', array('rows' => 15, 'maxlength' => 2000)); ?>
                </div>
            </div>

            <div class="row borderTop">
                <div class="twelve columns alignRight">
                    <?php echo CHtml::submitButton('Save & Continue', array('name' => 'step3', 'class' => 'button radius')); ?>
                    <!--<a href="create_class3.html" class="button radius">Save &amp; Continue</a>-->
                </div>
            </div>
            <?php $this->endWidget(); ?>
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

<!--<div class="form">


    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php /*echo $form->errorSummary($model); */?>

    <div class="row">
        <?php /*echo $form->labelEx($model, 'prerequisites'); */?>
        <?php /*echo $form->textField($model, 'prerequisites'); */?>
        <?php /*echo $form->error($model, 'prerequisites'); */?>
    </div>

    <div class="row">
        <?php /*echo $form->labelEx($model, 'materials'); */?>
        <?php /*echo $form->textField($model, 'materials'); */?>
        <?php /*echo $form->error($model, 'materials'); */?>
    </div>

    <div class="row">
        Class Image URL:
        <input name='imageURL' type='text'/>
    </div>

    <div class="row">
        <?php /*echo $form->labelEx($model, 'tuition'); */?>
        <?php /*echo $form->textField($model, 'tuition'); */?>
        <?php /*echo $form->error($model, 'tuition'); */?>
    </div>


    <div class="row">
        <?php /*echo $form->labelEx($model, 'numSessions'); */?>
        <?php /*echo $form->textField($model, 'numSessions'); */?>
        <?php /*echo $form->error($model, 'numSessions'); */?>
    </div>


</div><!-- form -->
-->
