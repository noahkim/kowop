<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    'action'=>Yii::app()->createUrl('/class/search'),
    'enableAjaxValidation' => false,
    'method' => 'get'
)); ?>

<div class="row spacebot10">
    <div class="ten columns">
        <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords, 'class' => 'mainsearch', 'placeholder' => 'enter keyword, zip code or city & state')); ?>
    </div>
    <div class="one column end">
        <a href="#" class="button radius" onclick="document.forms['search-form'].submit(); return false;">Search</a>
    </div>
</div>

<?php $this->endWidget('CActiveForm'); ?>

