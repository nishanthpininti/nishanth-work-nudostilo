<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Investor */

$this->title = 'Update Investor: ' . ' ' . $model->investor_user_name;
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->investor_user_name, 'url' => ['view', 'id' => $model->investor_user_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="investor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
