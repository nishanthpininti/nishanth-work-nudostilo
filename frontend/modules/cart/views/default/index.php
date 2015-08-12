
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
//use Yii;

 ?>

<div class="container">	

	<form action="index.php?r=/cart/default/cart" method="post" id="cartdivision"> 
	<h1> Checkout Page</h1>
	
	<h3>shipping Address</h3>
	<div class="row">
	<div class="col-lg-8">
    <div class="row setup-content" id="addrDivision">
        <div class="col-xs-12">
            <div class="col-md-12 well text-left">
                <div class="row">
            <div class="col-lg-4">
                <h3><?php echo $cust->customer_user_name?></h3>

                <p><?php echo $cust->customer_address1;
                
                
                ?></p>
           <label class="btn btn-warning">
           
      <input type="checkbox" name="address" id="check1" value="<?=$cust->customer_address1 ?>" checked>&nbspship to new address
    </label>
              
            </div>
             <div class="col-lg-4">
                <h3><?php echo $cust->customer_user_name?></h3>

                <p><?php echo $cust->customer_address2?></p>

                 <label class="btn btn-warning">
      <input type="checkbox" name="address" id="check2" value="<?=$cust->customer_address2 ?>">&nbspship to new address
    </label>
            </div>
             <div class="col-lg-4 well text-center">
                <label class="btn btn-warning">
      <input type="checkbox" name="address" id="address11" data-toggle="modal" data-target="#myModal">&nbspship to new address
    </label>
      
                  
      
      <!-- Modal content-->

            
            </div>
                
            </div>
        </div>
    </div>
    </div>
    <div class="row setup-content" id="subAddr">
    
        <div class="col-xs-12">
            <div class="col-md-12 well text-left">
            <div class="row" id="stepAddr">
            
            </div>
            
            </div>
            </div>
            </div>
            
    <h3>Payment Method</h3>
    <div class="row setup-content" id="paymentDivision">
    
        <div class="col-xs-12">
            <div class="col-md-12 well text-left">
           
            <div class="row">
            <div class="col-sm-4">
               <label class="control-label">
            creditcard information</label> 
            </div>
            <div class="col-sm-4">
            <p class="text-center">
            <label class="control-label" class="text-center">
            Name on card</label>
            </p>
            </div>
             <div class="col-sm-4">
             <p class="text-right">
            <label class="control-label">
            credit card expdate</label>
            </p>
            </div>
            </div>
            <input type="hidden" name="total-price" value='<?php echo $totalPrice?>'>
            <?php 
         // session_start();
          $_SESSION['quantity'] = $quantity;
            foreach($model as $mod)
              {?>
                    
              <div class="row">
               <div class="col-sm-4">
                
                    <input id="radCredit" name="billingInfo" value="<?= $mod->billing_id?>" type="radio" checked>&nbsp<?php echo $mod->creditcard_no ?>
                    
                    </div>
                    <div class="col-sm-4">
                    <p class="text-center"> <?php echo $mod->customer_usr_name?></p>
                    </div>
                    <div class="col-sm-4">
                    <p class="text-right"> <?php echo $mod->creditcard_expdate?></p>
                    </div>
               
               </div>
             
            
        <?php     } ?>
        <div class="row" id = 'new-credit'>

        </div>
        
       <br>
        <div class="row">
        <div class="col-md-2">
          <button type="button" class="btn btn-warning" id="creditSubmit">Submit Credit Info</button>
          </div>
          <div class="clo-md-4">
          <p class="text-right"><button type="button" class='btn btn-warning' name="address" id="credit11" data-toggle="modal" data-target="#crModal">Enter New credit Info</button></p>
          </div>

        
        </div>
  
   
            </div>
        </div>
    </div>
    <div class="row setup-content" id="paymentAtt">
    
        <div class="col-xs-12">
            <div class="col-md-12 well text-left">
          <div class="row">
            <div class="col-sm-3">
               <label class="control-label">
            creditcard information</label> 
            </div>
            <div class="col-sm-3">
            <p class="text-center">
            <label class="control-label" class="text-center">
            Name on card</label>
            </p>
            </div>
             <div class="col-sm-3">
             <p class="text-center">
            <label class="control-label">
            credit card expdate</label>
            </p>
            </div>
            </div>
            <div class="row" id="paymentRow">
            
            </div>
            </div>
            </div>
            </div>
           
            
    <h3>Items and shipping</h3>
    <div class="row setup-content" id="step-3">
        <div class="col-md-12">
            <div class="col-md-12 well text-left">
            <div class="col-md-8">
            <div class="row">
            <div class="col-md-8">
            <h4><b>Item Name</b></h4>
            </div>

            </div>
           <?php
            
             foreach($item_details as $idetails)
            { ?>
        <div class="row">
         <div class="col-md-2">
            <img src='<?=$idetails->item_photo_front ?>'  style="width:80px;height:80px;">
            </div>
            <div class="col-md-4">
         <a href="#"> <p><b>  <?php 
            echo $items[$idetails->idetails_id]->item_name; ?></b></p></a>
            <p><b>Price:</b>&nbsp$<?php echo $idetails->item_price; ?></p>
            <p><b>Quantity:&nbsp<?php echo $quantity[$idetails->idetails_id]; ?></b>
            </div>
           
             
            
            </div>
            <br>
<?php }?>
</br>

            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success" id="finalsubmit">Place Your Order</button>
                </div>
                <div class="col-md-4">
                <a href="index.php?r=/cart/default/payex"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Check out with PayPal" /></a>
                </div>
               
                </div>
                <div class="row">
                 <div class="col-md-6">
                <h4><label>Order Total:&nbsp&nbsp<?php echo '$'.$totalPrice?></label></h4>
                </div> 
                </div>
                </div>
                <div class="col-md-4">
                <br>
                <br>
                <div class="row">
                <h4>Chooose your Delivery Options</h4>
                </div>
                <div class="row">
                <input type="radio" name="shipping" value="1" checked>&nbsp<b>One-day Shipping</b>
                <br>
                <input type="radio" name="shipping" value="2">&nbsp<b>Two-day Shipping</b>
                <br>
                <input type="radio" name="shipping" value="5">&nbsp<b>Free Standard Shipping</b>
                </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
