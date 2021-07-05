<?php

namespace app\controllers;

use Yii;
use app\models\Contact;
use app\models\ContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use app\components\filters\myFilterOrarioSoglia;
use app\components\filters\myFilterNascondiNumeri;
use yii\filters\AccessControl;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends Controller
{
    
    /*attributo che indica l'id dell'utente per operazioni di ricerca e inserimento*/
    public $user_id;
    /**
     * {@inheritDoc}
     * @see \yii\base\Controller::__construct()
     * Reimplementato il metodo __construct con aggiunta del parametro user_id
     */
    public function __construct($id, $module, $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->user_id = Yii::$app->user->getId();
        }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'myfiltersoglia' => [
                'class' => myFilterOrarioSoglia::className(),
                'only' => ['create'],
            ],
            'myfilternumeri' => [
                'class' => myFilterNascondiNumeri::className(),
                'only'=> ['index']
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                
            ]
        ];
    }

    /**
     * Lists all Contact models, diversi a seconda dei parametri passati.
     * @return mixed
     */
    public function actionIndex($order=null, $preferred=null)
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->andWhere(['user_id' => $this->user_id]);
        
        if (isset($order)){
            $dataProvider->query->addOrderBy($order);
        }
        
        if (isset($preferred)){
            $dataProvider->query->andWhere('preferito = 1');
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post())){
            $model->user_id = $this->user_id;
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    
    /* Metodo che permette di settare come preferito un determinato utente
     * dalla vista dettagliata del singolo.
     */
    public function actionPreferred($id)
    {
        
        $model = $this->findModel($id);
        
        if($model->preferito == 0){
            $model->preferito = 1;
        } else {
            $model->preferito = 0;
        }
        
        if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
    }
    
    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
