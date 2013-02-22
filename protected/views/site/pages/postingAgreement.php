<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="eight columns offset-by-two">

        <h1>Before you get started...</h1>

        <div class="row">
            <div class="twelve columns">
                <p>Please place your left hand on the website, and your right hand in the air and recite after me.</p>

                <p>The Kowop Creed</p>
                <ul>
                    <li>I promise not to spam Kowop with listings.</li>
                    <li>I understand it's 100% free to post, and the way I help Kowop is providing a 10% tip to the site
                        anytime someone signs up for my listing.
                    </li>
                    <li>I promise not to offer any classes or activities that involve illegal or prohibited
                        activities.
                    </li>
                    <li>I will do my best to provide the best experience I can to my customers.</li>
                </ul>
            </div>
        </div>
        <div class="row spacebot20">
            <div class="twelve columns">
                <?php
                $agreeDiv = <<<BLOCK
                    <div class="createOption">
                        <span>For sure!</span>
                        <p>Let's get started</p>
                    </div>

BLOCK;

                echo CHtml::link($agreeDiv, $this->createUrl('/experience/create'));
                ?>
            </div>
        </div>
        <?php echo CHtml::link('Take me back', $this->createUrl('/site/index')); ?>
    </div>
    <!------- end main content container----->
</div>
