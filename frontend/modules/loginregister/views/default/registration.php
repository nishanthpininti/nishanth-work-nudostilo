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

    <div class="row" id ="customer-register" >
        <div class="col-lg-5">
        <p>Please fill out the following fields to register into NudoStilo:</p>
            <?php $form1 = ActiveForm::begin(['id' => 'form-customer-register','action'=>Url::to(['default/customerregistration'])]) ?>
                
                <?= $form1->field($customerModel, 'customer_user_name')?>
                <?= $form1->field($customerModel, 'customer_first_name')?>
                <?= $form1->field($customerModel, 'customer_last_name')?>
                <?= $form1->field($customerModel, 'customer_email') ?>
                <?= $form1->field($customerModel, 'customer_gender')->radioList(['M'=>'Male','F'=>'Female'])?>
                <?= $form1->field($customerModel, 'customer_birthdate')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd'])?>
                <?= $form1->field($customerModel, 'password')->passwordInput() ?>
                <?= $form1->field($customerModel, 'confirmPassword')->passwordInput() ?>
                <input type=hidden id=custIndcheck value=<?= $chckuser ?> />
                <div class="form-group1">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="row" id ="designer-register">
        <div class="col-lg-5">
        <p>Please fill out the following fields to register into NudoStilo:</p>
            <?php $form2 = ActiveForm::begin(['id' => 'form-designer-register','action'=>Url::to(['default/designerregistration'])]); ?>
              
                <?= $form2->field($designerModel, 'designer_user_name')?>
                <?= $form2->field($designerModel, 'designer_first_name')?>
                <?= $form2->field($designerModel, 'designer_last_name')?>
                <?= $form2->field($designerModel, 'designer_email')?>
                <?= $form2->field($designerModel, 'designer_gender')->radioList(['M'=>'Male','F'=>'Female']) ?>
                <?= $form2->field($designerModel, 'designer_birthdate')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd'])?>
                <?= $form2->field($designerModel, 'password')->passwordInput() ?>
                <?= $form2->field($designerModel, 'confirmPassword')->passwordInput() ?>
                <input type=hidden id=desgIndcheck value=<?= $chckuser ?> />
                <div class="form-group2">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="row" id ="investor-register">
        <div class="col-lg-5">
        <p>Please fill out the following fields to register into NudoStilo:</p>
            <?php $form3 = ActiveForm::begin(['id' => 'form-investor-register','action'=>Url::to(['default/investorregistration'])]); ?>
                <?= $form3->field($investorModel, 'investor_user_name') ?>
                <?= $form3->field($investorModel, 'investor_first_name') ?>
                <?= $form3->field($investorModel, 'investor_last_name')?>
                <?= $form3->field($investorModel, 'investor_email')?>
                <?= $form3->field($investorModel, 'investor_gender')->radioList(['M'=>'Male','F'=>'Female']) ?>
                <?= $form3->field($investorModel, 'password')->passwordInput() ?>
                <?= $form3->field($investorModel, 'confirmPassword')->passwordInput() ?>
                <input type=hidden id=invIndcheck value=<?= $chckuser ?> />
                <div class="form-group2">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
   
</div>


<?php

$script = <<< JS

$(document).ready(function(){

$('#customer-register').hide();
$('#designer-register').hide();
$('#investor-register').hide();
		
if(document.getElementById('custIndcheck').value == 'C'){
$('#customer-register').fadeIn('slow');
$('#designer-register').hide();
$('#investor-register').hide();	
}
		
if(document.getElementById('desgIndcheck').value == 'D'){
$('#customer-register').hide();
$('#designer-register').fadeIn('slow');
$('#investor-register').hide();	
}
		
if(document.getElementById('invIndcheck').value == 'I'){
$('#customer-register').hide();
$('#designer-register').hide();
$('#investor-register').fadeIn('slow');	
}
		
$('#userType').change(function(){
var selctedUserOption = $('#userType :selected').text();
 
if (selctedUserOption == "Customer") selectedCustomer();
if (selctedUserOption == "Designer") selectedDesigner();
if (selctedUserOption == "Investor") selectedInvestor();
});
 

function selectedCustomer(){
$('#customer-register').fadeIn('slow');
		$('#designer-register').hide();
		$('#investor-register').hide();
}
 
function selectedDesigner(){
		$('#customer-register').hide();
		$('#designer-register').fadeIn('slow');
		$('#investor-register').hide();
}
 
function selectedInvestor(){		
$('#customer-register').hide();
$('#designer-register').hide();
$('#investor-register').fadeIn('slow');
}
 

});
JS;

$this->registerJs($script);
?>