
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;

?>
<div class="container">
<h3>Your Orders</h3>
<?php foreach($orders as $order_details)
{?>
<div class="row setup-content" id="step-3">
        <div class="col-md-9">
            <div class="col-md-12 well text-left">
            <div class="col-md-12">
            <div class="row">
            <div class="col-md-4">
            <b>Order Date</b>
           <p> <?php echo $order_details->order_date; ?></p>
            
            </div>
            <div class="col-md-4">
            <b>Total Price</b>
            <p>$<?php echo $order_details->totalprice;?>
            
            </div>
             <div class="col-md-4">
            <b>SHIP TO</b>
            <p>$<?php echo $order_details->shipping_address;?>
            
            </div>
             
            
            </div>
            <div class="row">
            <div class="col-md-8">
            <h4><b>Items</b></h4>
            </div>

            </div>
            
           <?php
            
             foreach($order_all[$order_details->order_id] as $order_d)
            { ?>
        <div class="row">
         <div class="col-md-2">
            <img src='<?=$order_items[$order_details->order_id][$order_d->idetails_id]->item_photo_front ?>'  style="width:80px;height:80px;">
            </div>
            <div class="col-md-4">
         <a href="#"> <p><b>  
           <?php  echo $order_itemName[$order_details->order_id][$order_d->idetails_id]->item_name; ?></b></p></a>
            <p><b>Price:</b>&nbsp$<?php echo $order_items[$order_details->order_id][$order_d->idetails_id]->item_price ?></p>
            <p><b>Quantity:&nbsp<?php echo $order_d->quantity; ?></b>
            </div>
           <div class="col-md-6">
           &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button class="btn btn-warning" type="button">Return or Replace Item</button>
           
           </div>
             
            
            </div>
            <hr>
            
          <?php   } ?>
          </div>
          </div>
          </div>
          </div>
          
 <?php }?>

</div>