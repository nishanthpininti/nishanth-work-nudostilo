<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Share */

$this->title = 'Update Share: ' . ' ' . $model->share_id;
$this->params['breadcrumbs'][] = ['label' => 'Shares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->share_id, 'url' => ['view', 'id' => $model->share_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="share-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
