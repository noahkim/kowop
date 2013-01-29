<!---------------------------------------
                 Search
---------------------------------------->
<div class="bigsearchbar">
    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    'action' => Yii::app()->createUrl('/experience/search'),
    'enableAjaxValidation' => false,
    'method' => 'get'
)); ?>

    <?php $model = new ExperienceSearchForm; ?>

    <div class="row">
        <div class="seven columns">
            <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords, 'class' => 'homeSearchinput twelve', 'placeholder' => 'What are you looking for?')); ?>
        </div>
        <div class="three columns">
            <input type="text" class="homeSearchinput twelve" placeholder="city,state or zip">
        </div>
        <div class="two columns">
            <div href="#" class="large button dropdown twelve" style="float:right;"> Go...
                <ul>
                    <li><a onclick="document.forms['search-form'].submit(); return false;" href="#">Learn</a></li>
                    <li><?php echo CHtml::link('Teach', array('experience/create')); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <?php $this->endWidget('CActiveForm'); ?>
</div>
<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="eight columns offset-by-two error">
        <h1><?php echo $code; ?>'ed in the faaaaaaace</h1>
        <p>Sorry about that. We're still working on tidying up things and the page you want couldn't get served.</p>
        <p>Feel free to let us know about it by emailing noah AT kowop.com</p>
        <iframe width="640" height="480" src="http://www.youtube.com/embed/i7dbdZlsR3Y?autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>
    </div>
    <!------- end main content container----->
</div>

<div class="error" style="display: none;">
<?php echo CHtml::encode($message); ?>
</div>
