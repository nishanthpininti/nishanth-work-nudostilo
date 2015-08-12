<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Share */

$this->title = $model->share_id;
$this->params['breadcrumbs'][] = ['label' => 'Shares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="share-view">

    <h1><?= Html::encode($this->title) ?> updated successfully</h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->share_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->share_id], [
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
            'share_id',
            'customer_user_name',
            'style_id',
            'scope',
            'time_stamp',
        ],
    ]) ?>

</div>
