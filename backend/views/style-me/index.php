<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StyleMeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Style Mes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="style-me-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Style Me', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'style_me_id',
            'customer_user_name1',
            'style_id',
            'customer_user_name2',
            'my_comment:ntext',
            // 'friends_comment:ntext',
            // 'end_date',
            // 'completion_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
