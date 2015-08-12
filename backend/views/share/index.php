<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShareSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="share-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Share', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'share_id',
            'customer_user_name',
            'style_id',
            'scope',
            'time_stamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
