<?php
namespace app\components\filters;

use yii\base\ActionFilter;
use yii\web\HttpException;

class myFilterOrarioSoglia extends ActionFilter
{

    private $orarioSoglia = '18:00';
    
    public function beforeAction($action)
    {
        
        if(time()<strtotime($this->orarioSoglia)){
            return parent::beforeAction($action);
        } 
        
        throw new HttpException(400,'HAI SUPERATO L\'ORARIO LIMITE PER L\'INSERIMENTO DI UN UTENTE');
    }
    
}