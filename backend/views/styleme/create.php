<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StyleMe */

$this->title = 'Create Style Me';
$this->params['breadcrumbs'][] = ['label' => 'Style Mes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="style-me-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
