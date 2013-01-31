<div class="loginsplash">

    <!----- Homepage logo and header nav ---------->
    <div class="header spacebot20">
        <div class="row">
            <div class="three columns">
                <div class="logo">
                    <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_small.png">', Yii::app()->homeUrl); ?>
                    neighborhood classes &amp; activities
                </div>
            </div>

            <div class="four columns notlogged">
            <span class="navWhatskowop">
                <?php echo CHtml::link("how's it work?", $this->createUrl("site/page", array('view' => 'howitworks'))); ?>
            </span>
            <span class="navPost">
                <?php echo CHtml::link("post on Kowop", $this->createUrl("/experience/create")); ?>
            </span>
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

    <!--------- main content container------>
    <div class="row" id="wrapper">
        <div class="six columns offset-by-three">
            <div class="login">
                <span class="homeBlurbcopy">Log in or create an account with Facebook</span>
                <a href="/yiidev/kowop/hybridauth/default/login/?provider=facebook">
                    <img src="/ui/sitev2/images/facebook.jpg">
                </a>
            </div>
        </div>
        <!------- end main content container----->
    </div>
</div>

