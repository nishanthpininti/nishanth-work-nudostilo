<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Send */

$this->title = 'Create Send';
$this->params['breadcrumbs'][] = ['label' => 'Sends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="send-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
