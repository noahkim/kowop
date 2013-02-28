<!---------------------------------------
                 Header
---------------------------------------->
<?php if (Yii::app()->user->isGuest) : ?>

<!----- Homepage logo and header nav ---------->
<div class="header spacebot20">
    <div class="row">
        <div class="three columns">
            <div class="logo">
                <?php echo CHtml::link('<img src="' . Yii::app()->params['siteBase'] . '/images/logo_small.png">', Yii::app()->homeUrl); ?>
                activities &amp; classes for<br /> kids &amp; families
            </div>
        </div>

        <?php if (isset($search) && $search) : ?>

        <div class="six columns">
            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form',
            'action' => Yii::app()->createUrl('/experience/search'),
            'enableAjaxValidation' => false, 'method' => 'get',
            'htmlOptions' => array('style' => 'margin: 0;'))); ?>

            <?php $model = new ExperienceSearchForm; ?>

            <div class="row">
                <div class="seven columns">
                    <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords,
                    'placeholder' => 'What are you looking for?', 'class' => 'twelve')); ?>
                </div>
                <div class="three columns">
                    <?php echo $form->textField($model, 'location', array('value' => $model->location,
                    'placeholder' => 'city or zip', 'class' => 'twelve')); ?>
                </div>
                <div class="two columns">
                    <a href="#"
                       onclick="document.forms['search-form'].submit(); return false;"
                       class="small button twelve minisearch">Search</a>
                </div>
            </div>
            <?php $this->endWidget('CActiveForm'); ?>
        </div>

        <?php endif; ?>

        <div class="three columns notlogged">
            <span class="navWhatskowop">
                <?php echo CHtml::link("what's Kowop?", $this->createUrl("site/page", array('view' => 'howitworks'))); ?>
            </span>
            <span class="navSignup">
                <?php echo CHtml::link("sign up", $this->createUrl("user/create")); ?>
            </span>
            <span class="navLogin">
                <a href="#">log in</a>
            </span>
            <!----- login box dropdown---->
            <div class="loginbox">
                <div class="login">
                    <p>Log in using Facebook</p>
                    <a href="<?php echo Yii::app()->params['siteBase']; ?>/hybridauth/default/login/?provider=facebook">
                        <img src="<?php echo Yii::app()->params['siteBase']; ?>/images/facebook.jpg"> </a>

                    <p>- or -</p>

                    <p>Log in with your Kowop account</p>

                    <?php
                    $loginModel = new LoginForm;

                    $form = $this->beginWidget(
                        'CActiveForm', array(
                        'id' => 'login-form-header',
                        'enableAjaxValidation' => false,
                        'action' => array('site/login'),
                    ));
                    ?>

                    <?php echo $form->textField($loginModel, 'username', array('class' => 'twelve', 'placeholder' => 'login email')); ?>
                    <?php echo $form->passwordField($loginModel, 'password', array('class' => 'twelve', 'placeholder' => 'password')); ?>
                    <a href="#" class="button twelve" onclick="document.forms['login-form-header'].submit(); return false;">Sign
                        in</a>

                    <?php $this->endWidget('CActiveForm'); ?>

                    <p>
                        <a href="#">I forgot</a> | <?php echo CHtml::link('Sign up', array('/user/create')); ?> | <a
                            href="#"
                            class="closelogin">Close</a>
                    </p>
                </div>
            </div>
            <!--- End login box dropdown---->
            <script>
                $(document).ready(function ()
                {
                    $('.navLogin').click(function (e)
                    {
                        e.preventDefault();
                        $('.loginbox').slideToggle('fast');
                    });

                    $('.closelogin').click(function (e)
                    {
                        e.preventDefault();
                        $('.loginbox').slideToggle('fast');
                    });
                });
            </script>
        </div>
    </div>
</div>
<!----- End Homepage logo and header nav ---------->

<?php else: ?>
<?php $user = User::model()->findByPk(Yii::app()->user->id); ?>

<div class="header spacebot20">
    <div class="row">
        <div class="three columns">
            <div class="logo">
                <?php echo CHtml::link('<img src="' . Yii::app()->params['siteBase'] . '/images/logo_small.png">', Yii::app()->homeUrl); ?>
                activities &amp; classes for<br /> kids &amp; families
            </div>
        </div>

        <?php if (isset($search) && $search) : ?>

        <div class="six columns">
            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form',
            'action' => Yii::app()->createUrl('/experience/search'),
            'enableAjaxValidation' => false, 'method' => 'get',
            'htmlOptions' => array('style' => 'margin: 0;'))); ?>

            <?php $model = new ExperienceSearchForm; ?>

            <div class="row">
                <div class="seven columns">
                    <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords,
                    'placeholder' => 'What are you looking for?', 'class' => 'twelve')); ?>
                </div>
                <div class="three columns">
                    <?php echo $form->textField($model, 'location', array('value' => $model->location,
                    'placeholder' => 'city or zip', 'class' => 'twelve')); ?>
                </div>
                <div class="two columns">
                    <a href="#"
                       onclick="document.forms['search-form'].submit(); return false;"
                       class="small button twelve minisearch">Search</a>
                </div>
            </div>
            <?php $this->endWidget('CActiveForm'); ?>
        </div>

        <?php endif; ?>

        <div class="three columns headernav">
            <span class="notifications">
                <?php echo CHtml::link(count($user->messages(array('condition' => '`Read` = 0'))), array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
            </span>
            <!----- My account dropdown ------->
            <div class="dropdown">
                <?php
                echo CHtml::link(
                    '<span class="headerAccount">my account</span>',
                    array(
                        '/user/view',
                        'id' => $user->User_ID,
                        's' => AccountSections::Notifications
                    ),
                    array('class' => 'account')
                );
                ?>
                <div class="submenu" style="display: none;">
                    <ul class="root">
                        <li>
                            <?php echo CHtml::link("post on Kowop", $this->createUrl("site/page", array('view' => 'postingAgreement'))); ?>
                        </li>
                        <li>
                            <?php echo CHtml::link("sign out", $this->createUrl("site/logout")); ?>
                        </li>
                    </ul>
                </div>
            </div>
            <!----- end my account dropdown----->
        </div>
    </div>
</div>

<script>
    $(document).ready(function ()
    {
        $('a.account, .submenu').hover(
                function ()
                {
                    $('.submenu').show();
                },
                function ()
                {
                    $('.submenu').hide();
                }
        );
    });
</script>

<?php endif; ?>