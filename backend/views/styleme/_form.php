<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StyleMe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="style-me-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'style_me_id')->textInput() ?>

    <?= $form->field($model, 'customer_user_name1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'style_id')->textInput() ?>

    <?= $form->field($model, 'customer_user_name2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'my_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'friends_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'completion_status')->dropDownList([ 'complete' => 'Complete', 'incomplete' => 'Incomplete', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
