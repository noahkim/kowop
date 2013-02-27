<!---------------------------------------
              Footer
---------------------------------------->
<div class="footer">
    <div class="row">
        <div class="two columns footerlinks discover">
            <h5>Discover</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("how it works", $this->createUrl("site/page", array('view' => 'howitworks'))); ?>
                </li>
                <li>
                    <?php
                    echo CHtml::link("post on kowop", $this->createUrl("site/page", array('view' => 'postingAgreement')));
                    ?>
                </li>
                <li>
                    <?php echo CHtml::link("explore classes &amp; activities", $this->createUrl("experience/search")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("make a request", $this->createUrl("request/create")); ?>
                </li>
            </ul>
        </div>
        <div class="two columns footerlinks company">
            <h5>Company</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("about Kowop", $this->createUrl("site/page", array('view' => 'about'))); ?>
                </li>
                <li>
                    <?php echo CHtml::link("FAQ", $this->createUrl("site/page", array('view' => 'faq'))); ?>
                </li>
                <li><a href="#">policies</a></li>
                <li><a href="#">contact</a></li>
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
        <div class="two columns offset-by-five footerlogo"><img src="/ui/sitev2/images/logo_small.png"></div>
    </div>
</div>