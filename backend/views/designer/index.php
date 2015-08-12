<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DesignerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Designers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Designer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'designer_user_name',
            'designer_first_name',
            'designer_last_name',
            'designer_address1',
            'designer_address2',
            // 'designer_email:email',
            // 'designer_gender',
            // 'designer_from',
            // 'designer_favcolor',
            // 'designer_birthdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
