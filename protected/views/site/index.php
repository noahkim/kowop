<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<!---------------------------------------
             Main Image
------------------------------------------>
<div class="mainpic">
    <div class="row">
        <div class="six columns">
            <div class="homeBlurbContainer">
                <div class="row homeBlurb">
                    <div class="six columns">
                        Neighborhood classes for just about <strong>anything</strong>. Taught by locals like you, in the
                        comfort of small groups.
                        <span class="blurbSearch">see what new experiences are waiting</span>
                    </div>
                    <div class="six columns">
                        Meet new people, teach &amp; learn new things. Experience the joy of imparting knowledge.
                    </div>
                </div>
                <div class="row homeBlurbAction">
                    <div class="six columns">
                        <input type="text" placeholder="zip code">
                    </div>
                    <div class="six columns">
                        <?php echo CHtml::link('Teach a class', array('/class/create'), array('class' => 'button primary radius')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="six columns">
            <div class="mainpicCaption">
                <a href="class_detail.html">
                    <span class="captionBullet"></span>

                    <h3>West LA Noobtastic Python Class</h3>

                    <p>next available class, Tuesday Dec.14</p>
                </a>
            </div>
        </div>
    </div>
    <!------ 3 callouts ------------>
    <div class="homeCallouts">
        <div class="row">
            <div class="four columns">
                <div class="homeCalloutbox">
                    <h2>How it works</h2>

                    <p> Donec quis elit neque. Mauris metus nunc, consequat eget tincidunt quis, fringilla quis elit.
                        Sed vel erat ligula. Quisque cursus rutrum ante ac pretium. Donec quis turpis justo, laoreet
                        fermentum dolor. Quisque accumsan porttitor sem, id congue ipsum venenatis sed. </p>
                    <a href="#" class="button large secondary radius twelve">I'm Intrigued</a>
                </div>
            </div>
            <div class="four columns">
                <div class="homeCalloutbox">
                    <h2>Teach a Class</h2>

                    <p> Donec quis elit neque. Mauris metus nunc, consequat eget tincidunt quis, fringilla quis elit.
                        Sed vel erat ligula. Quisque cursus rutrum ante ac pretium. Donec quis turpis justo, laoreet
                        fermentum dolor. Quisque accumsan porttitor sem, id congue ipsum venenatis sed. </p>
                    <?php echo CHtml::link('Teach a class', array('/class/create'), array('class' => 'button large secondary radius twelve')); ?>
                </div>
            </div>
            <div class="four columns">
                <div class="homeCalloutbox">
                    <h2>Take a Class</h2>

                    <p> Donec quis elit neque. Mauris metus nunc, consequat eget tincidunt quis, fringilla quis elit.
                        Sed vel erat ligula. Quisque cursus rutrum ante ac pretium. Donec quis turpis justo, laoreet
                        fermentum dolor. Quisque accumsan porttitor sem, id congue ipsum venenatis sed. </p>
                    <?php echo CHtml::link('Take a Class', array('/class/search'), array('class' => 'button large secondary radius twelve')); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------- main content container------>
<div class="row" id="wrapper">
    <!------- end main content container----->
</div>
