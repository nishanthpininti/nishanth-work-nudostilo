<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Send */

$this->title = $model->customer_user_name1;
$this->params['breadcrumbs'][] = ['label' => 'Sends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="send-view">

    <h1><?= Html::encode($this->title) ?> updated successfully</h1>

    <p>
        <?= Html::a('Update', ['update', 'customer_user_name1' => $model->customer_user_name1, 'sytle_id' => $model->sytle_id, 'customer_user_name2' => $model->customer_user_name2], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'customer_user_name1' => $model->customer_user_name1, 'sytle_id' => $model->sytle_id, 'customer_user_name2' => $model->customer_user_name2], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customer_user_name1',
            'sytle_id',
            'customer_user_name2',
        ],
    ]) ?>

</div>
