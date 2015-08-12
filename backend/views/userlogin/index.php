<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserLoginSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Logins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-login-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Login', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_name',
            'user_password',
            'user_type',
            'user_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