<div class="col-md-4">

<div class="row setup-content" style="position : fixed">
 <div class="col-md-12">
            <div class="col-md-12 well text-left">
               <label class="control-label">
            Order Summary</label> 
            <label>Items:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$<?= floatval($totalPrice)?></label>
            <label>Shipping & Summary:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$00.00</label>
            <label>Total Before Tax:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$00.00</label>
            <label>Estimated Tax:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$00.00</label>
            <br>
            <h5><label>Total Price:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo '$'.$totalPrice?></label></h5>
            </div>
        </div>
</div>


</div>
</div>
</form>
      <div class="modal fade" id="crModal" role="dialog">
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
$session['customer_name'] = $cust->customer_user_name; 

   $form1 = ActiveForm::begin(['id' => $model1->formName(),
  		'action'=>'index.php?r=/cart/default/card'
  		
  ]) ?>
                
                <?= $form1->field($model1, 'name_on_card')?>
                <?= $form1->field($model1, 'creditcard_no')?>
                <?= $form1->field($model1, 'billing_address')?>
                
                <?= $form1->field($model1, 'creditcard_expdate')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd'])?>
               
                
                <div class="form-group1">
                    <?= Html::submitButton('Add new card', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
      
   
      
            </div>
            </div> 	
            
            
               <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
            <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Address</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
 <?php  $form1 = ActiveForm::begin(['id' => $address->formName(),
  		'action'=>'index.php?r=cart/default/cartnewaddress'
  		
  ]) ?>
                
                <?= $form1->field($address, 'customer_full_name')?>
                <?= $form1->field($address, 'Address_line_1')?>
                <?= $form1->field($address, 'Address_line_2')?>
                <?= $form1->field($address, 'city')?>
                <?= $form1->field($address, 'state')->dropDownList(['Arizona' => 'Arizona','Alabama' => 'Alabama','Arkansas' => 'Arkansas','Baltimore' => 'Baltimore','California' => 'California','Florida' => 'Florida','Minnesota' => 'Minnesota','New York' => 'New York','New Jersey' => 'New Jersey','New Mexico' => 'New Mexico','North Carolina' => 'North Carolina','South Carolina','Texas' => 'Texas','Utah' => 'Utah','Washington' => 'Washington'])?>
                <?= $form1->field($address, 'zip')?>
                <?= $form1->field($address, 'country')->textInput(['readonly' => true,'value' => 'United States']); ?>
                <?= $form1->field($address, 'phone_number')?>
                
               
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
$(document).ready(function() {
$('#subAddr').hide();
$('#paymentAtt').hide();
$('#creditSubmit').click(function()
{

$('#paymentDivision').hide();

id = $('input[name=billingInfo]:checked').val();

//alert(id);
var data1 = 'id='+id;
$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/tempcard",
    data: data1 ,
    success: function(result) {
       var dataArray = result.split('_');
       if (document.getElementById("creditRow"))
       {
       document.getElementById("creditRow").remove();
       }
            		var HtmlString ='<div class="row" id="creditRow"><div class="col-sm-3">&nbsp'+dataArray[0]+'</div><div class="col-sm-3"><p class="text-center">'+dataArray[1]+' </p></div><div class="col-sm-3"><p class="text-center">'+dataArray[2]+' </p></div><div class="col-sm-3"><p class="text-right"><button type="button" class="btn btn-warning" id="changeCredit">Change Credit Card</button></p></div></div>';
            		$('#paymentRow').append(HtmlString);
            			$('#paymentAtt').show();
            		$('#changeCredit').click(function(){
            		$('#paymentAtt').hide();
            		$('#paymentDivision').show();
            	

});
            	
    }
  });

				return false;
				
});



});


