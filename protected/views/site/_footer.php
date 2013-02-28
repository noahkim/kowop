<!---------------------------------------
              Footer
---------------------------------------->
<div class="footer">
    <div class="row">
        <div class="two columns footerlinks discover">
            <h5>Discover</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("how it works", array("site/page", 'view' => 'howitworks')); ?>
                </li>
                <li>
                    <?php echo CHtml::link("post on kowop", array("site/page", 'view' => 'postingAgreement')); ?>
                </li>
                <li>
                    <?php echo CHtml::link("explore classes &amp; activities", array("experience/search")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("make a request", array("request/create")); ?>
                </li>
            </ul>
        </div>
        <div class="two columns footerlinks company">
            <h5>Company</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("about Kowop", array("site/page", 'view' => 'about')); ?>
                </li>
                <li>
                    <?php echo CHtml::link("FAQ", array("site/page", 'view' => 'faq')); ?>
                </li>
                <li>
                    <?php echo CHtml::link("policies", array("site/page", 'view' => 'policies')); ?>
                </li>
                <li>
                    <?php echo CHtml::link("contact", array("site/contact")); ?>
                </li>
                <li><a href="#">terms &amp; privacy</a></li>
            </ul>
        </div>
        <div class="two columns footerlinks joinuson">
            <h5>Join us on:</h5>
            <ul>
                <li><a href="#">Sign up for our newsletter</a></li>
            </ul>
        </div>
        <div class="six columns"></div>
    </div>
    <div class="row">
        <div class="two columns offset-by-five footerlogo"><img src="<?php echo Yii::app()->params['siteBase']; ?>/images/logo_small.png"></div>
    </div>
</div>