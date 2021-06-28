<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RUBRICA';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index" align="center">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Inserisci Nuovo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
	
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['tag'=> 'h3'],
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
           $nome_cognome = $model->nome . ' ' . $model->cognome;
           if($model->preferito){
               $nome_cognome = '* ' . $nome_cognome . ' *'; 
           }
           return Html::a(Html::encode($nome_cognome), ['view', 'id' => $model->id]);
        },
    ]) ?>


</div>
