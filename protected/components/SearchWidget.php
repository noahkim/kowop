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
        $model = new ExperienceSearchForm();

        if(isset($_REQUEST['ExperienceSearchForm']))
        {
            $model->attributes = $_REQUEST['ExperienceSearchForm'];
        }

        $this->render('searchWidget', array('model' => $model));
    }
}
