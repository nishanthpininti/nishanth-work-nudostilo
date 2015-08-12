<?php

namespace frontend\modules\search\controllers;

use yii\web\Controller;
use Yii;
use frontend\modules\search\models\customer;
use frontend\modules\search\models\Item;
use frontend\modules\search\models\CustomerSocialLogin;
use frontend\modules\search\models\itemelastic;
 
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionUser()
    {
    	//Customer::deleteAll();
    	if(isset($_POST['searchV']))
    	{
    		$searchq = $_POST['searchV'];
    		$query = CustomerSocialLogin::findBySql('select * from customer')->all();
    		 /*for($x=1;$x<6;$x++)
    		 {
    		 $customer = Customer::get($x);
    		 var_dump($customer->customer_user_name);
    		} */
    	/*	$count=1;
    		  foreach($query as $q)
    		 {
    		 $customer = new Customer();
    		 $customer->primaryKey = $count;
    		 $customer->attributes = ['customer_user_name' => $q->customer_user_name, 'customer_first_name' => $q->customer_first_name,'customer_last_name' => $q->customer_last_name];
    		 $customer->save();
    		 $count++;
    		} */
    		//$result = Customer::find()->query(["match" => ["customer_user_name" => $searchq]])->asArray()->all();
    		$result = Customer::find()->query([
    				"fuzzy_like_this" => [
    						"fields" => ["customer_user_name"],
    						"like_text" => $searchq,
    						"max_query_terms" => 25,
    				]
    		])->asArray()->all();
			//var_dump($result);
    				for($x = 0;$x < count($result);$x++)
    				{
    				$val = $result[$x];
    				$res = $val['_source'];
    						$res = $res['customer_user_name'];
    								echo '<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;<a>'.$res.'</a></div>';
    				}
    
    				}
    				else echo '<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;no results for the search</div>';
  
  
    }
    public function actionItems()
        {
         
        if(isset($_POST['searchV']))
        	{
    
      
        	//Item::deleteAll();
        		/* $customer = Customer::findOne($id);
        		$customer->name = $name;
        		$customer->email = $email;
        		$customer->update(); */
        	/*$command = Yii::$app->elasticsearch->createCommand();
        	var_dump($command->deleteIndex('items'));
        	var_dump($command->createIndex('items'));
    
        	var_dump($command->deleteTemplate('itemt'));
        	var_dump($command->createTemplate('itemt','items',
        	//	[ "settings" => [
        			[ "analysis" => [
        					"filter" => [
        							"tweet_filter" => [
        							"type" => "word_delimiter",
        							"type_table" => ["# => ALPHA", "@ => ALPHA"]
        							]
        					],
        					"analyzer" => [
        					"tweet_analyzer" => [
        					"type" => "custom",
        					"tokenizer" => "whitespace",
        					"filter" => ["lowercase", "tweet_filter"]
        			]
        			]
    
        	]],
        	//["mappings" =>
        	[ "item" => [
        			"_source" => [
        			"enabled" => true
        	]
        	]]
    
        			, $order = 0));
        			print_r($command->getTemplate('itemt'));
        			var_dump($command->getMapping( $index = 'items',$type = 'item' ));
        					var_dump($command->deleteMapping('items','item'));
        					var_dump($command->setMapping('items','item', [
        							"item" => [
    
        							"properties" => [
        							'item_hashtag' => [
        									'type' => 'string',
        									'index' => 'analyzed',
        											'analyzer' => 'tweet_analyzer'
        											],
        											'item_size' => [
        											'type' => 'string',
        											'index' => 'not_analyzed',
        													], 'item_price' => [
        															'type' => 'double',
        																	'index' => 'not_analyzed',
        																			],
        																			'item_discountprice' => [
        																					'type' => 'string',
        																					'index' => 'not_analyzed',
        																			],
        																			'item_discountpercent' => [
        																					'type' => 'string',
        																					'index' => 'not_analyzed',
        																			],
        																			'item_color' => [
        																					'type' => 'string',
        																					'index' => 'not_analyzed',
        																			],
        																			'item_specificattribute' => [
        																					'type' => 'string',
        																					'index' => 'analyzed'
        																			],
        																			'item_designer_name' => [
        																					'type' => 'string',
        																						
        																			],
        																					'item_designer_score' => [
        																					'type' => 'string',
        																			]
    
    
    
        																			]]
        																			]));*/
        																			//var_dump($map);
    
    						$searchq = $_POST['searchV'];
        						$count = 10.0;
    
             /*              for($c=1;$c<3;$c++)
        						{
        								$item = Item::get($c);
        								var_dump($item->item_price);
        	}  */
        										
												
											$dat = 'ff';	
											$query = itemelastic::findBySql('select * from itemelastic')->all();
												
              $count  = 1;
			  $i = 0;
			  //print_r($query);
           /*     foreach($query as $q )
              {
				  
				  $item = new Item();
                  $item->primaryKey = $q->idetails_id;
                  $item->attributes = ['item_id' => $q->item_id,'item_name' => $q->item_name,'default_photo' => strval($q->default_photo),'item_mirrorval' => strval($q->item_mirrorval),
                          'item_designer_id' => $q->item_designer_id,'item_sub_category_id' => strval($q->item_sub_category_id),'item_hashtag' => $q->item_hashtag,'item_upload_time' => strval($q->item_upload_time),
                          'item_color' => strval($q->item_color),'item_size' => $q->item_size,'item_price' =>strval($q->item_price),'item_desc' => strval($q->item_desc),'item_photo_back' => strval($q->item_photo_back),
                          'item_photo_model1' => strval($q->item_photo_model1),'item_photo_model2' => strval($q->item_photo_model2),'item_photo_model3' => strval($q->item_photo_model3),'item_available_qnt' => strval($q->item_available_qnt),
                          'item_discountPrice' => strval($q->item_discountPrice),'item_discountPer' => strval($q->item_discountPer),'item_specificattribute' =>strval($q->item_specificattribute),'designer_first_name' => $q->designer_first_name];
                  $item->save();
                
				
              }  */
              //$count++;
              /*   for($c=1;$c<3;$c++)
               {
               $item = Item::get(26);
               var_dump($item->primaryKey);
               }  */


        									/*	for($c=1; $c<6 ; $c++)
        								{
        								$item = new Item();
        								$item->primaryKey = $c;
        	if($c == 1)
        		$item->attributes = ['item_id' => '1','item_name' => 'shirt1','item_desc' => 'shirts','item_price' => '23','item_discountprice' => '3','item_discountpercent' => '6','item_color' => 'red','item_size' => '40','item_specificattribute' => '<item_brand>levis</item_brand>','item_hashtag' => '#wow','item_designer_id' => '1','item_designer_name' => 'carl','item_designer_score' => '10'];
        		if($c == 2)
        			$item->attributes = ['item_id' => '2','item_name' => 'shirt1','item_desc' => 'shirts','item_price' => '30','item_discountprice' => '5','item_discountpercent' => '10','item_color' => 'blue','item_size' => '38','item_specificattribute' => '<item_brand>lee</item_brand><shoulder>27</shoulder>','item_hashtag' => '#trend #great','item_designer_id' => '2','item_designer_name' => 'william','item_designer_score' => '20'];
        			if($c == 3)
        				$item->attributes = ['item_id' => '3','item_name' => 'shirt3','item_desc' => 'shirts','item_price' => '70','item_discountprice' => '14','item_discountpercent' => '15','item_color' => 'green','item_size' => '36','item_specificattribute' => '<item_brand>wrangler</item_brand>','item_hashtag' => '#great #beutiful','item_designer_id' => '1','item_designer_name' => 'carl','item_designer_score' => '20'];
        				if($c == 4)
        					$item->attributes = ['item_id' => '4','item_name' => 'shirt4','item_des' => 'shirts','item_price' => '50','item_discountprice' => '6','item_discountpercent' => '4','item_color' => 'yellow','item_size' => '42','item_specificattribute' => '<item_brand>voitton</item_brand>','item_hashtag' => '#fashion #stylish','item_designer_id' => '3','item_designer_name' => 'george','item_designer_score' => '30'];
        							if($c == 5)
        								$item->attributes = ['item_id' => '5','item_name' => 'shirt5','item_desc' => 'shirts','item_price' => '40','item_discountprice' => '3','item_discountpercent' => '20','item_color' => 'green','item_size' => '40','item_specificattribute' => '<item_brand>gap</item_brand>','item_hashtag' => '#gorgeous #matching','item_designer_id' => '2','item_designer_name' => 'william','item_designer_score' => '40'];
        										$item->save();
        		}*/
        			
        		$result = Item::find()->query([
    
        				"bool" => [
        				"should" => [
        				["term" => [ "item_hashtag" => $searchq]],
        						["fuzzy_like_this" => [
        								"fields" => ["item_name","item_designer_name",'item_color'],
    						 				 									"like_text" => $searchq,
        						"max_query_terms" => 15,
        				]]]
    
        				]
        				] )->asArray()->all();
    
        						for($x = 0;$x < count($result);$x++)
        						{
        						$val = $result[$x];
        						$res = $val['_source'];
        						$item_name = $res['item_name'];
        						$item_photo = $res['item_photo_back'];
        						//$item_price = $res['item_price'];
        						echo '<div class="row"><div class="col-md-6"><a href="#">'.$item_name.'</a><br><a href="#"><img src="'.$item_photo.'" style="width:140px; height:140px;"></a><hr></div></div>';
        	}
        						 		
    
        	}
        	else echo '<div>unsuccessful!!!</div>';
    
    
    		
    
    
    
        	}
        	public function actionSample()
        	{
        		return $this->render('searchengine', [
        		
        				
        		
        		]);
        	}
    
}
