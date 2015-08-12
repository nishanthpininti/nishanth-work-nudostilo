<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Investor */

$this->title = 'Create Investor';
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
