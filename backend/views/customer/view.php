<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = $model->customer_user_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?> updated successfully</h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->customer_user_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->customer_user_name], [
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
            'customer_user_name',
            'customer_first_name',
            'customer_last_name',
            'customer_address1',
            'customer_address2',
            'customer_email:email',
            'customer_gender',
            'customer_from',
            'customer_favcolor',
            'customer_birthdate',
        ],
    ]) ?>

</div>
