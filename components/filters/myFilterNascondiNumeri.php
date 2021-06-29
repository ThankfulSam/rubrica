<?php
namespace app\components\filters;

use yii\base\ActionFilter;

class myFilterNascondiNumeri extends ActionFilter
{
    public function afterAction($action, $result){
       $result = parent::afterAction($action, $result);
       
       $pattern = '/([0-9]{3})[0-9]{7}/';
       $replacement = '$1*******';
       $result = preg_replace($pattern, $replacement, $result);
        
       return $result;
       
    }
    
    private function filterNumber($string){
        //return substr_replace($string, '*', 3);
    }
    
}