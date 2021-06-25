<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>
<h1>RUBRICA</h1>

<?= ListView::widget([
        'dataProvider'=> $dataProvider,
        //'filterModel'=> $searchModel,
        'itemView'=> '_contact_item',
        'options' => [
            'tag' => 'div'
        ],
    ]); 
?>

