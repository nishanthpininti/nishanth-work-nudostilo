<?php

namespace backend\controllers;

use Yii;
use backend\models\Send;
use backend\models\SendSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SendController implements the CRUD actions for Send model.
 */
class SendController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Send models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SendSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Send model.
     * @param string $customer_user_name1
     * @param integer $sytle_id
     * @param string $customer_user_name2
     * @return mixed
     */
    public function actionView($customer_user_name1, $sytle_id, $customer_user_name2)
    {
        return $this->render('view', [
            'model' => $this->findModel($customer_user_name1, $sytle_id, $customer_user_name2),
        		'checkIfUpdate' => ''
        ]);
    }
    
    public function actionViewafterupdate($id,$checkIfUpdate){
    
    	return $this->render('view', [
    			'model' => $this->findModel($id),
    			'checkIfUpdate' => $checkIfUpdate
    	]);
    }

    /**
     * Creates a new Send model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Send();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'customer_user_name1' => $model->customer_user_name1, 'sytle_id' => $model->sytle_id, 'customer_user_name2' => $model->customer_user_name2,'checkIfUpdate'=>'created']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Send model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $customer_user_name1
     * @param integer $sytle_id
     * @param string $customer_user_name2
     * @return mixed
     */
    public function actionUpdate($customer_user_name1, $sytle_id, $customer_user_name2)
    {
        $model = $this->findModel($customer_user_name1, $sytle_id, $customer_user_name2);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'customer_user_name1' => $model->customer_user_name1, 'sytle_id' => $model->sytle_id, 'customer_user_name2' => $model->customer_user_name2,'checkIfUpdate'=>'updated']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Send model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $customer_user_name1
     * @param integer $sytle_id
     * @param string $customer_user_name2
     * @return mixed
     */
    public function actionDelete($customer_user_name1, $sytle_id, $customer_user_name2)
    {
        $this->findModel($customer_user_name1, $sytle_id, $customer_user_name2)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Send model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $customer_user_name1
     * @param integer $sytle_id
     * @param string $customer_user_name2
     * @return Send the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($customer_user_name1, $sytle_id, $customer_user_name2)
    {
        if (($model = Send::findOne(['customer_user_name1' => $customer_user_name1, 'sytle_id' => $sytle_id, 'customer_user_name2' => $customer_user_name2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
