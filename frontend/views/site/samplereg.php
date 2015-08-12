<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-lg-5" id ="select" style="visibility: visible">
        
          <select id="userType" >
           <option value="Select" selected="selected">Select</option>
            <option value="Customer">Customer</option>
            <option value="Designer">Designer</option>
            <option value="Investor">Investor</option>
          </select>
          
        </div>
    </div>
    <br/>
    <div class="row" id ="customer-register">
        <div class="col-lg-5">
        <p>Please fill out the following fields to register into NudoStilo:</p>
            <?php $form1 = ActiveForm::begin() ?>
                <?= $form1->field($model, 'user_name') ?>
                <?= $form1->field($model, 'customer_first_name') ?>
                <?= $form1->field($model, 'customer_last_name') ?>
                <?= $form1->field($model, 'customer_email') ?>
                <?= $form1->field($model, 'customer_gender')->radioList(['M'=>'Male','F'=>'Female']) ?>
                <?= $form1->field($model, 'user_password')->passwordInput() ?>
                <?= $form1->field($model, 'confirmPassword')->passwordInput() ?>
                <div class="form-group1">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>

