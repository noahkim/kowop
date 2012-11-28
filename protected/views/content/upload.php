<?php

$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'upload-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);
// ...
echo $form->labelEx($modelFileUpload, 'file');
echo $form->fileField($modelFileUpload, 'file');
echo $form->error($modelFileUpload, 'file');
// ...
$this->endWidget();

?>