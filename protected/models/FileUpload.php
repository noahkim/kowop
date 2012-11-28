<?php

class FileUpload extends CFormModel
{
    public $file;

    const FileSavePath = "/uploads";

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            //note you wont need a safe rule here
            array('file', 'safe'),
        );
    }

    public function save($content)
    {
        //Yii::app()->params['paramName']
        $this->file->saveAs(FileUpload::FileSavePath . '/' . $content->Content_ID);
    }
}