<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

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
    
		<?php /*echo ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['tag'=> 'h4'],
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
           $nome_cognome = $model->nome . ' ' . $model->cognome . ' ' . $model->telefono;
           if($model->preferito){
               $nome_cognome = '* ' . $nome_cognome . ' *'; 
           }
           return Html::a(Html::encode($nome_cognome), ['view', 'id' => $model->id]);
        },
    ]) */ ?>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            /*'rowOptions' => function($model){
                if($model['preferito'] == 1){
                    return ['style'=>'color:orange;'];
                }
            },*/
            'columns' => [
                ['label' => 'Nome e cognome',
                    'format' => 'raw',
                    'value' => function($model){
                        $nome_cognome = $model->nome . ' ' . $model->cognome;
                        return Html::a($nome_cognome, ['view', 'id' => $model->id]);
                    }
                ],
                'telefono',
                ['label' => 'Preferito',
                    'value' => function($model){
                        if($model['preferito'] == 1){
                            return '*';
                        } else {
                            return ' ';
                        }
                    }
                ],
                ],
        ]) ?>
    
	<br>
	<p>
		<?php echo Html::a('ordina per nome', ['ordina-per', 'order' => 'nome'], [
		    'class' => 'btn btn-info',
		    'method' => 'post'
		])?>
		<?php echo Html::a('ordina per numero', ['ordina-per', 'order' => 'telefono'], [
		    'class' => 'btn btn-info',
		    'method' => 'post'
		])?>
	</p>
	<p>
		<?php echo Html::a('mostra solo preferiti', ['mostra-solo-preferiti'], [
		    'class' => 'btn btn-primary',
		    'method' => 'post'
		])?>
		<?php echo Html::a('mostra tutti', ['index'], [
		    'class' => 'btn btn-primary',
		    'method' => 'post'
		])?>
	</p>
	
</div>
