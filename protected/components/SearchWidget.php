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
        $model = new SearchForm();

        if(isset($_REQUEST['SearchForm']))
        {
            $model->attributes = $_REQUEST['SearchForm'];
        }

        $this->render('searchWidget', array('model' => $model));
    }
}
