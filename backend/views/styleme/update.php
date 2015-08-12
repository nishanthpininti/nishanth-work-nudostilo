<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StyleMe */

$this->title = 'Update Style Me: ' . ' ' . $model->style_me_id;
$this->params['breadcrumbs'][] = ['label' => 'Style Mes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->style_me_id, 'url' => ['view', 'style_me_id' => $model->style_me_id, 'customer_user_name1' => $model->customer_user_name1, 'customer_user_name2' => $model->customer_user_name2]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="style-me-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
