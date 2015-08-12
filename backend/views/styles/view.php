<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Styles */

$this->title = $model->style_id;
$this->params['breadcrumbs'][] = ['label' => 'Styles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="styles-view">

    <h1><?= Html::encode($this->title) ?> updated successfully</h1>

    <p>
        <?= Html::a('Update', ['update', 'style_id' => $model->style_id, 'item_id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'style_id' => $model->style_id, 'item_id' => $model->item_id], [
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
            'style_id',
            'item_id',
        ],
    ]) ?>

</div>
