<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Styles */

$this->title = 'Update Styles: ' . ' ' . $model->style_id;
$this->params['breadcrumbs'][] = ['label' => 'Styles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->style_id, 'url' => ['view', 'style_id' => $model->style_id, 'item_id' => $model->item_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="styles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
