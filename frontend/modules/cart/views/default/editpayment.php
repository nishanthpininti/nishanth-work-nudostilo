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
       <h3>Credit Card Information</h3>
            <div class="col-md-12 well text-left">
           
            <div class="row">
            <div class="col-sm-4">
               <label class="control-label">
            creditcard Account Number</label> 
            </div>
            <div class="col-sm-4">
            <p class="text-center">
            <label class="control-label" class="text-center">
           Creditcard Expire Date</label>
            </p>
            </div>
             <div class="col-sm-4">
             
            </div>
            </div>
            
            <?php 
         // session_start();
         
            foreach($model as $mod)
              {?>
                    
              <div class="row" id="row-<?php echo $mod->billing_id?>">
               <div class="col-sm-4">
                
                    <p id="card-<?php echo $mod->billing_id?>">&nbsp<?php echo $mod->creditcard_no ?>
                    
                    </div>
                    
                    <div class="col-sm-4">
                    <p class="text-center" id="exp-<?php echo $mod->billing_id?>"> <?php echo $mod->creditcard_expdate?></p>
                    </div>
                    <div class="col-sm-4">
                    <p class="text-right"><button data-payment="<?php echo $mod->billing_id?>" type="button" class='btn btn-default deletePayment'>delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "<?php echo $mod->billing_id?>">edit</button></p>
                    </div>
               
               </div>
             
            
        <?php     } ?>
        <div class="row" id = 'newedit-credit'>

        </div>
        
       <br>
        <div class="row">
        
          <div class="clo-md-4">
          <p class="text-right"><button type="button" class='btn btn-warning' name="address" id="credit11" data-toggle="modal" data-target="#editcardModal">Enter New credit Info</button></p>
          </div>

        
        </div>
  
   
            </div>
        </div>
        
   	 <div class="modal fade" id="editcardModal" role="dialog">
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

   $form1 = ActiveForm::begin(['id' => $model2->formName(),
  		'action'=>'index.php?r=cart/default/card'
  		
  ]) ?>
                
                <?= $form1->field($model2, 'name_on_card')?>
                <?= $form1->field($model2, 'creditcard_no')?>
                <?= $form1->field($model2, 'billing_address')?>
                
                <?= $form1->field($model2, 'creditcard_expdate')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd'])?>
               
                
                <div class="form-group1">
                    <?= Html::submitButton('Add new card', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
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
$('.deletePayment').click(function()
		{
		alert('delete');
		var id = $(this).attr('data-payment');
		$('#row-'+id).remove();
		var data1 = "id="+id;
		$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/removecard",
    data: data1 ,
    success: function(result) {
       
            	
    }
		
		});
		});
		
		$('.editPayment').click(function()
		{
		$('#editModal').remove();
		alert('edit');
		var id = $(this).attr('data-pay');
		//$('#row-'+id).remove();
		var data1 = "id="+id;
		$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/editcard",
    data: data1 ,
    success: function(result) {
       
            //alert(result);	
		    $('.space-for-credit-modal').append(result);
		     $('#editModal').modal('show');
		
		
		    		$('#activePayment').on('beforeSubmit',function(e)
{	
		e.preventDefault();
e.stopImmediatePropagation();
            alert('hi');		
$("#editModal").modal("hide");

//alert('enter model form');
var \$form = $(this);
alert(\$form.attr("action"));
$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
        var arr = result.split('_');
		document.getElementById('card-'+arr[0]).innerHTML = arr[1];
		document.getElementById('exp-'+arr[0]).innerHTML = arr[2];    		    
                        
            		
});
		return false;
});
		
		   
		
		
    }
		
		}); 
		});
		
$('form#{$model2->formName()}').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
$("#editcardModal").modal("hide");
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
            		    
                        var dataArray = result.split('_');
            		var HtmlString ='<div class="col-sm-4"><p id="card-'+dataArray[0]+'">&nbsp'+dataArray[1]+'</p></div><div class="col-sm-4"><p class="text-center" id="exp-'+dataArray[0]+'">'+dataArray[3]+'</p></div><div class="col-sm-4"><p class="text-right"><button data-payment="'+dataArray[0]+'" type="button" class="btn btn-default deletePayment">delete</button>&nbsp&nbsp<button type="button" class="btn btn-default editPayment" data-pay = "'+dataArray[0]+'">edit</button></p></div>';
            		$('#newedit-credit').append(HtmlString);
                    		
                    		
                    		//commenting
                    		
                    		$('.deletePayment').click(function()
		{
		alert('delete');
		var id = $(this).attr('data-payment');
		$('#row-'+id).remove();
		var data1 = "id="+id;
		$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/removecard",
    data: data1 ,
    success: function(result) {
       
            	
    }
		
		});
		});
		
		$('.editPayment').click(function()
		{
		$('#activePayment').remove();
		alert('edit');
		var id = $(this).attr('data-pay');
		//$('#row-'+id).remove();
		var data1 = "id="+id;
		$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/editcard",
    data: data1 ,
    success: function(result) {
       
            //alert(result);	
		    $('.space-for-credit-modal').append(result);
		     $('#editModal').modal('show');
		
		
		    		$('#activePayment').on('beforeSubmit',function(e)
{	
		e.preventDefault();
e.stopImmediatePropagation();
            alert('hi');		
$("#editModal").modal("hide");

//alert('enter model form');
var \$form = $(this);
alert(\$form.attr("action"));
$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		alert(result);
        var arr = result.split('_');
		document.getElementById('card-'+arr[0]).innerHTML = arr[1];
		document.getElementById('exp-'+arr[0]).innerHTML = arr[2];    		    
                        
            		
});
		return false;
});
		
		   
		
		
    }
		
		}); 
		});
                    		
                    		//commenting
            		
});
		return false;
});
            		



JS;
$this->registerJs($script);
?>