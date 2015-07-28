<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SearchForm;
$model = new SearchForm;
?>

<div id="search">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'search')->textInput(['placeholder' => 'Search'])->label('') ?>
    <?php ActiveForm::end(); ?>
</div>
    
<ol class="breadcrumb">
    <li><a href="http://192.168.33.10/">Mobidev GitHub Browser</a></li>
    <li class="active">Search</li>
</ol>

<?php

if(empty($params)){
    echo "<div class=\"alert alert-danger\" role=\"alert\"><span>Nothing found! Enter some other request please.</span></div>";
    return;
}

foreach($params as $key => $value){
    $name = Html::encode($value['name']);
    $homepage = Html::encode($value['homepage']);
    $owner = Html::encode($value['owner']);
    $watchers = Html::encode($value['watchers']);
    $forks = Html::encode($value['forks']);
    $description = Html::encode($value['description']);
    $liked = $value['liked'];

    if(empty($liked)){
        $like = "<button type=\"button\" class=\"btn btn-default\" 
        onClick=\"parent.location='http://192.168.33.10/?r=site/repo-like-unlike&repo=$owner/$name&phrase={$value['search_phrase']}'\">Like!</button>";
    } else {
        $like = "<button type=\"button\" class=\"btn btn-info\" 
        onClick=\"parent.location='http://192.168.33.10/?r=site/repo-like-unlike&repo=$owner/$name&phrase={$value['search_phrase']}'\">Unike!</button>";
    }

echo <<<LABEL
  <ul class="list-group">
    <li class="list-group-item active"><a class="white" href="http://192.168.33.10/?r=site/repo&owner=$owner&name=$name">$name</a>
    $like</li>
    <li class="list-group-item">Description:<br/> $description</li>
    <li class="list-group-item">Owner: <a href="http://192.168.33.10/?r=site/user&name=$owner">$owner</a></li>
    <li class="list-group-item">Watchers: $watchers</li>
    <li class="list-group-item">Forks: $forks</li>
    <li class="list-group-item">Homepage: <a href="$homepage" target="_blank">$homepage</a></li>
</ul>
LABEL;
}
?>
