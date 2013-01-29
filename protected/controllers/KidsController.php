<?php

class KidsController extends Controller
{
	public function actionIndex()
	{
        $this->layout = false;

		$this->render('index');
	}

    public function actionSearch()
    {
        $this->layout = '//layouts/mainNoSearch';

        $model = new ExperienceSearchForm;

        if (isset($_REQUEST['ExperienceSearchForm']))
        {
            $model->attributes = $_REQUEST['ExperienceSearchForm'];
            Yii::app()->session['lastSearch'] = $model->keywords;
        }

        $results = $model->search();

        $this->render('search', array('model' => $model, 'results' => $results));
    }
}
