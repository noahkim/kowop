<div class="loginsplash">

    <!---------------------------------------
                 Header
    ---------------------------------------->

    <?php echo $this->renderPartial('/site/_headernav'); ?>

    <!--------- main content container------>
    <div class="row" id="wrapper">
        <div class="six columns offset-by-three">
            <div class="login">
                <span class="homeBlurbcopy">Log in using your Facebook account</span>
                <a href="<?php echo Yii::app()->params['siteBase']; ?>/hybridauth/default/login/?provider=facebook">
                    <img src="/ui/sitev2/images/facebook.jpg"> </a>

                <span class="homeBlurbcopy">Log in with your Kowop account</span>

                <?php $form = $this->beginWidget(
                'CActiveForm', array(
                'id' => 'login-form',
                'enableAjaxValidation' => false,
            )); ?>

                <form>
                    <div class="row">
                        <div class="two columns">
                            <label class="right inline">Email</label>
                        </div>
                        <div class="ten columns">
                            <?php echo $form->textField($model, 'username', array('class' => 'twelve')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="two columns">
                            <label class="right inline">Password</label>
                        </div>
                        <div class="ten columns">
                            <?php echo $form->passwordField($model, 'password', array('class' => 'twelve')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="four columns offset-by-two">
                            <a href="#"
                               class="button twelve"
                               onclick="document.forms['login-form'].submit(); return false;">Sign in</a>
                        </div>
                    </div>

                </form>
                <?php $this->endWidget('CActiveForm'); ?>

                <p>
                    Don't have an acount yet?
                    <?php echo CHtml::link('Sign up', array('/user/create')); ?>
                </p>
            </div>
        </div>
        <!------- end main content container----->
    </div>
</div>

