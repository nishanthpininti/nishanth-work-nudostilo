<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DesignerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="designer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'designer_user_name') ?>

    <?= $form->field($model, 'designer_first_name') ?>

    <?= $form->field($model, 'designer_last_name') ?>

    <?= $form->field($model, 'designer_address1') ?>

    <?= $form->field($model, 'designer_address2') ?>

    <?php // echo $form->field($model, 'designer_email') ?>

    <?php // echo $form->field($model, 'designer_gender') ?>

    <?php // echo $form->field($model, 'designer_from') ?>

    <?php // echo $form->field($model, 'designer_favcolor') ?>

    <?php // echo $form->field($model, 'designer_birthdate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
