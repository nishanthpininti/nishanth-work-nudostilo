<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Styles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="styles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'style_id')->textInput() ?>

    <?= $form->field($model, 'item_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
