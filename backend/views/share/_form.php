<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Share */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="share-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'share_id')->textInput() ?>

    <?= $form->field($model, 'customer_user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'style_id')->textInput() ?>

    <?= $form->field($model, 'scope')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_stamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
