<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Contact;
use yii\data\ActiveDataProvider;

class ContactController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' =>  Contact::find()->orderBy('nome'),
            'pagination' => [
                'pageSize' => 4,   
            ],        
        ]);
        return $this->render('index', ['dataProvider'=> $dataProvider]);
    }
    
    /* public function actionView($id)
    {
        $model = Post::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    } */
    
    /* public function actionCreate()
    {
        $model = new Post;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    } */
}