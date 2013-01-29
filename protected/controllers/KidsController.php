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

        $model = new ClassSearchForm;

        if (isset($_REQUEST['ClassSearchForm']))
        {
            $model->attributes = $_REQUEST['ClassSearchForm'];
            Yii::app()->session['lastSearch'] = $model->keywords;
        }

        $results = $model->search();

        $this->render('search', array('model' => $model, 'results' => $results));
    }
}
