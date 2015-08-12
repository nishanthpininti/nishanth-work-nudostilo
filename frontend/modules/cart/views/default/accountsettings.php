
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
?>
<br>
<br>

<div class="container">	

<div class='space-for-credit-modal'>
</div>

	
<div class="row setup-content" id="step-1">
       <div class="col-xs-8 col-md-offset-1" >
       <h3>Change Account Settings</h3>
            <div class="col-md-12 well text-left">
           
            <div class="row">
            <div class="col-sm-7">
               <label class="control-label">
            Name:</label> 
            <p id="pname"><?php echo $model2->customer_user_name?></p>
            </div>
            <div class="col-sm-4">
            <p class="text-center">
            <button class="btn btn-default" data-toggle="modal" data-target="#editnameModal">Edit</button>
            </p>
            </div>
             
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-7">
               <label class="control-label">
            Email:</label> 
            <p id="pemail"><?php echo $model2->customer_email?></p>
            </div>
            <div class="col-sm-4">
            <p class="text-center">
            <button class="btn btn-default" data-toggle="modal" data-target="#editemailModal">Edit</button>
            </p>
            </div>
             
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-7">
               <label class="control-label">
            Password:</label> 
            <p id="ppassword"><?php $len = strlen($model1->user_password);
            $temp = '*';
            $ast = '';
            for($i=0;$i<$len-1;$i++)
            { 
            $ast = $ast.$temp;
            }
            echo $ast?></p>
            </div>
            <div class="col-sm-4">
            <p class="text-center">
            <button class="btn btn-default" data-toggle="modal" data-target="#editpasswordModal">Edit</button>
            </p>
            </div>
             
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-7">
               <label class="control-label">
            Phone Number:</label> 
            <p id="pphone"><?php echo $model2->customer_ph_number?></p>
            </div>
            <div class="col-sm-4">
            <p class="text-center">
            <button class="btn btn-default" data-toggle="modal" data-target="#editphModal">Edit</button>
            </p>
            </div>
             
            </div>
            <br>
            <div class="row">
            <div class="col-sm-8">
            </div>
            <div class="col-sm-4">
            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="index.php?r=cart/default/profilesettings"><button class="btn btn-warning">Done</button></a></p>
            </div>
            </div>
            
            </div>
            </div>
            </div>
            
            	 <div class="modal fade" id="editnameModal" role="dialog">
            
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Card Information</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >Enter New Credit card Info</label>
  
  <?php 
  $session = Yii::$app->session;
  $session->open();
  $session['customer_name'] = 'greg chappel';

   $form1 = ActiveForm::begin(['id' => 'editName',
  		'action'=>'index.php?r=cart/default/editname'
  		
  ]) ?>
                
                <?= $form1->field($model2, 'customer_user_name')?>
               
                
                <div class="form-group1">
                    <?= Html::submitButton('submit', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
            </div>
            </div>
            
            
            	 <div class="modal fade" id="editemailModal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Card Information</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >Enter New Credit card Info</label>
  
  <?php 
  $session = Yii::$app->session;
  $session->open();
  $session['customer_name'] = 'greg chappel';

   $form1 = ActiveForm::begin(['id' => 'editEmail',
  		'action'=>'index.php?r=cart/default/editemail'
  		
  ]) ?>
                
                <?= $form1->field($model2, 'customer_email')?>
              
                
                <div class="form-group1">
                    <?= Html::submitButton('submit', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
            </div>
            </div> 	
            
            	 <div class="modal fade" id="editpasswordModal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Password</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >change password</label>
  <form action="index.php?r=cart/default/editpassword" method="post" id="editPassword" role="form"> 
   <div class="form-group">
  <label for="usr">old Password:</label>
  <input type="password" class="form-control" id="oldpwd" name="oldp">
  <p id="oldpara" style="color:red"></p>
</div>
<div class="form-group">
  <label for="pwd">new Password:</label>
  <input type="password" class="form-control" id="newpwd" name="newp">
</div>
<div class="form-group">
  <label for="pwd">retype Password:</label>
  <input type="password" class="form-control" id="retypepwd" name="retp">
  <p id="matchpara" style="color:red"></p>
</div>
  
  <div class="form-group">
   <button type="submit" class="btn btn-warning">submit</button>
   
  </div>
  
  </form>
 
   
</div>
        </div>
      
      </div>
            </div>
            </div> 	
            
            	 <div class="modal fade" id="editphModal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Card Information</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >Enter New Credit card Info</label>
  
  <?php 
  $session = Yii::$app->session;
  $session->open();
  $session['customer_name'] = 'greg chappel';

   $form1 = ActiveForm::begin(['id' => 'editPhone',
  		'action'=>'index.php?r=cart/default/editphone'
  		
  ]) ?>
                
                <?= $form1->field($model2, 'customer_ph_number')?>
               
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
$('#editName').on('beforeSubmit',function(e)
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
            		    
                  document.getElementById('pname').innerHTML = result;       
            		//var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		
		});
		return false;
		});
		
		$('#editEmail').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
$("#editemailModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
//alert('enter model form');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
            		     document.getElementById('pemail').innerHTML = result;
                       // var dataArray = result.split('_');
            		//var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		
		});
		return false;
		});
		
		$('#editPassword').on('submit',function(e)
{	
		//alert('hi');
            		//$("#addrDivision").children().prop('disabled',true);
            		

e.preventDefault();
e.stopImmediatePropagation();
//alert('enter model form');
var \$form = $(this);
		

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
		if(result == "Password Incorrect")
		{
		document.getElementById('oldpara').innerHTML = result;
		}
		else if(result == "Password Mismatch")
		{
		$('#oldpara').remove();
		document.getElementById('matchpara').innerHTML = result;
		}
		else
		{ //alert(result);
		
		$("#editpasswordModal").modal("hide");
         		    }
                      ///  var dataArray = result.split('_');
            		//var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		
		});
		return false;
		});
		
		$('#editPhone').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
$("#editphModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
//alert('enter model form');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
            		    document.getElementById('pphone').innerHTML = result; 
                       // var dataArray = result.split('_');
            		//var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		
		});
		return false;
		});

JS;
$this->registerJs($script);
?>            