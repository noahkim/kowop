<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="four columns offset-by-four">
        <h1>Contact Kowop</h1>

        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'contact-form',
        'action' => array('/site/contact'),
        'enableAjaxValidation' => false, 'method' => 'post',
        'htmlOptions' => array('style' => 'margin: 0;'))); ?>

        <?php echo $form->errorSummary($model); ?>

        <label>What's the nature of this message?</label>

        <?php echo $form->dropDownList($model, 'category', ContactForm::$Categories); ?>

        <label>Subject</label>

        <?php echo $form->textField($model, 'subject'); ?>

        <label>Message</label>

        <?php echo $form->textArea($model, 'message', array('rows' => '10')); ?>

        <input type="submit" class="button" value="Send">

        <?php $this->endWidget('CActiveForm'); ?>
    </div>
    <div class="eight columns">
        <p></p>
    </div>
    <!------- end main content container----->
</div>
