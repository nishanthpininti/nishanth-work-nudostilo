<?php

namespace frontend\modules\cart\controllers;
use Yii;
use yii\web\Controller;
use frontend\modules\cart\models\BillingInfo;
use frontend\modules\cart\models\Customer;
use frontend\modules\cart\models\Item;
use frontend\modules\cart\models\ItemDetails;
use frontend\modules\cart\models\Orders;
//use frontend\modules\cart\models\frontend\modules\cart\models;
use frontend\modules\cart\models\Cart;
use frontend\modules\cart\models\OrderDetails;
use frontend\modules\cart\models\Address;
use frontend\modules\cart\models\frontend\modules\cart\models;
use frontend\modules\cart\models\Designer;
use frontend\modules\cart\models\UserLogin;
use PayPal\Api\CreditCard;
use PayPal\Exception\PaypalConnectionException;
use ak\paypal;
//use common\components\paypal;

class DefaultController extends Controller
{	
	public $enableCsrfValidation = false;
	//public $layout = "checkout.php";
    public function actionIndex()
    {
    	session_start();
    	$model1 = new BillingInfo();
    	$address = new Address();
    	 $customer = Customer::find()->where(['customer_user_name' => 'greg chappel'])->one();
    	$model = BillingInfo::find()->where(['customer_usr_name' => 'greg chappel'])->all();
    	$totalPrice = $_POST['total-price'];
    	$quantity = [];
    	//$item_details = unserialize($_POST['item_details']);
    	//$items = unserialize($_POST['items']);
    	$item_details = $_SESSION['item_details'];
    	foreach($item_details as $itemDetails)
    	{ 
    		$quantity[$itemDetails->idetails_id] = $_POST['quantity-text-field-'.$itemDetails->idetails_id];
    		if($quantity[$itemDetails->idetails_id] =='')
    			$quantity[$itemDetails->idetails_id] = "1";
    	}
    	$items = $_SESSION['items'];
    	//$items = Item::find()->where(['item_name' => 'Armani BlueShirt111'])->one();
    	//$item_details = ItemDetails::find()->where(['item_id' => 'DummyDesigner1_0'])->one(); */
        return $this->render('index',['model1' => $model1,'model' => $model, 'cust' => $customer,'item_details' => $item_details,'items' => $items,'totalPrice' => $totalPrice,'quantity' => $quantity,'address' => $address]);
    }
    public function actionCart()
    {
    	print_r("great");
    	session_start();
    	$message = 'You Are Successfully Ordered';
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    		
    		$address = $_POST["address"];
    		$billing = $_POST["billingInfo"];
    		$totalPrice = $_POST["total-price"];
    		$quantity = $_SESSION['quantity'];
    		$shipping = $_POST["shipping"];
    		$item_details = $_SESSION['item_details'];
    		$quantity = $_SESSION['quantity'];
    		//print_r($address);
    		$billingInfo = BillingInfo::find()->where(['billing_id' => $billing])->one();
    		$order = new Orders();
    		$order->customer_user_name = $billingInfo->customer_usr_name;
    		$order->order_date = date("Y-m-d");
    		$order->billing_address = $billingInfo->billing_address;
    		$order->creditcard_expdate = $billingInfo->creditcard_expdate;
    		$order->name_on_card = $billingInfo->name_on_card;
    		$order->shipping_address = $address;
    		$order->totalprice = $totalPrice;
    		$order->delivery_type = $shipping;
    		$order->save();
    		foreach($item_details as $itemDetails)
    		{
    			
    		$order_details = new OrderDetails();
    		$order_details->order_id = $order->order_id;
    		$order_details->idetails_id = $itemDetails->idetails_id;
    		$order_details->quantity = intval($quantity[$itemDetails->idetails_id]);
    		$order_details->order_status = 'pending';
    		$order_details->save();
    		}
    			
    	}
    	
