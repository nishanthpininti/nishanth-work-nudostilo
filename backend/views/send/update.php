<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Send */

$this->title = 'Update Send: ' . ' ' . $model->customer_user_name1;
$this->params['breadcrumbs'][] = ['label' => 'Sends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_user_name1, 'url' => ['view', 'customer_user_name1' => $model->customer_user_name1, 'sytle_id' => $model->sytle_id, 'customer_user_name2' => $model->customer_user_name2]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="send-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
