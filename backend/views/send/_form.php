<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Send */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="send-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_user_name1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sytle_id')->textInput() ?>

    <?= $form->field($model, 'customer_user_name2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
