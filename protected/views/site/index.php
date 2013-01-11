<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<!---------------------------------------
             Main Image
------------------------------------------>
<div class="mainpic">
    <div class="row">
        <div class="eight columns offset-by-two">
            <div class="homeBlurbContainer">
                <div class="row homeBlurb">
                    <div class="six columns"><img src="/ui/site/images/blurb_andonline.png" class="blurbAndOnline"> Neighborhood
                        classes on just about <strong>anything</strong> for people who are short on time, but want to
                        learn. Taught by locals like you in the comfort of small groups.
                    </div>
                    <div class="six columns"> Meet new people, teach &amp; learn new things. <span
                            class="blurbHighlight">Experience the joy of imparting knowledge (and make a little beer money if you'd like).</span>
                    </div>
                </div>
                <div class="row homeBlurbAction">
                    <div class="six columns">
                        <?php
                        $searchModel = new ClassSearchForm;

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
                            'placeholder' => 'search by topic or location',
                            'onkeypress' => 'if ((e.which || e.keyCode) == 13) { document.forms["search-form"].submit(); return false; }'
                        )); ?>

                        <?php echo CHtml::link('or just browse all classes', array('/class/search')); ?>

                        <?php $this->endWidget('CActiveForm'); ?>
                    </div>
                    <div class="six columns">
                        <?php echo CHtml::link('Teach a class', array('/class/create'), array('class' => 'button primary radius')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="four columns offset-by-eight">
            <div class="mainpicCaption"><a href="/ui/site/class_detail.html"> <span class="captionBullet"></span>

                <h3>West LA Noobtastic Python Class</h3>

                <p>4 sessions, next available class: Tuesday Dec.14</p>
            </a></div>
        </div>
    </div>
</div>
<!--------- main content container------>
<div class="row" id="homeWrapper">
    <div class="twelve columns">
        <!---- Featured Class ------>
        <div class="row homeFeatured">
            <div class="six columns"><span class="ribbon featured"></span> <img src="http://placehold.it/800x600"></div>
            <div class="six columns">
                <h2>Featured class title</h2>
                <span class="featuredInstructor"><img src="http://placehold.it/100x100">by Noah Kim</span>

                <p>Sed blandit auctor dolor id condimentum. Class aptent taciti sociosqu ad litora torquent per conubia
                    nostra, per inceptos himenaeos. Aenean est urna, tristique ac suscipit posuere, rhoncus eget odio.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit auctor dolor id condimentum.
                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean
                    est urna, tristique ac suscipit posuere, rhoncus eget odio. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit.</p>
            </div>
        </div>
        <!---- end Featured Class---->
        <!---- Staff picks ------->
        <div class="row homeStaffpicks">
            <h2>Classes in Los Angeles</h2>
            <!---- 1 staff pick -------->
            <div class="four columns"><span class="ribbon staffpick"></span>

                <div class="homeTile">
                    <div class="staffpicksImage"><img src="http://placehold.it/800x600"></div>
                    <div class="staffpicksTitle">
                        <h3>True Grill, you think you know, but you have no idea</h3>
                    </div>
                    <div class="staffpicksInstructor"><img src="http://placehold.it/100x100"> by <a
                            href="/ui/site/user_profile_public.html">Chef Yanni Pastrami</a></div>
                    <div class="staffpicksDescription">Sed blandit auctor dolor id condimentum. Class aptent taciti
                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean est urna,
                        tristique ac suscipit posuere, rhoncus eget odio. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit.
                    </div>
                    <div class="enrollees"><span>Currently Enrolled</span> <img
                            src="http://placeskull.com/100/100/868686"> <img src="http://placeskull.com/100/100/868686">
                        <img src="http://placeskull.com/100/100/868686"> <img
                                src="http://placeskull.com/100/100/868686"> <img
                                src="http://placeskull.com/100/100/868686"></div>
                </div>
            </div>
            <!------ End 1 staff pick----------->
            <!---- 1 staff pick -------->
            <div class="four columns"><span class="ribbon staffpick"></span>

                <div class="homeTile">
                    <div class="staffpicksImage"><img src="http://placehold.it/800x600"></div>
                    <div class="staffpicksTitle">
                        <h3>True Grill, you think you know, but you have no idea</h3>
                    </div>
                    <div class="staffpicksInstructor"><img src="http://placehold.it/100x100"> by <a
                            href="/ui/site/user_profile_public.html">Chef Yanni Pastrami</a></div>
                    <div class="staffpicksDescription">Sed blandit auctor dolor id condimentum. Class aptent taciti
                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean est urna,
                        tristique ac suscipit posuere, rhoncus eget odio. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit.
                    </div>
                    <div class="enrollees"><span>Currently Enrolled</span> <img
                            src="http://placeskull.com/100/100/868686"> <img src="http://placeskull.com/100/100/868686">
                        <img src="http://placeskull.com/100/100/868686"> <img
                                src="http://placeskull.com/100/100/868686"> <img
                                src="http://placeskull.com/100/100/868686"></div>
                </div>
            </div>
            <!------ End 1 staff pick----------->
            <!---- 1 staff pick -------->
            <div class="four columns"><span class="ribbon staffpick"></span>

                <div class="homeTile">
                    <div class="staffpicksImage"><img src="http://placehold.it/800x600"></div>
                    <div class="staffpicksTitle">
                        <h3>True Grill, you think you know, but you have no idea</h3>
                    </div>
                    <div class="staffpicksInstructor"><img src="http://placehold.it/100x100"> by <a
                            href="/ui/site/user_profile_public.html">Chef Yanni Pastrami</a></div>
                    <div class="staffpicksDescription">Sed blandit auctor dolor id condimentum. Class aptent taciti
                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean est urna,
                        tristique ac suscipit posuere, rhoncus eget odio. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit.
                    </div>
                    <div class="enrollees"><span>Currently Enrolled</span> <img
                            src="http://placeskull.com/100/100/868686"> <img src="http://placeskull.com/100/100/868686">
                        <img src="http://placeskull.com/100/100/868686"> <img
                                src="http://placeskull.com/100/100/868686"> <img
                                src="http://placeskull.com/100/100/868686"></div>
                </div>
            </div>
            <!------ End 1 staff pick----------->
        </div>
        <!---- end staff picks---->
        <!------- end main content container----->
    </div>
</div>
