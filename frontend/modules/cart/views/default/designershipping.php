<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;


 ?>

<div class="container">	

	
	
	
	<h3>Designer Shipping :	</h3>
	<div class="row">
	<div class="col-lg-12">
    <div class="row setup-content" id="addrDivision">
        <div class="col-xs-12">
<!--       start -->
        

    <ul class="nav nav-tabs">

        <li class="active"><a data-toggle="tab" href="#sectionA">Pending</a></li>

        <li><a data-toggle="tab" href="#sectionB">Shipped</a></li>

       

    </ul>

   

      


        
        
        <div class="tab-content">

        <div id="sectionA" class="tab-pane fade in active">
        
            <div class="col-md-12 well text-left" id="main-row-pending">
            

    

            
            <div class="row">
            <div class="col-md-2">
            <p><b>Item</b></p>
            </div>
            <div class="col-md-1">
            <p><b>Price</b></p>
            </div>
             <div class="col-md-1">
            <p><b>Quantity</b></p>
            </div>
            <div class="col-md-2">
            <p><b>Track Number</b></p>
            </div>
            <div class="col-md-2">
            <p><b>status</b>
            </div>
             <div class="col-md-2">
            <p><b>Ordered Date</b>
            </div>
            <div class="col-md-1">
            <p><b>Delivery Name</b>
            </div>
            
            
            </div>
            <?php foreach($orders1 as $order)
            {?>
                <div class="row" id="row-<?php echo $order->order_id?>-<?php echo $order->idetails_id?>">
                <div class="col-md-2">
                 <img src='<?=$items1[$order->idetails_id]->item_photo_front ?>'  style="width:80px;height:80px;">
                <p><a href="#"><?php echo $itemName1[$order->idetails_id]->item_name; ?></a></p>
                </div>
                 <div class="col-md-1">
                <p>$<?php echo $items1[$order->idetails_id]->item_price ?></p>
                </div>
                 <div class="col-md-1">	
                <p><?php echo $order->quantity ?></p>
                </div>
                <div class="col-md-2">
                <p><input type="text" id="text-<?php echo $order->order_id?>-<?php echo $order->idetails_id?>"></p>
                </div>
                 <div class="col-md-2">
                <p id="p-<?php echo $order->order_id?>-<?php echo $order->idetails_id?>"><?php echo $order->order_status ?></p>
                </div>
                 <div class="col-md-2">
                <p><?php echo $orderid1[$order->order_id]->order_date ?></p>
                </div>
                                 <div class="col-md-1">
   <select class="selectpicker" id="select-<?php echo $order->order_id?>-<?php echo $order->idetails_id?>" data-style="btn-primary" >
      <option>FedEx</option>
      <option>UPS</option>
      <option>DHL</option>
  </select>
                </div>
                <div class="col-md-1">
                
           
                <p><button class="btn btn-warning shippingclass" data-arr= "button-<?php echo $order->order_id?>-<?php echo $order->idetails_id?>" id="shippingButton">ship</button></p>
                 
                </div>
                
               
                </div>
                <hr>
                <?php }?>
                </div>
                
                </div>
                

        <div id="sectionB" class="tab-pane fade	">
                <div class="col-md-12 well text-left" id="main-row-pending">
            

    

            
            <div class="row">
            <div class="col-md-2">
            <p><b>Item</b></p>
            </div>
            <div class="col-md-1">
            <p><b>Price</b></p>
            </div>
             <div class="col-md-1">
            <p><b>Quantity</b></p>
            </div>
            <div class="col-md-2">
            <p><b>Track Number</b></p>
            </div>
            <div class="col-md-2">
            <p><b>status</b>
            </div>
             <div class="col-md-2">
            <p><b>Ordered Date</b>
            </div>
            <div class="col-md-1">
            <p><b>Delivery Name</b>
            </div>
            
            
            </div>
            <?php foreach($orders2 as $order)
            {?>
                <div class="row" id="row-<?php echo $order->order_id?>-<?php echo $order->idetails_id?>">
                <div class="col-md-2">
                 <img src='<?=$items2[$order->idetails_id]->item_photo_front ?>'  style="width:80px;height:80px;">
                <p><a href="#"><?php echo $itemName2[$order->idetails_id]->item_name; ?></a></p>
                </div>
                 <div class="col-md-1">
                <p>$<?php echo $items2[$order->idetails_id]->item_price ?></p>
                </div>
                 <div class="col-md-1">	
                <p><?php echo $order->quantity ?></p>
                </div>
                <div class="col-md-2">
                 <p><?php echo $order->tracking_number ?></p>
                </div>
                 <div class="col-md-2">
                <p id="p-<?php echo $order->order_id?>-<?php echo $order->idetails_id?>"><?php echo $order->order_status ?></p>
                </div>
                 <div class="col-md-2">
                <p><?php echo $orderid2[$order->order_id]->order_date ?></p>
                </div>
                                 <div class="col-md-1">
                 <p><?php echo $order->delivery_name ?></p>
                </div>
                <div class="col-md-1">
                
           
                
                 
                </div>
                
               
                </div>
                <hr>
                <?php }?>
                </div>
                
                </div>
                </div>
                
                </div>
                </div>
                </div>
                </div>
              
                </div>
         
<?php
$script = <<< JS

$(document).ready(function(){

    $("#myTab").click(function(e){

        e.preventDefault();

        $(this).tab('show');

    });

});
  window.onload=function(){
      $('.selectpicker').select2();
		};
		
		$('.shippingclass').click(function(e)
		{
		//alert($(this).attr('data-arr'));
		var dataArray = $(this).attr('data-arr').split('-');
		//alert(dataArray);
		//alert('#select-'+dataArray[1]+'-'+dataArray[2]);
		var delivery_name = $('#select-'+dataArray[1]+'-'+dataArray[2]).val();
		var tracking_name = $('#text-'+dataArray[1]+'-'+dataArray[2]).val();
		var order_id = dataArray[1];
		var idetails_id = dataArray[2];
		
		var data1 = 'delivery_name='+delivery_name+'&order_id='+order_id+'&idetails_id='+idetails_id+'&tracking_name='+tracking_name;
$.ajax({
    type: "POST",
    url: "index.php?r=/cart/default/shippingorder",
    data: data1 ,
    success: function(result) {
       alert(result);
		var arr = result.split('-');
		document.getElementById('p-'+arr[1]+'-'+arr[2]).innerHTML = 'shipped';
		$('#row-'+arr[1]+'-'+arr[2]).remove();
		
		}
		
		});
		});
		
		
		
		
		
		

JS;
$this->registerJs($script);
?>

            
            
                

           
                
                
                