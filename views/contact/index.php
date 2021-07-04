<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RUBRICA';
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;
?>
<div class="contact-index" align="center">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Inserisci Nuovo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
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
		
		<?php 
		
    		$preferred = $request->get('preferred');
    		
    		echo Html::a('ordina per nome', ['index', 
    		    'order' => 'nome', 'preferred' => $preferred], [
    		    'class' => 'btn btn-info',
    		    'method' => 'post',
    		]); 
    		
    		echo Html::a('ordina per numero', ['index',
    		    'order' => 'telefono', 
    		    'preferred' => $preferred
    		], [
    		    'class' => 'btn btn-info',
    		    'method' => 'post',
		]) ?>
	</p>
	<p>
		<?php 
		
    		$order = $request->get('order');
    		
    		echo Html::a('mostra solo preferiti', ['index',
    		    'order' => $order,
    		    'preferred' => true
    		], [
    		    'class' => 'btn btn-primary',
    		    'method' => 'post'
    		]);
    		
    		echo Html::a('mostra tutti', ['index',
    		    'order'=> $order,
    		    'preferred'=>null
    		], [
    		    'class' => 'btn btn-primary',
    		    'method' => 'post'
		]) ?>
	</p>
	<?php if(!Yii::$app->user->isGuest){
	    //echo \Yii::$app->user->identity->username;
	    //echo \Yii::$app->user->getId();
	}
	
	?>
</div>
