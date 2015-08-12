<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InvestorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Investor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'investor_user_name',
            'investor_first_name',
            'investor_last_name',
            'investor_address1',
            'investor_address2',
            // 'investor_email:email',
            // 'investor_gender',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
