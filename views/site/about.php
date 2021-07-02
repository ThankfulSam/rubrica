<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$url_login = Url::toRoute('site/login');
$url_signup = Url::toRoute('site/signup');
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	<br>
    <h4>
        <?php echo Html::encode('Questa e\' un\'applicazione per la memorizzazione dei contatti.')?>
    </h4>    
    
    <?php if(Yii::$app->user->isGuest) : ?>
        <h4>    
            Per favore <?php echo Html::a('accedi', $url_login); ?> o 
            <?php echo Html::a('registrati', $url_signup); ?> per iniziare ad usarla.
    	</h4>
    <?php endif;
    ?>

</div>
