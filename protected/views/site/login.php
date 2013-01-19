<div class="loginsplash">

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

    <!--------- main content container------>
    <div class="row" id="wrapper">
        <div class="six columns offset-by-three">
            <div class="login">
                <span class="homeBlurbcopy">Log in or create an account with Facebook</span>
                <a href="/yii/kowop/hybridauth/default/login/?provider=facebook">
                    <img src="/ui/sitev2/images/facebook.jpg">
                </a>
            </div>
        </div>
        <!------- end main content container----->
    </div>
</div>