$(function() { 
  $('input[type="checkbox"]').bind('click',function() {
   $('input[type="checkbox"]').not(this).prop("checked", false);
  }); 
	//	$('input[type="radio"]').on('change', function() {
 //  $('input[type="radio"]').not(this).prop('checked', false);
//});
		
		$('#addrSubmitButton').click(function(){
		// $("input[name='address11']").val($('#address').val());
		$('#address11').val($('#address').val());
		// alert($('#address11').val());
        });
        
        
		});
		
		
		$('#check1').click(function() {
		
		 if ($(this).prop('checked')) {
               
           $('#addrDivision').hide();
           //alert($('#check1').val());
           var HtmlString ='<div id="add"><div class="col-sm-8">'+$('#check1').val()+'</div><div class="col-sm-4"><button type="button" class="btn btn-warning" id="changeAddr" onclick = "clickFunc()">change Address</button></div></div>';
           $('#stepAddr').append(HtmlString);
           $('#subAddr').show();
        }
		});
		$('#check2').click(function() {
		
		 if ($(this).prop('checked')) {
               
           $('#addrDivision').hide();
           //alert($('#check1').val());
           var HtmlString ='<div id="add"><div class="col-sm-8">'+$('#check2').val()+'</div><div class="col-sm-4"><button type="button" class="btn btn-warning" id="changeAddr" onclick = "clickFunc()">change Address</button></div></div>';
           $('#stepAddr').append(HtmlString);
           $('#subAddr').show();
        }
		});
		$('#addrSubmitButton').click(function() {
		
		// if ($(this).prop('checked')) {
               
           $('#addrDivision').hide();
           //alert($('#check1').val());
           var HtmlString ='<div id="add"><div class="col-sm-8">'+$('#address11').val()+'</div><div class="col-sm-4"><button type="button" class="btn btn-warning" id="changeAddr" onclick = "clickFunc()">change Address</button></div></div>';
           $('#stepAddr').append(HtmlString);
           $('#subAddr').show();
       // }
		});
		
		window.clickFunc  = function() {
		//e.preventDefault();
		//e.stopImmediatePropagation();
		$('#subAddr').hide();
		document.getElementById("add").remove();
		$('#addrDivision').show();
		
		return false;
		};
	
		
				$('form#{$address->formName()}').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
alert('hi');
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
            		    
                        //var dataArray = result.split('_');
                        
                        $('#address11').val(result);
                        
            		//var HtmlString ='<div class="col-sm-4"><input name="billingInfo" value="'+dataArray[0]+'" type="radio">&nbsp'+dataArray[1]+'</div><div class="col-sm-4"><p class="text-center">'+dataArray[2]+' </p></div><div class="col-sm-4"><p class="text-right">'+dataArray[3]+'</p></div>';
            		
            		
});
		return false;
});


		
		
		$('form#{$model1->formName()}').on('beforeSubmit',function(e)
{	
            		//$("#addrDivision").children().prop('disabled',true);
            		
$("#crModal").modal("hide");
e.preventDefault();
e.stopImmediatePropagation();
//alert('enter model form');
var \$form = $(this);

$.post(
\$form.attr("action"),
		\$form.serialize()
		)
.done(function(result) {
		//alert(result);
            		    
                        var dataArray = result.split('_');
            		var HtmlString ='<div class="col-sm-4"><input name="billingInfo" value="'+dataArray[0]+'" type="radio">&nbsp'+dataArray[1]+'</div><div class="col-sm-4"><p class="text-center">'+dataArray[2]+' </p></div><div class="col-sm-4"><p class="text-right">'+dataArray[3]+'</p></div>';
            		$('#new-credit').append(HtmlString);
            		
});
		return false;
});

            		(function() {
    $('form > input').keyup(function() {

        var empty = false;
        $('form > input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#finalsubmit').attr('disabled', 'disabled'); 
        } else {
            $('#finalsubmit').removeAttr('disabled'); 
        }
    });
})();

JS;
$this->registerJs($script);
?>
