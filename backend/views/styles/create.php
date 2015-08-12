<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Styles */

$this->title = 'Create Styles';
$this->params['breadcrumbs'][] = ['label' => 'Styles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="styles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
