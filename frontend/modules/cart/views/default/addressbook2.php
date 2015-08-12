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
           <?php 
           $count = 0;
           foreach($model as $model1)
           { ?>
            <div class="row" id="row-<?php echo $model1->address_id; ?>">
            <div class="col-md-2">
            <p><?php echo $model1->address_id?>.</p>
            </div>
            <div class="col-md-4">
            <h4><?= $model1->customer_user_name?></h4>
               <p id="p-<?= $model1->address_id;?>"> 
                      <?= $model1->Address_line_1?>&nbsp<?= $model1->Address_line_2?>
                     <br>
                     <?= $model1->city?>&nbsp<?= $model1->state?>-<?= $model1->zip?>
                     <br>
                     phno:&nbsp<?= $model1->phone_number?>
                    
                </p>
                
               <p>
                 <button class="btn btn-default editButton" data-toggle="modal" data-target="#editAddressModal" data-addr = "<?php echo $model1->address_id?>">Edit</button>&nbsp<button class="btn btn-default deleteButton" data-addr="<?php echo $model1->address_id?>" >Delete</button>
               </p>
            </div>
            
            </div>
            
            
            <?php }?>
            <div class="row" id="new">
            </div>
            <br>
            <hr>
            
         
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

   $form1 = ActiveForm::begin(['id' => 'addnewaddress',
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
            
 
            
            
            </div>
            
            <?php 

$script = <<< JS
$('.editButton').click(function(e)
		{
		alert('test');
		var id = $(this).attr('data-addr');
		//alert('great'+id);
		//$('#row-'+id).remove();
		var data1 = "id="+id;
		$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/editaddressbook",
    data: data1 ,
    success: function(result) {
       
            //alert(result);	
		    $('.space-for-credit-modal').append(result);
		     $('#editaddressModal').modal('show');
		
		
		$('#editmodaladdress').on('beforeSubmit',function(e)
{	
            		
            		
$("#editaddressModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
//alert('great');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		//alert(result);
            		   var dataArray =  result.split("*");
		               
                 // document.getElementById('addr-2').innerHTML = result;       
            		var HtmlString ='<p id="c-'+dataArray[0]+'" <p id="addr-1">'+dataArray[2]+'&nbsp '+dataArray[3]+'</p><p>'+dataArray[4]+'&nbsp '+dataArray[5]+'-'+dataArray[6]+'</p><p>phno:&nbsp '+dataArray[7]+'</p></p>';
		           
            		//document.getElementById('p-'+dataArray[0]).innerHTML = HtmlString;
//alert('before'+document.getElementById('p-'+dataArray[0]).innerHTML);
		
		//$('#p-'+dataArray[0]).remove();
		
		//document.getElementById('p-'+dataArray[0]).innerHTML = HtmlString;
		
                    		
                    	
                    		
                    		
		});
		return false;
		});
		
		
		}
		});
		
	
		
		
		});


		
		$('#addnewaddress').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
//$("#newaddressModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
//alert('great');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		
		var dataArray = result.split('*');
            		var HtmlString =    '<div class="col-md-2"><p>'+dataArray[0]+'</p></div><div class="col-md-4"><h4>'+dataArray[1]+'</h4><p id="p-'+dataArray[0]+'"> '+dataArray[2]+'&nbsp'+dataArray[3]+'<br>'+dataArray[4]+'&nbsp'+dataArray[5]+'-'+dataArray[0]+'<br>phno:&nbsp'+dataArray[7]+'</p><p><button class="btn btn-default" data-toggle="modal" data-target="#editAddressModal" data-addr = "'+dataArray[0]+'" id="editButton">Edit</button>&nbsp<button class="btn btn-default" data-addr="'+dataArray[0]+'" id="deleteButton">Delete</button></p></div>';
            		//$('#newedit-credit').append(HtmlString);    
           //alert(HtmlString);
                    		$('#new').append(HtmlString);
                    		
                    		//commenting
		
		$('.deleteButton').click(function(e)
		{ 
		var id = $(this).attr('data-addr');
		alert(id);
		$('#row-'+id).remove();
		
		});
		
		
		$('.editButton').click(function(e)
		{
		alert('test');
		var id = $(this).attr('data-addr');
		//alert('great'+id);
		//$('#row-'+id).remove();
		var data1 = "id="+id;
		$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/editaddressbook",
    data: data1 ,
    success: function(result) {
       
            //alert(result);	
		    $('.space-for-credit-modal').append(result);
		     $('#editaddressModal').modal('show');
		
		
		$('#editmodaladdress').on('beforeSubmit',function(e)
{	
            		
            		
$("#editaddressModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
//alert('great');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		//alert(result);
            		   var dataArray =  result.split("*");
		               
                 // document.getElementById('addr-2').innerHTML = result;       
            		var HtmlString ='<p id="c-'+dataArray[0]+'" <p id="addr-1">'+dataArray[2]+'&nbsp '+dataArray[3]+'</p><p>'+dataArray[4]+'&nbsp '+dataArray[5]+'-'+dataArray[6]+'</p><p>phno:&nbsp '+dataArray[7]+'</p></p>';
		           
            		//document.getElementById('p-'+dataArray[0]).innerHTML = HtmlString;
//alert('before'+document.getElementById('p-'+dataArray[0]).innerHTML);
		
		//$('#p-'+dataArray[0]).remove();
		
		//document.getElementById('p-'+dataArray[0]).innerHTML = HtmlString;
		
                    		
                    	
                    		
                    		
		});
		return false;
		});
		
		
		}
		});
		
	
		
		
		});
		
		
		
		
                    		
                    		
		});
		return false;
		});
		
		$('.deleteButton').click(function(e)
		{ 
		var id = $(this).attr('data-addr');
		alert(id);
		$('#row-'+id).remove();
		
		});
		
		
		

JS;
$this->registerJs($script);
?>  