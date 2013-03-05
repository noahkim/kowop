<!---------- right column--------------->
<div class="nine columns accountInformation">
    <h1><?php echo $model->fullname; ?></h1>

    <p>Member since <?php echo date('F Y', strtotime($model->Created)); ?></p>

    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Profile image</div>
        <div class="nine columns">
            <?php echo "<img src='{$model->profilePic}'>\n"; ?>

            <?php $form = $this->beginWidget('CActiveForm',
            array(
                'id' => 'profile-update-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('enctype' => 'multipart/form-data', 'style' => 'margin: 0;'),
                'action' => array('/user/submitProfileChange'),
            ));
            ?>

            <input type='file' id='profilePic' name='profilePic' /> <br />

            <input type='submit' value='Upload' name='submit' />

            <input type='hidden' name='profilePicUpload' value='1' />

            <?php $this->endWidget('CActiveForm'); ?>
        </div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">About yourself</div>
        <div class="nine columns edit_description" id='Description'>
            <?php echo $model->Description; ?>
        </div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Display Name</div>
        <div class="nine columns edit_DisplayName" id='DisplayName'>
            <?php echo $model->DisplayName; ?>
        </div>
    </div>
</div>


</div>
<!---------- end right column ----------->

<script>
    $(document).ready(function ()
    {

        $('.edit_DisplayName').editable('<?php echo $this->createAbsoluteUrl('/user/submitProfileChange'); ?>', {
            select :true,
            submit :'OK',
            cancel :'cancel',
            tooltip:'Click to edit...'

        });

        $('.edit_description').editable('<?php echo $this->createAbsoluteUrl('/user/submitProfileChange'); ?>', {
            type     :'textarea',
            cancel   :'Cancel',
            rows     :20,
            submit   :'OK',
            indicator:'<img src="<?php echo Yii::app()->params['siteBase']; ?>/images/loading.gif">',
            tooltip  :'Click to edit...'
        });
    });
</script>