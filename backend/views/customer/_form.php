<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_address1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_address2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_favcolor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_birthdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
