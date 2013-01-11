<?php

class SearchWidget extends CWidget
{
    public function init()
    {
    }

    public function run()
    {
        $this->renderContent();
    }

    protected function renderContent()
    {
        $model = new ClassSearchForm();

        if(isset($_REQUEST['ClassSearchForm']))
        {
            $model->attributes = $_REQUEST['ClassSearchForm'];
        }

        $this->render('searchWidget', array('model' => $model));
    }
}
