<!----------------- Modal--------------------->
<h2>Reply to <?php echo $model->First_name; ?></h2>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'send-message-form',
    'action' => Yii::app()->createUrl('/user/sendMessage', array('id' => $model->User_ID)),
    'enableAjaxValidation' => false
)); ?>

<textarea name="message" rows="10"></textarea>
<input type='hidden' name='replyTo' value='<?php echo $replyTo; ?>' />
<input type="submit" value="send" class="button secondary radius">

<?php $this->endWidget('CActiveForm'); ?>

<a class="close-reveal-modal">&#215;</a>
