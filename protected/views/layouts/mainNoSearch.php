<?php $this->beginContent('//layouts/mainOuter'); ?>
<!---------------------------------------
                 Header
---------------------------------------->
<?php if (Yii::app()->user->isGuest) : ?>

<!----- Homepage logo and header nav ---------->
<div class="header spacebot20">
    <div class="row">
        <div class="three columns">
            <div class="logo">
                <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_small.png">', Yii::app()->homeUrl); ?>
                Teach. Learn. Meet.
            </div>
        </div>

        <div class="three columns notlogged">
            <span class="navWhatskowop"><a href="how_it_works.html">what's Kowop?</a></span>
            <span class="navSignup">
                <?php echo CHtml::link("sign up", $this->createUrl("site/login")); ?>
            </span>
            <span class="navLogin">
                <?php echo CHtml::link("log in", $this->createUrl("site/login")); ?>
            </span>
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
                <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_small.png">', Yii::app()->homeUrl); ?>
                Teach. Learn. Meet.
            </div>
        </div>

        <div class="three columns headernav">
            <span class="notifications">
                <?php echo CHtml::link(count($user->messages(array('condition' => '`Read` = 0'))), array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
            </span>
            <!----- My account dropdown ------->
            <div class="dropdown">
                <a href="#" class="account">
                    <span class="headerAccount">my account</span>
                </a>

                <div class="submenu" style="display: none;">
                    <ul class="root">
                        <li>
                            <?php echo CHtml::link('notifications', array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
                        </li>
                        <li>
                            <?php echo CHtml::link('my classes', array('/user/view', 'id' => $user->User_ID, 's' => 2)); ?>
                        </li>
                        <li>
                            <?php echo CHtml::link('calendar', array('/user/view', 'id' => $user->User_ID, 's' => 4)); ?>
                        </li>
                        <li>
                            <?php echo CHtml::link('account info', array('/user/view', 'id' => $user->User_ID, 's' => 5)); ?>
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

    <?php endif; ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>