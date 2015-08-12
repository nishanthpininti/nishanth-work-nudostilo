<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLogin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-login-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type')->dropDownList([ 'c' => 'C', 'd' => 'D', 'i' => 'I', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'user_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
