<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Designer */

$this->title = $model->designer_user_name;
$this->params['breadcrumbs'][] = ['label' => 'Designers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designer-view">

    <h1><?= Html::encode($this->title) ?> updated successfully</h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->designer_user_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->designer_user_name], [
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
            'designer_user_name',
            'designer_first_name',
            'designer_last_name',
            'designer_address1',
            'designer_address2',
            'designer_email:email',
            'designer_gender',
            'designer_from',
            'designer_favcolor',
            'designer_birthdate',
        ],
    ]) ?>

</div>
