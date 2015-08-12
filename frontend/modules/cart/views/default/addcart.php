<?php
?>
<br>
<br>
<div class="container">	

	<form action="index.php?r=/cart/default/index" method="post" id="addcartdivision"> 
<div class="row setup-content" id="step-1">
        <div class="col-xs-8">
            <div class="col-md-12 well text-left">
            <div class="row">
            <div class="col-md-6">
            <h4>Item</h4>
            </div>
             <div class="col-md-2">
            <h4>quantity</h4>
            </div>
            <div class="col-md-4">
            <h4>price</h4>
            </div>
            </div>
            <?php 
          
           session_start();
           $_SESSION['item_details'] = $items_details;
           $_SESSION['items'] = $itemName;
            ?>
            
          
            <?php 
            $totalPrice = 0.00;
            
           foreach($items_details as $idetails)
            { 
            $totalPrice = $totalPrice + $idetails->item_price;
            
            	
            	?>
             <div class="row" id="row-<?= $idetails->idetails_id ?>">
            <div class="col-lg-2">
            <img src='<?=$idetails->item_photo_front ?>'  style="width:80px;height:80px;">
            </div>
            <div class="col-lg-3">
           
            <a href="#"><p id='item-name-<?= $idetails->idetails_id ?>'><b><?php echo $itemName[$idetails->idetails_id]->item_name?></b></p></a>
            <p><b>Designer:</b>&nbsp<?php echo $itemName[$idetails->idetails_id]->item_designer_id;?></p>
            <a id="anchorDelete" href="#" data-delete='<?= $idetails->idetails_id ?>'>Delete</a>
            </div>
           <div class="col-lg-1"></div>
            <div class="col-lg-2">
            
            <br>
            <input id ="quantity-text-field-<?=$idetails->idetails_id ?>"  name="quantity-text-field-<?=$idetails->idetails_id ?>" type="text"  class='quantity-item-text-field' placeholder="1" style="width: 30px;" onkeypress="return isNumber(event)" maxlength="3" onblur="quantFunc()"/>
            </div>
            <div class="col-lg-4">
            
            <br>
            <p id='item-price-<?= $idetails->idetails_id ?>' data-eachprice='<?=$idetails->item_price ?>' data-finalprice='<?=$idetails->item_price?>'>$<?php 
            echo $idetails->item_price;
            	?>
            	</p>
       
            </div>
            </div>
            <hr>
            
            <?php }
            $total = floatval($totalPrice);?>
            <br>
            <input type="hidden" name="totalPrice" value="<?=$total?>">
            <div class="row">
            <div class="col-lg-8">
            <input type="submit" class="btn btn-warning" value="Proceed to Checkout">
            
            </div>
            <div class="col-lg-4">
            <h4><label>Total Price:&nbsp&nbsp<p  data-totalprice=<?php echo $totalPrice?>   id="totalp"><?php echo '$'.$totalPrice?></p></label></h4>
            <input type="hidden" id="finalprice" name="total-price" value='<?php echo $totalPrice?>'>
            </div>
            
            </div>
            </div>
            </div>
            </div>
            </form>
            </div>
            
          <?php 

$script = <<< JS
window.quantFunc = function() {
		 
		var totalPrice = 0;
        
		$( ".quantity-item-text-field" ).each(function( index ) {
                  var idArray = $(this).attr('id').split('-');
		          
		          var currentQty = $('#quantity-text-field-'+idArray[3]).val();
		
		          if(currentQty == '')
		             currentQty =1;
		          
		          var currentPrice = $('#item-price-'+idArray[3]).attr('data-eachprice');
		
		          totalPrice += currentQty*currentPrice;
		
		
		          
             });
		
		$('#totalp').html('$'+totalPrice);
		
		$('input[name=total-price]').val(totalPrice);
		alert($('input[name=total-price]').val());
		
		}
		$(document).ready(function()
		{
	
		});
		
		$('#anchorDelete').click(function()
		{
		$
		var idetails_id = $(this).attr('data-delete');
		var data1 = "id="+idetails_id;
		var idArray = $(".quantity-item-text-field").attr('id').split('-');
		var currentQty = $('#quantity-text-field-'+idArray[3]).val();
		var totalPrice = $('input[name=total-price]').val();
		//alert('great'+currentQty);
		          if(currentQty == '')
		             currentQty =1;
		          
		          var currentPrice = $('#item-price-'+idArray[3]).attr('data-eachprice');
		
		          totalPrice = totalPrice - currentQty*currentPrice;
		
		$('#totalp').html('$'+totalPrice);
		
		$('input[name=total-price]').val(totalPrice);
		
		//alert(idArray);
		$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/deletecart",
    data: data1 ,
    success: function(result) {
		$('#row-'+idetails_id).remove();
		
    alert('success');
		}
		});
		
		});
 window.isNumber = function(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
};
		
	

JS;
$this->registerJs($script);
?>