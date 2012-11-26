<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<!---------------------------------------
             Main Image
------------------------------------------>
<div class="mainpic">
    <div class="row">
        <div class="eight columns">
            <div class="homeBlurbContainer">
                <div class="row homeBlurb">
                    <div class="six columns">
                        <img src="/ui/site/images/blurb_andonline.png" class="blurbAndOnline">
                        Neighborhood classes on just about <strong>anything</strong> for people who are short on time,
                        but want to learn. Taught by locals like you in the comfort of small groups.
                        <span class="blurbHighlight">See what's out there.</span>
                    </div>
                    <div class="six columns">
                        Meet new people, teach &amp; learn new things.
                        <span class="blurbHighlight">Experience the joy of imparting knowledge (and make a little beer money if you'd like).</span>
                    </div>
                </div>
                <div class="row homeBlurbAction">
                    <div class="six columns">
                        <?php
                        $searchModel = new SearchForm;

                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'search-form',
                            'action' => Yii::app()->createUrl('/class/search'),
                            'enableAjaxValidation' => false,
                            'method' => 'get',
                            'htmlOptions' => array('style' => 'margin: 0;')
                        )); ?>

                        <?php echo $form->textField($searchModel, 'keywords',
                        array(
                            'value' => $searchModel->keywords,
                            'placeholder' => 'zip code',
                            'onkeypress' => 'if ((e.which || e.keyCode) == 13) { document.forms["search-form"].submit(); return false; }'
                        )); ?>
                        <?php $this->endWidget('CActiveForm'); ?>
                    </div>
                    <div class="six columns">
                        <?php echo CHtml::link('Teach a class', array('/class/create'), array('class' => 'button primary radius')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="four columns">
            <div class="mainpicCaption">
                <a href="class_detail.html">
                    <span class="captionBullet"></span>

                    <h3>West LA Noobtastic Python Class</h3>

                    <p>4 sessions, next available class: Tuesday Dec.14</p>
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
