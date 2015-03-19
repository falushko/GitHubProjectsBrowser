<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SearchForm;

class SiteController extends Controller
{

// If search form have been sent, then rendering results.
// If no, then rendering Yii repo information
    public function actionIndex()
    {
        $model = new SearchForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->getRepositories();
            return $this->render('search', ['params' => $result]);
        } else {
            $repo = $model->getRepoDetails('yiisoft', 'yii');
            return $this->render('repo_details', ['params' => $repo]);
        }
    }

// Rendering repository information
    public function actionRepo($owner, $name)
    {
        $model = new SearchForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->getRepositories();
            return $this->render('search', ['params' => $result]);
        }

        $repo = $model->getRepoDetails($owner, $name);
        return $this->render('repo_details', ['params' => $repo]);
    }

//Rendering user informtion
    public function actionUser($name)
    {
        $model = new SearchForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->getRepositories();
            return $this->render('search', ['params' => $result]);
        }

        $user = $model->getUserDetails($name);
        return $this->render('user', ['params' => $user]);
    }

// Next two actions create/delete user DB records.
// They should be merged.
    public function actionUserLikeUnlike($login)
    {
        $model = new SearchForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->getRepositories();
            return $this->render('search', ['params' => $result]);
        }

        $model->userLikeUnlike($login);
        $user = $model->getUserDetails($login);
        return $this->render('user', ['params' => $user]);
    }

    public function actionUserLikeUnlikeDetails($login, $owner, $name)
    {
        $model = new SearchForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->getRepositories();
            return $this->render('search', ['params' => $result]);
        }

        $model->userLikeUnlike($login);
        $repo = $model->getRepoDetails($owner, $name);
        return $this->render('repo_details', ['params' => $repo]);
    }

//Create/delete repository DB records.
    public function actionRepoLikeUnlike($repo, $phrase)
    {
        $model = new SearchForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->getRepositories();
            return $this->render('search', ['params' => $result]);
        }

        $model->repoLikeUnlike($repo);
        $result = $model->getRepositoriesWithSearchPhrase($phrase);
        return $this->render('search', ['params' => $result]);
    }

}
