<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns">
        <!---- progress bar ------>
        <div class="row">
            <div class="twelve columns">
                <ul class="progress">
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->

        <h1>Is this a free or paid class/activity?</h1>

        <div class="row">
            <div class="six columns">
                <a href="#" onclick='submitForm(true); return false;'>
                    <div class="createOption">
                        <span>Free</span>

                        <p>No money required.</p>
                    </div>
                </a>
            </div>
            <div class="six columns">

                <?php if ($user->bankAccount != null): ?>

                <a href="#" onclick='submitForm(false); return false;'>
                    <div class="createOption">
                        <span>Paid</span>

                        <p>I'm charging for my class or activity.</p>
                    </div>
                </a>

                <?php else: ?>

                <a href="#" data-reveal-id="setupPayment">
                    <div class="createOption">
                        <span>Paid</span>

                        <p>I'm charging for my class or activity.</p>
                    </div>
                </a>

                <?php endif;?>

            </div>
        </div>
    </div>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'experience-create-form',
        'enableAjaxValidation' => false,
        'stateful' => true
    ));
    ?>

    <input name="step" type="hidden" value="2" />
    <?php echo $form->hiddenField($model, 'free', array('id' => 'free')); ?>

    <?php $this->endWidget(); ?>

    <!------- end main content container----->
</div>

<!----- Modal ------------->
<div id="setupPayment" class="reveal-modal regular">
    <h2>We've noticed you're not setup to receive payments yet...</h2>

    <div class="row">
        <div class="twelve columns">
            <p>If you'd like to charge for your listing, you'll need to setup your bank account information to receive
                payments first. Please take a few minutes to set it up.</p>

            <?php echo CHtml::link('Click here to set up payments', array('/user/view', 'id' => $user->User_ID, 's' => AccountSections::BankAccount), array('class' => 'button large twelve')); ?>
        </div>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>


<script>
    function submitForm(free)
    {
        $("#free").val(free);
        document.forms['experience-create-form'].submit();
    }
</script>
