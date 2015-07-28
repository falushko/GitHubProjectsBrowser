<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SearchForm;
    
$model = new SearchForm;
$description = Html::encode($params['description']);
$watchers = Html::encode($params['watchers']);
$forks = Html::encode($params['forks']);
$issues = Html::encode($params['issues']);
$homepage = Html::encode($params['homepage']);
$gitHubRepo = Html::encode($params['github_repo']);
$createdAt = substr(Html::encode($params['created_at']), 0,-1);
$name = Html::encode($params['name']);
$owner = Html::encode($params['owner']);
$sName = Html::encode($params['sName']);
$liked = array();

foreach($params['liked'] as $key => $value){
    $liked[] = $value->getAttribute('login');
}

?>  

<div id="search">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'search')->textInput(['placeholder' => 'Search'])->label('') ?>
    <?php ActiveForm::end(); ?>
</div>
    
<ol class="breadcrumb">
    <li><a href="http://localhost/web/">Mobidev GitHub Browser</a></li>
    <li class="active"><?= $name ?></li>
</ol> 

<div id="left">
    <ul class="list-group">
        <li class="list-group-item active"><?= $name ?></li>
        <li class="list-group-item">Description:<br/> <?= $description ?></li>
        <li class="list-group-item">Watchers: <?= $watchers ?></li>
        <li class="list-group-item">Forks: <?= $forks ?></li>
        <li class="list-group-item">Open issues: <?= $issues ?></li>
        <li class="list-group-item">Homepage: <a href="<?= $homepage ?>" target="_blank"><?= $homepage ?></a></li>
        <li class="list-group-item">GitHub repo:<a href="<?= $gitHubRepo ?>" target="_blank"><?= $gitHubRepo ?></a></li>
        <li class="list-group-item">Created at: <?= $createdAt ?></li>
    </ul>
</div>

<div id="contributors">
    <ul class="list-group">
        <li class="list-group-item active">Contributors</li>

<?php

foreach($params['contributors'] as $key => $value){

    $contributor;
    $contributor = !empty($value['login']) ? Html::encode($value['login']) : '';
    //if contributor is anonimous
    if(empty($contributor)){
        $contributor = !empty($value['name']) ? Html::encode($value['name']) : '';
        $user = "<span id=\"user_name\">$contributor</span>";
    } else {
        $user = "<span id=\"user_name\"><a href=\"http://localhost/web/index.php?r=site/user&name=$contributor\">$contributor</a></span>";
    }
        
    if(!in_array($contributor, $liked)){
        $like = "<li class=\"list-group-item\">$user &nbsp; <button type=\"button\" class=\"btn btn-default\" 
        onClick=\"parent.location='http://localhost/web/index.php?r=site/user-like-unlike-details&login=$contributor&owner=$owner&name=$sName'\">Like!</button></li>";
    } else {
        $like = "<li class=\"list-group-item\">$user &nbsp;<button type=\"button\" class=\"btn btn-info\" 
        onClick=\"parent.location='http://localhost/web/index.php?r=site/user-like-unlike-details&login=$contributor&owner=$owner&name=$sName'\">Unike!</button></li>";
    }           
    echo $like;
}

?>
    
    </ul>
</div>