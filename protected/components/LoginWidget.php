<?php

Yii::import('zii.widgets.CPortlet');

class LoginWidget extends CPortlet
{
    public function init()
    {
        parent::init();
    }

    protected function renderContent()
    {
        $this->render('loginWidget', array('model' => new LoginForm()));
    }
}
