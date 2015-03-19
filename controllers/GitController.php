<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\SearchForm;

class GitController extends Controller 
{

	public function actionRepository()
	{
        $model = new SearchForm;
        $result = $model->getTest();

		return $this->render('git', ['params' => $result]);
    
	}

    public function actionOneRepo()
    {
        $client = new \Github\Client();
        $repo = $client->api('repo')->show('KnpLabs', 'php-github-api');
        return $this->render('git', ['params' => $repo]);

    }

    
}

