<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = $model->nome . ' ' . $model->cognome;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contact-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler eliminare questo contatto?',
                'method' => 'post',
            ],
        ]) ?>
        <?php 
        if($model->preferito == 0){
            echo Html::a('set as preferred', ['preferred', 'id' => $model->id], ['class' => 'btn btn-info']);
        } else {
            echo Html::a('set as not preferred', ['preferred', 'id' => $model->id], ['class' => 'btn btn-info']);
        }
            ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nome',
            'cognome',
            'telefono',
            'indirizzo',
            'preferito'
        ],
    ]) ?>
    
    

</div>
