<?php

namespace backend\controllers;

use Yii;
use backend\models\Styles;
use backend\models\StylesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StylesController implements the CRUD actions for Styles model.
 */
class StylesController extends Controller
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
     * Lists all Styles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StylesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Styles model.
     * @param integer $style_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionView($style_id, $item_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($style_id, $item_id),
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
     * Creates a new Styles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Styles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'style_id' => $model->style_id, 'item_id' => $model->item_id,'checkIfUpdate'=>'created']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Styles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $style_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionUpdate($style_id, $item_id)
    {
        $model = $this->findModel($style_id, $item_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewafterupdate', 'style_id' => $model->style_id, 'item_id' => $model->item_id,'checkIfUpdate'=>'updated']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Styles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $style_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionDelete($style_id, $item_id)
    {
        $this->findModel($style_id, $item_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Styles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $style_id
     * @param integer $item_id
     * @return Styles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($style_id, $item_id)
    {
        if (($model = Styles::findOne(['style_id' => $style_id, 'item_id' => $item_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
