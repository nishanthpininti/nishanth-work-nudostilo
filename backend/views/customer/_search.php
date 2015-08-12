<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'customer_user_name') ?>

    <?= $form->field($model, 'customer_first_name') ?>

    <?= $form->field($model, 'customer_last_name') ?>

    <?= $form->field($model, 'customer_address1') ?>

    <?= $form->field($model, 'customer_address2') ?>

    <?php // echo $form->field($model, 'customer_email') ?>

    <?php // echo $form->field($model, 'customer_gender') ?>

    <?php // echo $form->field($model, 'customer_from') ?>

    <?php // echo $form->field($model, 'customer_favcolor') ?>

    <?php // echo $form->field($model, 'customer_birthdate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
