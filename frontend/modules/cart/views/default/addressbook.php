<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
?>
<div class="container">	

<div class='space-for-credit-modal'>
</div>

	
<div class="row setup-content" id="step-1">
       <div class="col-xs-8 col-md-offset-1" >
       <h3>Change Address Settings</h3>
            <div class="col-md-12 well text-left">
           
            <div class="row" id="row-addr1">
            <div class="col-md-2">
            <p>1.</p>
            </div>
            <div class="col-md-4">
            <h4><?php echo $model1->customer_user_name?></h4>
            <p id="addr-1"><?php echo $model1->customer_address1?></p>
            <p>phno:&nbsp<?php echo $model1->customer_ph_number?></p>
            <p><button class="btn btn-default" data-toggle="modal" data-target="#editaddress1Modal" >Edit</button>&nbsp<button class="btn btn-default" data-addr="<?php echo $model1->customer_address1?>" id="deleteButton1">Delete</button></p>
            </div>
            </div>
            <br>
            <hr>
            
            <div class="row" id="row-addr2">
            <div class="col-md-2">
            <p>2.</p>
            </div>
            <div class="col-md-4">
            <h4><?php echo $model1->customer_user_name?></h4>
            <p id="addr-2"><?php echo $model1->customer_address2?></p>
            <p>phno:&nbsp<?php echo $model1->customer_ph_number?></p>
            <p><button class="btn btn-default" data-toggle="modal" data-target="#editaddress2Modal" >Edit</button>&nbsp<button id="deleteButton2" class="btn btn-default" data-addr="<?php echo $model1->customer_address2?>">Delete</button></p>
            </div>
            </div>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-4">
            <button class="btn btn-warning" data-toggle="modal" data-target="#newaddressModal">Enter New Address</button>
            </div>
            </div>
            
            	 <div class="modal fade" id="newaddressModal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Address</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >New Address</label>
  
  <?php 
  $session = Yii::$app->session;
  $session->open();
  $session['customer_name'] = 'greg chappel';

   $form1 = ActiveForm::begin(['id' => 'editPhone',
  		'action'=>'index.php?r=cart/default/addnewaddress'
  		
  ]) ?>
                
                <?= $form1->field($model2, 'customer_full_name')?>
                <?= $form1->field($model2, 'Address_line_1')?>
                <?= $form1->field($model2, 'Address_line_2')?>
                <?= $form1->field($model2, 'city')?>
                <?= $form1->field($model2, 'state')?>
                <?= $form1->field($model2, 'zip')?>
                <?= $form1->field($model2, 'country')?>
                <?= $form1->field($model2, 'phone_number')?>
               
               
                <div class="form-group1">
                    <?= Html::submitButton('submit', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
            </div>
            </div> 
            
                      	 <div class="modal fade" id="editaddress1Modal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Address</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >New Address</label>
  
  <?php 
  $session = Yii::$app->session;
  $session->open();
  $session['customer_name'] = 'greg chappel';

   $form1 = ActiveForm::begin(['id' => 'editAddress1',
  		'action'=>'index.php?r=cart/default/editaddress'
  		
  ]) ?>
                
                
                <?= $form1->field($model1, 'customer_address1')?>
              
               
               
                <div class="form-group1">
                    <?= Html::submitButton('submit', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
            </div>
            </div> 
                      	 <div class="modal fade" id="editaddress2Modal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Address</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >New Address</label>
  
  <?php 
  $session = Yii::$app->session;
  $session->open();
  $session['customer_name'] = 'greg chappel';

   $form1 = ActiveForm::begin(['id' => 'addnewaddress',
  		'action'=>'index.php?r=cart/default/editaddress'
  		
  ]) ?>
                
               
                <?= $form1->field($model1, 'customer_address2')?>
                
               
               
                <div class="form-group1">
                    <?= Html::submitButton('submit', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
            </div>
            </div> 
            
            
            </div>
            
            <?php 

$script = <<< JS
$('#editAddress1').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
$("#editnameModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
alert('great');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
            		    
                  document.getElementById('addr-1').innerHTML = result;       
            		//var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		
		});
		return false;
		});
		$('#editAddress2').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
//$("#editnameModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
alert('great');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
            		    
                  document.getElementById('addr-2').innerHTML = result;       
            		//var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		
		});
		return false;
		});
		
		$('#addnewaddress').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
//$("#editnameModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
alert('great');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
            		    
                 // document.getElementById('addr-2').innerHTML = result;       
            		//var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		
		});
		return false;
		});
		
		$('#deleteButton1').click(function(e)
		{ 
		
		$('#row-addr1').remove();
		
		});
		$('#deleteButton2').click(function(e)
		{ 
		
		$('#row-addr2').remove();
		
		});
		
		

JS;
$this->registerJs($script);
?>  