<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    'action' => Yii::app()->createUrl('/experience/search'),
    'enableAjaxValidation' => false,
    'method' => 'get'
)); ?>

<div class="row">
    <div class="seven columns">
        <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords, 'class' => 'twelve', 'placeholder' => 'What are you looking for?')); ?>
    </div>
    <div class="three columns">
        <input type="text" class="twelve" placeholder="city or zip">
    </div>
    <div class="two columns">
        <a href="#" onclick="document.forms['search-form'].submit(); return false;"
           class="small button twelve minisearch">Search</a>
    </div>
</div>

<?php $this->endWidget('CActiveForm'); ?>







