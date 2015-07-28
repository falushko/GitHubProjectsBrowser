<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div id="search">
        <?php $form = ActiveForm::begin(); ?>
    	<?= $form->field($model, 'search')->textInput(['placeholder' => 'Search'])->label('') ?>
		<?php ActiveForm::end(); ?>
    </div>
    
    <ol class="breadcrumb">
        <li><a href="#">Mobidev GitHub Browser</a></li>
        <li class="active">Main</li>
    </ol>



