<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\Session;	
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
$session = new Session;
$session->open();
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
    
<div class="row" id ="customerForm" style="visibility: hidden">
 <div class="col-lg-11">
   <?php $form = ActiveForm::begin([
        'id' => $customerLoginModel->formName(),
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "\n<div class=\"col-lg-2\">{label}</div>\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label']], 
       'action' => Url::to(['site/customerregister'])
  ]); ?>
	 <?= $form->field($customerLoginModel, 'customer_first_name')->textInput(['value' => $session['fname']]);?>
	 <?= $form->field($customerLoginModel, 'customer_last_name')->textInput(['value' => $session['lname']]);?>
	 <?= $form->field($customerLoginModel, 'customer_email')->textInput(['value' => $session['email']]) ?>
	 <?= $form->field($customerLoginModel, 'customer_gender')->radioList(array('M'=>'Male','F'=>'Female')); ?>
	 <?= $form->field($customerLoginModel, 'customer_birthdate') ?>
	 <?= $form->field($customerLoginModel, 'customer_user_name')->textInput(['value' => $session['email']]);?>
     <?= $form->field($customerLoginModel, 'user_password')->passwordInput(); ?>
     <?= $form->field($customerLoginModel, 'confirmPassword')->passwordInput(); ?>
     <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
     <?php ActiveForm::end(); ?>

 </div>
</div>
    
</div>

<?php

$script = <<< JS

$('#userType').change(function(){
var selctedUserOption = $('#userType :selected').text();
if (selctedUserOption == "Customer") selectedCustomer();
if (selctedUserOption == "Designer") selectedDesigner();
if (selctedUserOption == "Investor") selectedInvestor();
});
function selectedCustomer(){
$('#userType').attr('style','visibility: hidden');
$('#customerForm').attr('style','visibility: visible');
}
function selectedDesigner(){
$('#userType').attr('style','visibility: hidden');
}
function selectedInvestor(){
$('#userType').attr('style','visibility: hidden');
}
$('form#{$customerLoginModel->formName()}').on('beforeSubmit',function(){

var \$form = $(this);
$.post(
\$form.attr("action"),
\$form.serialize()).done(function(result){
if (result == 1){
$(\$form).trigger("reset");
$('#textIntend').html("Post Created");
          }
});
return false;
});

JS;

$this->registerJs($script);
?>