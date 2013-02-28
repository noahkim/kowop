<div class="loginsplash">

    <!---------------------------------------
                 Header
    ---------------------------------------->

    <?php echo $this->renderPartial('/site/_headernav'); ?>


    <!--------- main content container------>
    <div class="row" id="wrapper">
        <div class="six columns offset-by-three">
            <div class="login">
                <span class="homeBlurbcopy">Create an account using Facebook...</span>
                <a href="<?php echo Yii::app()->params['siteBase']; ?>/hybridauth/default/login/?provider=facebook">
                    <img src="<?php echo Yii::app()->params['siteBase']; ?>/images/facebook.jpg"> </a>

                <span class="homeBlurbcopy">...or create an account using your e-mail...</span>

                <?php $form = $this->beginWidget(
                'CActiveForm', array(
                'id' => 'user-create-form',
                'enableAjaxValidation' => false,
            )); ?>

                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Display Name</label>
                    </div>
                    <div class="nine columns">
                        <?php echo $form->textField($model, 'DisplayName', array('class' => 'twelve')); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Email</label>
                    </div>
                    <div class="nine columns">
                        <?php echo $form->textField($model, 'Email', array('class' => 'twelve', 'id' => 'email')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Verify email</label>
                    </div>
                    <div class="nine columns">
                        <input type="text" class="twelve" id='verifyEmail' />
                    </div>
                </div>
                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Password</label>
                    </div>
                    <div class="nine columns">
                        <?php echo $form->passwordField($model, 'Password', array('class' => 'twelve', 'id' => 'password')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="three columns">
                        <label class="right inline">Verify password</label>
                    </div>
                    <div class="nine columns">
                        <input type="password" class="twelve" id='verifyPassword' />
                    </div>
                </div>
                <div class="row">
                    <div class="four columns offset-by-three">
                        <a href="#" class="button twelve" onclick='submitForm(); return false;'>Create account</a>
                    </div>
                </div>

                <?php $this->endWidget('CActiveForm'); ?>
            </div>
        </div>
        <!------- end main content container----->
    </div>
</div>

<script>
    function submitForm()
    {
        $('input').removeClass('error');
        var hasError = false;

        if ($('#email').val().length == 0)
        {
            $('#email').addClass('error');
            hasError = true;
        }

        if ($('#password').val().length == 0)
        {
            $('#password').addClass('error');
            hasError = true;
        }

        if ($('#email').val() != $('#verifyEmail').val())
        {
            $('#verifyEmail').addClass('error');
            hasError = true;
        }

        if ($('#password').val() != $('#verifyPassword').val())
        {
            $('#verifyPassword').addClass('error');
            hasError = true;
        }

        if (!hasError)
        {
            document.forms['user-create-form'].submit();
        }
    }
</script>