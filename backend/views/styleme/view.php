<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StyleMe */

$this->title = $model->style_me_id;
$this->params['breadcrumbs'][] = ['label' => 'Style Mes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="style-me-view">

    <h1><?= Html::encode($this->title) ?> updated successfully</h1>

    <p>
        <?= Html::a('Update', ['update', 'style_me_id' => $model->style_me_id, 'customer_user_name1' => $model->customer_user_name1, 'customer_user_name2' => $model->customer_user_name2], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'style_me_id' => $model->style_me_id, 'customer_user_name1' => $model->customer_user_name1, 'customer_user_name2' => $model->customer_user_name2], [
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
            'style_me_id',
            'customer_user_name1',
            'style_id',
            'customer_user_name2',
            'my_comment:ntext',
            'friends_comment:ntext',
            'end_date',
            'completion_status',
        ],
    ]) ?>

</div>
