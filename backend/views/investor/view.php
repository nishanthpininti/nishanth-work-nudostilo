<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Investor */

$this->title = $model->investor_user_name;
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investor-view">

    <h1><?= Html::encode($this->title) ?> updated successfully</h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->investor_user_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->investor_user_name], [
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
            'investor_user_name',
            'investor_first_name',
            'investor_last_name',
            'investor_address1',
            'investor_address2',
            'investor_email:email',
            'investor_gender',
        ],
    ]) ?>

</div>
