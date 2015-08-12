<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Designer */

$this->title = 'Update Designer: ' . ' ' . $model->designer_user_name;
$this->params['breadcrumbs'][] = ['label' => 'Designers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->designer_user_name, 'url' => ['view', 'id' => $model->designer_user_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="designer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
