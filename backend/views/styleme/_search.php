<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StyleMeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="style-me-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'style_me_id') ?>

    <?= $form->field($model, 'customer_user_name1') ?>

    <?= $form->field($model, 'style_id') ?>

    <?= $form->field($model, 'customer_user_name2') ?>

    <?= $form->field($model, 'my_comment') ?>

    <?php // echo $form->field($model, 'friends_comment') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'completion_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
