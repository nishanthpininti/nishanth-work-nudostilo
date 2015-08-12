<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'customer_user_name',
            'customer_first_name',
            'customer_last_name',
            'customer_address1',
            'customer_address2',
            // 'customer_email:email',
            // 'customer_gender',
            // 'customer_from',
            // 'customer_favcolor',
            // 'customer_birthdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