    	return $this->render('ordered',[ 'address' => $address,'billing' => $billing,'billinginfo' => $billingInfo]);
    }
    public function actionCard()
    {
    	$session = Yii::$app->session;
    	$session->open();
    	$model1 = new BillingInfo();
    	$model1->customer_usr_name = $session['customer_name'];
    	if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
    		
         $model1->save();

         echo $model1->billing_id.'_'.$model1->creditcard_no.'_'.$model1->name_on_card.'_'.$model1->creditcard_expdate;
        	
    }
    
   
  
   }
   public function actionAddcart()
   {
   	$cart = Cart::find()->where(['customer_user_name' => 'greg chappel'])->all();
   	$items_details = [];
   	$itemName = [];
   	$count1 = 0;
        foreach($cart as $c)
        {
    	$items_details[$count1] = ItemDetails::find()->where(['idetails_id' => $c->idetails_id])->one();
    	$count1++;
        }
        foreach($items_details as $item)
        {
        	$itemName[$item->idetails_id] = Item::find()->where(['item_id' => $item->item_id])->one();
        }
       
        
   	return $this->render('addcart',['items_details'=> $items_details,'itemName' => $itemName]);
   }
    
   public function actionTempcard()
   {
   	$billing = $_POST['id'];
   	$model1 = BillingInfo::find()->where(['billing_id' => $billing])->one();
   	
   	echo $model1->creditcard_no.'_'.$model1->name_on_card.'_'.$model1->creditcard_expdate;
   	
   }
   public function actionDeletecart()
   {
   	session_start();
   	$idetails = $_POST['id'];
   	$item_details = $_SESSION['item_details'];
   	$items = $_SESSION['items'];
   	$deleteKey;
   	foreach($item_details as $key => $itemd )
   	{
   		if(($itemd->idetails_id)==$idetails)
   		{
   			$deleteKey = $key;
   		}
   	}
   	unset($item_details[$deleteKey]);
   	$_SESSION['item_details'] = $item_details;
   
   	
   	$db = Yii::$app->db;
   	//$db ->createCommand('DELETE FROM cart WHERE idetails_id ='.$idetails.'')->execute();
   	
   }
   public function actionSettings()
   {
   	
   	$orders = Orders::find()->where(['customer_user_name' => 'greg chappel'])->all();
   	$orders_all = [];
   	$order_itemName = [];
   	$order_items = [];
   	foreach($orders as $orders_each)
   	{
   	$order_all[$orders_each->order_id] = OrderDetails::find()->where(['order_id' => $orders_each->order_id])->all();
   	
   	foreach($order_all[$orders_each->order_id] as $order_d)
   	{
   		$order_items[$order_d->order_id][$order_d->idetails_id] = ItemDetails::find()->where(['idetails_id' => $order_d->idetails_id])->one();
   		$order_itemName[$order_d->order_id][$order_d->idetails_id] = Item::find()->where(['item_id' => $order_items[$order_d->order_id][$order_d->idetails_id]->item_id ])->one();
   	}
   	
   	}
   	
   /* 	foreach($orders as $order_one)
   	{ 
   		
   		$order_items[$order_d->idetails_id] = ItemDetails::find()->where(['idetails_id' => $order_d->idetails_id])->one();
   		$order_itemName[$order_d->idetails_id] = Item::find()->where(['item_id' => $order_items[$order_d->idetails_id]->item_id ])->one();
   	} */
   	
   	return $this->render('settings',['orders' => $orders,'order_all' => $order_all,'order_items' => $order_items,'order_itemName' => $order_itemName]);
   	
   	
   }
   
   public function actionProfilesettings()
   {
   	
   	
   	return $this->render('profilesettings',[]);
   	
   	
   	
   	
   }
   public function actionEditpayment() 
   { 
   	
   	$model = BillingInfo::find()->where(['customer_usr_name' => 'greg chappel'])->all();
   	$model2 = new BillingInfo();
   	return $this->render('editpayment',['model' => $model,'model2' => $model2]);
   	
   }
   
   public function actionRemovecard()
   {
   $id = $_POST['id'];
   $db = Yii::$app->db;
  // $db ->createCommand('DELETE FROM billing_info WHERE billing_id ='.$id.'')->execute();
   }
   public function actionEditcard() 
   {
   	$id = $_POST['id'];
   	$modelBilling = BillingInfo::find()->where(['billing_id' => $id])->one();
   	
   	echo $this->render('editmodal',['model1' => $modelBilling]);
   	
   }
   public function actionNewcard() 
   {
   	$model1 = new BillingInfo();
   	
   	$db = Yii::$app->db;
   //echo $model1->load(Yii::$app->request->post());
   //echo $model1->validate();
   
   	if ($model1->load(Yii::$app->request->post())) {
   		$billing_id = $model1->billing_id;
   		//echo $model1->customer_usr_name;
   		  $db->createCommand('DELETE FROM billing_info WHERE billing_id ='.$billing_id.'')->execute();
  	$model1->save();
   	  echo $model1->billing_id.'_'.$model1->creditcard_no.'_'.$model1->creditcard_expdate;
   	
   }
  
   }
   public function actionAccountsettings() 
   { 
   	
   	$model2 = Customer::find()->where(['customer_user_name' => 'greg chappel'])->one();
   	$model1 = UserLogin::find()->where(['user_name' => 'greg chappel'])->one();
   	return $this->render('accountsettings',['model2' => $model2,'model1' => $model1]);
   }
   public function actionEditname() 
   {
   	$db = Yii::$app->db;
   	$model1 = new Customer();
   	if ($model1->load(Yii::$app->request->post()))
   	{
   		$name = $model1->customer_user_name;
   		$db->createCommand('UPDATE Customer set customer_user_name="'.$name.'" WHERE customer_user_name ="greg chappel"')->execute();
   		echo $name;
   		
   	}
   	
   }
   public function actionEditemail()
   {
   	$db = Yii::$app->db;
   	$model1 = new Customer();
   	if ($model1->load(Yii::$app->request->post()))
   	{
   		$name = $model1->customer_email;
   		$db->createCommand('UPDATE Customer set customer_email="'.$name.'" WHERE customer_user_name ="greg chappel"')->execute();
   	    echo $name;
   	   
   	}
   }
   public function actionEditpassword()
   {
   	$db = Yii::$app->db;
   //	$model1 = new Customer();
   /* 	if ($model1->load(Yii::$app->request->post()))
   	{
   		$name = $model1->customer_password;//
   		$db->createCommand('UPDATE Customer set customer_password="'.$name.'" WHERE customer_user_name ="greg chappel"')->execute();
   		echo $name;
   			
   	} */
   	$oldpassword = $_POST['oldp'];
   	 $model = UserLogin::find()->where(['user_name' => 'greg chappel','user_password' => $oldpassword])->one();
   	 if($model==null)
   	 {
   	echo "Password Incorrect";
   	 }
   	 else if($_POST['newp']!=$_POST['retp'])
   	 	{
   	 		echo "Password Mismatch";
   	 	}
   	 	else 
   	 	{ 
   	 		$db->createCommand('UPDATE user_login set user_password="'.$_POST['newp'].'" WHERE user_name ="greg chappel"')->execute();
   	 		echo 'success';
   	 	}
   	 
   }
   public function actionEditphone()
   {
   	$db = Yii::$app->db;
   	$model1 = new Customer();
   	if ($model1->load(Yii::$app->request->post()))
   	{
   		$name = $model1->customer_ph_number;
   		$db->createCommand('UPDATE Customer set customer_ph_number="'.$name.'" WHERE customer_user_name ="greg chappel"')->execute();
   		echo $name;
   			
   	}
   }
   public function actionAddressbook()
   { 
   	$model1 = Customer::find()->where(['customer_user_name' => 'greg chappel'])->one();
   	$model2 = new Address();
   	return $this->render('addressbook',['model1' => $model1, 'model2' => $model2]);
   	
   }
   public function actionEditaddress() 
   { 
   	$db = Yii::$app->db;
   	$model1 = new Customer();
   	if ($model1->load(Yii::$app->request->post()))
   	{
   		$name1 = $model1->customer_address1;
   		$name2 = $model1->customer_address2;
   		
   		if($name2 == "")
   		{
   		$db->createCommand('UPDATE Customer set customer_address1="'.$name1.'" WHERE customer_user_name ="greg chappel"')->execute();
   		echo $name1;
   		}
   		else
   		{
   			$db->createCommand('UPDATE Customer set customer_address1="'.$name2.'" WHERE customer_user_name ="greg chappel"')->execute();
   			echo $name2;
   		}
   	
   	}
   }
   public function actionAddnewaddress()
   {
    $model1 = new Address();
    if ($model1->load(Yii::$app->request->post()))
    {
    	$model1->customer_user_name = "greg chappel";
    	 $model1->save();
    	 echo $model1->address_id."*".$model1->customer_user_name."*".$model1->Address_line_1."*".$model1->Address_line_2."*".$model1->city."*".$model1->state."*".$model1->zip."*".$model1->phone_number;
    	
    }
   }
   public function actionAddressbook2() 
   { 
   	$model = Address::find()->where(['customer_user_name' => 'greg chappel'])->all();
   	$model2 = new Address();
    return $this->render('addressbook2',['model' => $model,'model2' => $model2]);	
   	
   	
   	
   }
   public function actionEditaddressbook() 
   { 
   	  $id = $_POST['id'];
   	  echo $id;
   	  $model3 = Address::find()->where(['address_id' =>  $id])->one();
   	  echo $this->render('addressmodal',['model3' => $model3]);
   }
   
   public function actionEditmodaladdress()
   { 
   	$db = Yii::$app->db;
   	$model1 = new Address();
   	if ($model1->load(Yii::$app->request->post()))
   	{
   		$model1->customer_user_name = "greg chappel";
   		$addr_id = $model1->address_id;
   		$db->createCommand('DELETE FROM Address WHERE address_id ='.$addr_id.'')->execute();
   		$model1->save();
   		echo $model1->address_id."*".$model1->customer_user_name."*".$model1->Address_line_1."*".$model1->Address_line_2."*".$model1->city."*".$model1->state."*".$model1->zip."*".$model1->phone_number;
   	}
   	
   	
   }
   public function actionDesignershipping() 
   { 
   	$orders1 = OrderDetails::find()->where(['designer_id' => 'DummyDesigner1','order_status' => 'pending'])->all();
   	$orderid1 = [];
   	$items1 = [];
   	$itemName1 = [];
   	foreach($orders1 as $order)
   	{ 
   		$items1[$order->idetails_id] = ItemDetails::find()->where(['idetails_id' => $order->idetails_id])->one();
   	    $itemName1[$order->idetails_id] = Item::find()->where(['item_id' => $items1[$order->idetails_id]->item_id])->one();
   	    $orderid1[$order->order_id] = Orders::find()->where(['order_id' => $order->order_id])->one();
   	}
   	$orders2 = OrderDetails::find()->where(['designer_id' => 'DummyDesigner1','order_status' => 'shipped'])->all();
   	$orderid2 = [];
   	$items2 = [];
   	$itemName2 = [];
   	foreach($orders2 as $order)
   	{
   		$items2[$order->idetails_id] = ItemDetails::find()->where(['idetails_id' => $order->idetails_id])->one();
   		$itemName2[$order->idetails_id] = Item::find()->where(['item_id' => $items2[$order->idetails_id]->item_id])->one();
   		$orderid2[$order->order_id] = Orders::find()->where(['order_id' => $order->order_id])->one();
   	}
   	return $this->render('designershipping',['orders1' => $orders1,'items1' => $items1,'itemName1' => $itemName1,'orderid1' => $orderid1,'orders2' => $orders2,'items2' => $items2,'itemName2' => $itemName2,'orderid2' => $orderid2]);
   }
   
   public function actionDeleteaddress() 
   {
   	$db = Yii::$app->db;
   	//$db->createCommand('DELETE FROM address WHERE address_id ='.$address_id.'')->execute();
   }
   public function actionShippingorder() 
   { 
   	$delivery_name = $_POST['delivery_name'];
   	$order_id = $_POST['order_id'];
   	$idetails_id = $_POST['idetails_id'];
   	$tracking_name = $_POST['tracking_name'];
   	$model = OrderDetails::find()->where(['order_id' => $order_id,'idetails_id' => $idetails_id])->one();
   	$model->delivery_name = $delivery_name;
   	$model->order_status = 'shipped';
   	$model->tracking_number = $tracking_name;
   	$model->save();
   	$designer = Designer::find()->where(['designer_id' => $model->designer_id])->one();
   	$order = Orders::find()->where(['order_id' => $model->order_id])->one();
   	$customer = Customer::find()->where(['customer_user_name' => $order->customer_user_name])->one();
   	/* Yii::$app->mail->compose()
   	->setFrom($designer->designer_email)
   	->setTo($customer->customer_email)
   	->setSubject('Regarding your Order in Nudostilo')
   	->send(); */
   	echo $delivery_name.'-'.$order_id.'-'.$idetails_id;	
   	
   	
   }
   public function actionCartnewaddress() 
   {
   	$model = new Address();
   	if ($model->load(Yii::$app->request->post()))
   	{
   		$model->customer_user_name = 'greg chappel';
   		$model->save();
   		echo $model->customer_user_name.','.$model->Address_line_1.','.$model->Address_line_2.','.$model->city.','.$model->state.'-'.$model->zip;
   	}
   }
   
   public function actionMakepayments() 
   { 
   	
   	$card = new CreditCard;
   	$card->setType('visa')
   	->setNumber('4111111111111111')
   	->setExpireMonth('06')
   	->setExpireYear('2018')
   	->setCvv2('782')
   	->setFirstName('Richie')
   	->setLastName('Richardson');
   	
   	try {
   		$card->create(Yii::$app->cm->getContext());
   		// ...and for debugging purposes
   		echo '<pre>';
   		var_dump('Success scenario');
   		echo $card;
   	} catch (PayPalConnectionException $e) {
   		echo '<pre>';
   		var_dump('Failure scenario');
   		echo $e;
   }
   }
   
   public function actionPayex()
   {
   	$p = new paypal();
    	/* $response = $p->teszt(10,[]);
   	echo '<pre/>';
   
   	$url = $response->links[1]->href;
   	echo 'Redirect user here:'.$url.'<br/><br/>';
   	var_dump($response);
   
   	header('Location: '.$url);
   	die();
   	 return $this->render('index');  */
   	
   	$p->initDemo();
   	$response = $p->payDemo();
   	//echo '<pre/>';
   	 
   	$url = $response->links[1]->href;
 //echo 'Redirect user here:'.$url.'<br/><br/>';
   //	print_r($response);
   	return $this->redirect(
   			$url
   		
   	);
   	//header("Location:".$url);
   	//header('Location: '.$url);
   //	die();
   //	return $this->render('ordered');
   	
   }
   public function actionOrdered() 
   {  
   	return $this->render('ordered', []);
   	
   }
   
}



?>