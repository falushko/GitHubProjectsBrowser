<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SearchForm;

    $model = new SearchForm;
    $login = Html::encode($params['login']);
    $name = Html::encode($params['name']);
    $avatarURL = Html::encode($params['avatar_url']);
    $company = Html::encode($params['company']);
    $blog = Html::encode($params['blog']);
    $followers = Html::encode($params['followers']);
    $liked = $params['liked'];
      
    if(empty($liked)){
        $button = "<button type=\"button\" class=\"btn btn-default\" 
        onClick=\"parent.location='http://192.168.33.10/?r=site/user-like-unlike&login=$login&view=user'\">
        Like!</button>";
    } else {
        $button = "<button type=\"button\" class=\"btn btn-info\" 
        onClick=\"parent.location='http://192.168.33.10/?r=site/user-like-unlike&login=$login&view=user'\">
        Unlike!</button>";
    }
?>
      
<div id="search">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'search')->textInput(['placeholder' => 'Search'])->label('') ?>
        <?php ActiveForm::end(); ?>
</div>
    
<ol class="breadcrumb">
    <li><a href="192.168.33.10/">Mobidev GitHub Browser</a></li>
    <li class="active"><?= $login ?></li>
</ol> 

<div class="panel panel-primary">
    <div class="panel-heading"><?= $name ?> &nbsp; <?= $button ?></div>
    <div class="panel-body">
        <div id="photo"><img src="<?= $avatarURL ?>" width="150" height="150" alt="photo"></div>
        <div id="info" >
            <ul class="list-group">
                <li class="list-group-item"><?= $login ?></li>
                <li class="list-group-item">Company: <?= $company ?></li>
                <li class="list-group-item">Blog: <a href="<?= $blog ?>" target="_blank"><?= $blog ?></a></li>
                <li class="list-group-item">Followers: <?= $followers ?></li>
            </ul>
        </div>
    </div>
</div>