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
                <!--<li>
                    <?php /*echo CHtml::link("about Kowop", array("site/page", 'view' => 'about')); */?>
                </li>-->
                <li>
                    <?php echo CHtml::link("FAQ", array("site/page", 'view' => 'faq')); ?>
                </li>
                <li>
                    <?php echo CHtml::link("policies", array("site/page", 'view' => 'policies')); ?>
                </li>
                <li>
                    <?php echo CHtml::link("contact", array("site/contact")); ?>
                </li>
            </ul>
        </div>
        <div class="two columns footerlinks joinuson">
            <h5>Join us on:</h5>
            <ul>
                <li><a href="#" data-reveal-id="newsletter">Sign up for our newsletter</a></li>
            </ul>
        </div>
        <div class="six columns"></div>
    </div>
    <div class="row">
        <div class="two columns offset-by-five footerlogo">
            <img src="<?php echo Yii::app()->params['siteBase']; ?>/images/logo_small.png"></div>
    </div>
</div>

<!----- Modal ------------->
<div id="newsletter" class="reveal-modal">
    <!-- Begin MailChimp Signup Form -->
    <div id="mc_embed_signup">
        <form action="http://kowop.us6.list-manage2.com/subscribe/post?u=6cdd43d317&amp;id=212d06441e"
              method="post"
              id="mc-embedded-subscribe-form"
              name="mc-embedded-subscribe-form"
              class="validate"
              target="_blank"
              novalidate>
            <h2>Join our mailing list</h2>

            <p>Receive updates on new activities &amp; classes in your area. We'll never share your information with
                anyone else, and you can unsubscribe at anytime.</p>

            <div class="indicates-required"><p><span class="asterisk">*</span> indicates required</p></div>
            <div class="mc-field-group">
                <label for="mce-EMAIL">Email Address <span class="asterisk">*</span> </label> <input type="email"
                                                                                                     value=""
                                                                                                     name="EMAIL"
                                                                                                     class="required email"
                                                                                                     id="mce-EMAIL">
            </div>
            <div class="mc-field-group">
                <label for="mce-MMERGE1">Zipcode <span class="asterisk">*</span> </label> <input type="text"
                                                                                                 value=""
                                                                                                 name="MMERGE1"
                                                                                                 class="required"
                                                                                                 id="mce-MMERGE1">
            </div>
            <div class="mc-field-group input-group">
                <strong>Email Format </strong>
                <ul>
                    <li style="list-style:none; float:left;"><input type="radio"
                                                                    value="html"
                                                                    name="EMAILTYPE"
                                                                    id="mce-EMAILTYPE-0"><label for="mce-EMAILTYPE-0">html</label>
                    </li>
                    <li style="list-style:none; float:left;"><input type="radio"
                                                                    value="text"
                                                                    name="EMAILTYPE"
                                                                    id="mce-EMAILTYPE-1"><label for="mce-EMAILTYPE-1">text</label>
                    </li>
                    <li style="list-style:none; float:left;"><input type="radio"
                                                                    value="mobile"
                                                                    name="EMAILTYPE"
                                                                    id="mce-EMAILTYPE-2"><label for="mce-EMAILTYPE-2">mobile</label>
                    </li>
                </ul>
            </div>
            <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
            </div>
            <div class="clear" style="clear:both; padding-top:10px;"><input type="submit"
                                                                            value="Subscribe"
                                                                            name="subscribe"
                                                                            id="mc-embedded-subscribe"
                                                                            class="button large twelve"></div>
        </form>
    </div>

    <!--End mc_embed_signup-->
    <a class="close-reveal-modal">&#215;</a>
</div>
