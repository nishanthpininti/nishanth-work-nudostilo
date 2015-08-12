<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Investor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'investor_user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investor_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investor_last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investor_address1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investor_address2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investor_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investor_gender')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
