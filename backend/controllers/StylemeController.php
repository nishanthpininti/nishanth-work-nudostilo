<?php

namespace backend\controllers;

use Yii;
use backend\models\StyleMe;
use backend\models\StyleMeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StylemeController implements the CRUD actions for StyleMe model.
 */
class StylemeController extends Controller
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
     * Lists all StyleMe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StyleMeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StyleMe model.
     * @param integer $style_me_id
     * @param string $customer_user_name1
     * @param string $customer_user_name2
     * @return mixed
     */
    public function actionView($style_me_id, $customer_user_name1, $customer_user_name2)
    {
        return $this->render('view', [
            'model' => $this->findModel($style_me_id, $customer_user_name1, $customer_user_name2),
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
     * Creates a new StyleMe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StyleMe();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'style_me_id' => $model->style_me_id, 'customer_user_name1' => $model->customer_user_name1, 'customer_user_name2' => $model->customer_user_name2,'checkIfUpdate'=>'created']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StyleMe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $style_me_id
     * @param string $customer_user_name1
     * @param string $customer_user_name2
     * @return mixed
     */
    public function actionUpdate($style_me_id, $customer_user_name1, $customer_user_name2)
    {
        $model = $this->findModel($style_me_id, $customer_user_name1, $customer_user_name2);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'style_me_id' => $model->style_me_id, 'customer_user_name1' => $model->customer_user_name1, 'customer_user_name2' => $model->customer_user_name2,'checkIfUpdate'=>'updated']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StyleMe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $style_me_id
     * @param string $customer_user_name1
     * @param string $customer_user_name2
     * @return mixed
     */
    public function actionDelete($style_me_id, $customer_user_name1, $customer_user_name2)
    {
        $this->findModel($style_me_id, $customer_user_name1, $customer_user_name2)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StyleMe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $style_me_id
     * @param string $customer_user_name1
     * @param string $customer_user_name2
     * @return StyleMe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($style_me_id, $customer_user_name1, $customer_user_name2)
    {
        if (($model = StyleMe::findOne(['style_me_id' => $style_me_id, 'customer_user_name1' => $customer_user_name1, 'customer_user_name2' => $customer_user_name2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
