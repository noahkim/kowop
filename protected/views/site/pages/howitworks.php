<!--------- main content container------>
<div class="row" id="wrapper">
    <h1>What is Kowop?</h1>

    <p>You know those neighborhood cork boards, where people post classes and activities (among other things) around
        your 'hood? We're that, but online.</p>

    <p>Kowop makes it really simple to discover classes and activities for kids and their families. There's no rules or
        restrictions on what people can offer. The more creative the experience, the better.</p>

    <p>Whether you're looking specifically for a Japanese language class, a fun family activity near the beach, or just
        need something to do on a Tuesday morning, Kowop is the place you can easily browse what's available in and
        around your neighborhood.</p>

    <p>We also make it ridiculously easy to post your class or experience. You post once, and it stays available for as
        long as you'd like. We handle payments for you. You can even manage scheduling right on Kowop. Kowop get's out
        of the way as much as possible so people in the community can hook each other up with great experiences.</p>

    <p>Promoting your business or service is easy. Just take 5 minutes to post, and it's 100% free to do so.</p>

    <p>Unlike other sites, we welcome anyone and everyone to post with us. If you're an individual or business who has a
        local class or activity you'd love to share, share on Kowop.</p>

    <div class="homeClasses">
        <h3>What would you like to do?</h3>

        <div class="row">
            <div class="four columns">
                <div class="homeIntro">
                    <?php
                    echo CHtml::link("<img src='" . Yii::app()->params['siteBase'] . "/images/icon_homepage_post.gif'/><h5>Post an activity or class</h5>",
                        $this->createUrl("site/page", array('view' => 'postingAgreement')));
                    ?>
                </div>
            </div>
            <div class="four columns">
                <div class="homeIntro">
                    <?php
                    echo CHtml::link(
                        "<img src='" . Yii::app()->params['siteBase'] . "/images/icon_homepage_discover.gif' /><h5>Find something for the whole family</h5>",
                        array('/experience/search')
                    );
                    ?>
                </div>
            </div>
            <div class="four columns">
                <div class="homeIntro"><a href="kowop_kids.html">
                    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form-kids',
                    'action' => array('/experience/search'),
                    'enableAjaxValidation' => false, 'method' => 'get',
                    'htmlOptions' => array('style' => 'margin: 0;'))); ?>
                    <?php $model = new ExperienceSearchForm; ?>

                    <?php
                    foreach (ExperienceAppropriateAges::$Lookup as $i => $item)
                    {
                        echo "<input type='hidden' name='ExperienceSearchForm[ageRanges][]' value='{$i}' />\n";
                    }
                    ?>
                    <?php $this->endWidget('CActiveForm'); ?>

                    <a href="#" onclick="document.forms['search-form-kids'].submit(); return false;">
                        <img src='<?php echo Yii::app()->params['siteBase']; ?>/images/icon_homepage_kids.gif' /><h5>
                        Find classes &amp; activities for kids</h5>
                    </a>
                </div>
            </div>
        </div>
        <!------- end main content container----->
    </div>
</div>