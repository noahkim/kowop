<?php

class LoginWidget extends CWidget
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
        $form = new LoginForm();

        if(isset($_POST['LoginForm']))
        {
            $form->attributes = $_POST['LoginForm'];
            if ($form->validate() && $form->login())
            {
                $this->controller->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('loginWidget', array('form' => $form));
    }
}
