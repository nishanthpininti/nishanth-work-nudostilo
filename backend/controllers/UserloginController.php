<?php

namespace backend\controllers;

use Yii;
use backend\models\UserLogin;
use backend\models\UserLoginSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserloginController implements the CRUD actions for UserLogin model.
 */
class UserloginController extends Controller
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
     * Lists all UserLogin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserLoginSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserLogin model.
     * @param string $id
     * @return mixed
     */
    
    public function actionViewafterupdate($id,$checkIfUpdate){

    	return $this->render('view', [
    			'model' => $this->findModel($id),
    			'checkIfUpdate' => $checkIfUpdate
    	]);
    }
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        		'checkIfUpdate' => ''
        ]);
    }

    /**
     * Creates a new UserLogin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserLogin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'id' => $model->user_name,'checkIfUpdate'=>'created']);
        } else {
            return $this->render('create', [
                'model' => $model,
            		
            ]);
        }
    }

    /**
     * Updates an existing UserLogin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'id' => $model->user_name,'checkIfUpdate'=>'updated']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserLogin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserLogin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserLogin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserLogin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
