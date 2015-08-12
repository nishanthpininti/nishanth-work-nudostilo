<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Designer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="designer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'designer_user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_address1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_address2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_favcolor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designer_birthdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
