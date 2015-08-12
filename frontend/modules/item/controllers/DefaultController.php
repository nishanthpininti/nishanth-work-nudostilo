<?php

namespace frontend\modules\item\controllers;
require_once('SimplestXML.php');
use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\web\UploadedFile;
use yii\data\Pagination;
use SimplestXML;
use frontend\modules\item\models\ItemList;
use frontend\modules\item\models\Item;
use frontend\modules\item\models\ItemDetails;
use frontend\modules\item\models\SuperCategory;
use frontend\modules\item\models\Category;
use frontend\modules\item\models\SubCategory;
use frontend\modules\item\models\Colors;

class DefaultController extends Controller
{
    public $colorNumbers = array(1,2,3,4,5,6,7,8,9,10);
	public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionViewitemlist($username){
        $model =new ItemList();
       // if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sql = 'SELECT * FROM item where item_designer_id ="'.$username.'" order by item_sub_category_id';
            $res = ItemList::findBySql($sql)->all();
			return $this->render('Viewitemlist',['list'=>$res]);
        //}
       //return $this->render('Viewitemlist',['model'=>$model]);
    }
	//Start with super category selection
	public function actionUploaditem()
	{
		$session = new Session;
		$session->open();
		$showCategory = false;
		$super_cat_model = new SuperCategory;
		$superCategoryData = (new SuperCategory)->getSuperCategorydata();
		$session['superCategoryArray']=$superCategoryData;
		return $this->render('uploaditem',['super_cat_model'=>$super_cat_model,'showCategory'=>$showCategory,'superCategoryData'=>$superCategoryData]);
	}
	//Select Category
	public function actionSelectcategory()
	{
		$session = new Session;
		$session->open();
		$super_cat_model = new SuperCategory;
		$category_model = new Category;
		$showCategory = false;
		$showSubCategory = false;
		$superCategoryData = $session['superCategoryArray'];
		$categoryData='';
		if ($super_cat_model->load(Yii::$app->request->post()))
		{
			$showCategory = true;
			$categoryData = $category_model->getCategoriesData($super_cat_model->super_category_id);
			$session['categoryData']=$categoryData;
		}
		return $this->render('uploaditem',['superCategoryData'=>$superCategoryData,'super_cat_model'=>$super_cat_model,'category_model'=>$category_model,'categoryData'=>$categoryData,'showCategory'=>$showCategory,'showSubCategory'=>$showSubCategory]);
	}
	//Select subcategory
	public function actionSelectsubcategory($super_cat_id)
	{
		$session = new Session;
		$session->open();
		$superCategoryData = $session['superCategoryArray'];
		$super_cat_model = new SuperCategory(['super_category_id' => $super_cat_id]);
		$categoryData=$session['categoryData'];
		$showCategory = true;
		$category_model = new Category;
		$SubCategory_model = new SubCategory;
		$showSubCategory = false;
		$SubcategoryData = '';
		$showColorNumberSelection = false;
		if ($category_model->load(Yii::$app->request->post()))
		{
			$showSubCategory = true;
			$SubcategoryData = $SubCategory_model->getSubCategoriesData($category_model->category_id);
			$session['SubcategoryData']=$SubcategoryData;
		}
		return $this->render('uploaditem',['superCategoryData'=>$superCategoryData,'super_cat_model'=>$super_cat_model,'category_model'=>$category_model,'categoryData'=>$categoryData,'showCategory'=>$showCategory,'showSubCategory'=>$showSubCategory,'SubcategoryData'=>$SubcategoryData,'SubCategory_model'=>$SubCategory_model,'showColorNumberSelection'=>$showColorNumberSelection]);
	}
	//Select number of colors
	public function actionSelectnumberofcolors($super_cat_id,$cat_id)
	{
		$session = new Session;
		$session->open();
		$superCategoryData = $session['superCategoryArray'];
		$super_cat_model = new SuperCategory(['super_category_id' => $super_cat_id]);
		$categoryData=$session['categoryData'];
		$showCategory = true;
		$category_model = new Category(['category_id'=>$cat_id]);
		$SubcategoryData = $session['SubcategoryData'];
		$showSubCategory = true;
		$SubCategory_model = new SubCategory;
		$showColorNumberSelection = false;
		$modelItem = new Item;
		$showColorSizeImageSelection = false;
		if ($SubCategory_model->load(Yii::$app->request->post()))
		{
			$showColorNumberSelection = true;
			$colorNumbers = array(1,2,3,4,5,6,7,8,9,10);
			$session['colorNumbers'] = $colorNumbers;
			$mirrorValues = array(1,2,3,4,5);
			$session['mirrorValues'] = $mirrorValues;
		}
		return $this->render('uploaditem',['superCategoryData'=>$superCategoryData,'super_cat_model'=>$super_cat_model,'category_model'=>$category_model,'categoryData'=>$categoryData,'showCategory'=>$showCategory,'showSubCategory'=>$showSubCategory,'SubcategoryData'=>$SubcategoryData,'SubCategory_model'=>$SubCategory_model,'showColorNumberSelection'=>$showColorNumberSelection,'modelItem'=>$modelItem,'colorNumbers'=>$colorNumbers,'mirrorValues'=>$mirrorValues,'showColorSizeImageSelection'=>$showColorSizeImageSelection]);
	}
	
	public function actionShowcolorsizeimage($super_cat_id,$cat_id,$sub_cat_it)
	{
		$session = new Session;
		$session->open();
		$superCategoryData = $session['superCategoryArray'];
		$super_cat_model = new SuperCategory(['super_category_id' => $super_cat_id]);
		$categoryData=$session['categoryData'];
		$showCategory = true;
		$category_model = new Category(['category_id'=>$cat_id]);
		$SubcategoryData = $session['SubcategoryData'];
		$showSubCategory = true;
		$SubCategory_model = new SubCategory(['sub_category_id'=>$sub_cat_it]);
		$showColorNumberSelection = true;
		$showColorSizeImageSelection = false;
		$mirrorValues = $session['mirrorValues'];
		$colorNumbers = $session['colorNumbers'];
		$modelItem = new Item;
		$colors = (new Colors)->getColors();
		if ($modelItem->load(Yii::$app->request->post()))
		{
			$hastag = str_replace("#"," #",$modelItem->item_hashTag);
			$modelItem->item_hashTag = '"'.$hastag.'"';
			$showColorSizeImageSelection = true;
		}
		return $this->render('uploaditem',['superCategoryData'=>$superCategoryData,'super_cat_model'=>$super_cat_model,'category_model'=>$category_model,'categoryData'=>$categoryData,'showCategory'=>$showCategory,'showSubCategory'=>$showSubCategory,'SubcategoryData'=>$SubcategoryData,'SubCategory_model'=>$SubCategory_model,'showColorNumberSelection'=>$showColorNumberSelection,'modelItem'=>$modelItem,'colorNumbers'=>$colorNumbers,'mirrorValues'=>$mirrorValues,'showColorSizeImageSelection'=>$showColorSizeImageSelection,'colors'=>$colors]);
	}
	
	public function actionInsetitem($sub_cat_it,$item_name,$item_mirrVal,$item_no_of_colors,$item_id,$item_hash)
	{
			$session = new Session;
			$session->open();
			$modelItem = new Item;
			$mirrorValues = $session['mirrorValues'];
			$colorNumbers = $session['colorNumbers'];
			$session['sub_cat_id'] = $sub_cat_it;
			$session['user_name'] = 'DummyDesigner1';
			//Create item id
			if($item_id == 'new')
			{
			$item_count = $modelItem->getItemCount();
			$item_id = $session['user_name']."_".$item_count;
			$modelItem = new Item(['item_id'=>$item_id,'item_name'=>$item_name,'item_mirrorval'=>$mirrorValues[$item_mirrVal],'item_designer_id'=>$session['user_name'],'item_sub_category_id'=>$sub_cat_it,'item_hashTag'=>$item_hash]);
			$insertItem = $modelItem->insertItem();
			}
			else
			{
			$modelItem = new Item(['item_id'=>$item_id,'item_name'=>$item_name,'item_mirrorval'=>$mirrorValues[$item_mirrVal],'item_designer_id'=>$session['user_name'],'item_sub_category_id'=>$sub_cat_it]);
			}
		if ($modelItem->load(Yii::$app->request->post()))
		{	$itemDetailsData = Yii::$app->request->post();
			$modelItemDetails = array(); 
			for($i=0;$i<$colorNumbers[$item_no_of_colors];$i++)
			{
				//Front image upload
				$imgName = $item_id.'_'.$itemDetailsData['Item']['itemColors'][$i].'_front';
				$modelItem->itemImgFront[$i] = UploadedFile::getInstance($modelItem, 'itemImgFront['.$i.']');
				$pathfront = 'uploads/itemPictures/'. $imgName . '.' . $modelItem->itemImgFront[$i]->extension;
				$modelItem->itemImgFront[$i]->saveAs($pathfront);
				//Back image upload
				$imgName = $item_id.'_'.$itemDetailsData['Item']['itemColors'][$i].'_back';
				$modelItem->itemImgBack[$i] = UploadedFile::getInstance($modelItem, 'itemImgBack['.$i.']');
				$pathback = 'uploads/itemPictures/'. $imgName . '.' . $modelItem->itemImgBack[$i]->extension;
				$modelItem->itemImgBack[$i]->saveAs($pathback);
				//Model1 image upload
				$imgName = $item_id.'_'.$itemDetailsData['Item']['itemColors'][$i].'_model1';
				$modelItem->itemImgModel1[$i] = UploadedFile::getInstance($modelItem, 'itemImgModel1['.$i.']');
				$pathmodel1 = 'uploads/itemPictures/'. $imgName . '.' . $modelItem->itemImgModel1[$i]->extension;
				$modelItem->itemImgModel1[$i]->saveAs($pathmodel1);
				//Model2 image upload
				$imgName = $item_id.'_'.$itemDetailsData['Item']['itemColors'][$i].'_model2';
				$modelItem->itemImgModel2[$i] = UploadedFile::getInstance($modelItem, 'itemImgModel2['.$i.']');
				$pathmodel2 = 'uploads/itemPictures/'. $imgName . '.' . $modelItem->itemImgModel2[$i]->extension;
				$modelItem->itemImgModel2[$i]->saveAs($pathmodel2);
				//Model3 image upload
				$imgName = $item_id.'_'.$itemDetailsData['Item']['itemColors'][$i].'_model3';
				$modelItem->itemImgModel3[$i] = UploadedFile::getInstance($modelItem, 'itemImgModel3['.$i.']');
				$pathmodel3 = 'uploads/itemPictures/'. $imgName . '.' . $modelItem->itemImgModel3[$i]->extension;
				$modelItem->itemImgModel3[$i]->saveAs($pathmodel3);
				
				for($j=0;$j<sizeof($itemDetailsData['Item']['itemSize'][$i]);$j++)
				{
				$modelItemDetails[] = new ItemDetails(['item_id'=>$item_id,'item_color'=>$itemDetailsData['Item']['itemColors'][$i],'item_size'=>$itemDetailsData['Item']['itemSize'][$i][$j],'item_photo_front'=>$pathfront,'item_photo_back'=>$pathback,'item_photo_model1'=>$pathmodel1,'item_photo_model2'=>$pathmodel2,'item_photo_model3'=>$pathmodel3,'item_available_qnt'=>0,'item_price'=>0.00]);
				//$insertItemDetails = $modelItemDetails->insertItemDetails();
				}
			}
			$session['modelItemDetails'] = $modelItemDetails;
			$this->redirect('index.php?r=item/default/showitemdetailsforinsert&i=0');
			//return $this->render('index',['model'=>$modelItemDetails[0]]);
		}
	}
	
	public function actionShowitemdetailsforinsert($i)
	{
		$session = new Session;
		$session->open();
		$modelItemDetails = $session['modelItemDetails'];
		if($i < sizeof($modelItemDetails))
		{
			$itemData = (new Item)->getItemData($modelItemDetails[$i]->item_id);
			//Getting XML specific attributes
			$specificAttrdata = (new SubCategory)->getSpecificAttributes($itemData['item_sub_category_id']);
			$xml = simplexml_load_string($specificAttrdata->sub_category_specificattribute);
			$specificAttrValVar = array();
			$specificAttrName = array();
			$specificAttributesArray = (array)$xml;
			foreach($specificAttributesArray as $attribute => $value) 
			{
				$specificAttrName[] = $attribute;
				$specificAttrValVar[] = array($attribute => $value);
			}
			//Model creation with data
			$modelItem = new ItemDetails(['item_id'=>$modelItemDetails[$i]->item_id,'item_color'=>$modelItemDetails[$i]->item_color,'item_size'=>$modelItemDetails[$i]->item_size,'item_photo_front'=>$modelItemDetails[$i]->item_photo_front,'item_photo_back'=>$modelItemDetails[$i]->item_photo_back,'item_photo_model1'=>$modelItemDetails[$i]->item_photo_model1,'item_photo_model2'=>$modelItemDetails[$i]->item_photo_model2,'item_photo_model3'=>$modelItemDetails[$i]->item_photo_model3,'specificAttrValVar'=>$specificAttrValVar]);
			if ( $modelItem->load(Yii::$app->request->post())  && $modelItem->validate()) 
			{
				 //Create XML for specific attribute
				$specificAttr = array();
				for($j=0;$j<sizeof($modelItem->specificAttrValVar);$j++)
				{
				  foreach($modelItem->specificAttrValVar[$j] as $attribute => $value) 
				  {
					$specificAttr[$attribute] = $value;
				  }
				}
				$sx = new SimplestXML();
				$xml = '';
				if(sizeof($specificAttr)>0)
				{
				$xml = $sx->to_xml('specificAttrbiutes', $specificAttr);
				}
				$modelItem->item_specificattribute = $xml;
				$modelItem->save();
				//creating new model for next item details upload
				$i = $i+1;
				if($i<sizeof($modelItemDetails))
				{
					$modelItem = new ItemDetails(['item_id'=>$modelItemDetails[$i]->item_id,'item_color'=>$modelItemDetails[$i]->item_color,'item_size'=>$modelItemDetails[$i]->item_size,'item_photo_front'=>$modelItemDetails[$i]->item_photo_front,'item_photo_back'=>$modelItemDetails[$i]->item_photo_back,'item_photo_model1'=>$modelItemDetails[$i]->item_photo_model1,'item_photo_model2'=>$modelItemDetails[$i]->item_photo_model2,'item_photo_model3'=>$modelItemDetails[$i]->item_photo_model3,'specificAttrValVar'=>$specificAttrValVar]);
				}
				else
				{
					echo 'Done';
				}
				
			}
			return $this->render('insertItemDetails',['modelItem'=>$modelItem,'itemData'=>$itemData,'specificAttrName'=>$specificAttrName,'i' => $i]);
		}
		else
		{
			echo'Done';
		}
	}
	
	public function actionUpdateitem($itemId)
	{
		$session = new Session;
		$session->open();
		$showColorNumberSelection = false;
		if(isset($session['itemDetailRow']))
		{	$showupdatedetails = true;
			$itemDetailRow = $session['itemDetailRow'];
			$itemData = (new Item)->getItemData($itemId);
			$itemModel = new Item;
			$mirrorValues = array(1,2,3,4,5);
			$itemColors = (new ItemDetails)->getItemColors($itemId);
			$itemSizes = (new ItemDetails)->getItemSizes($itemId,$itemColors[0]['item_color']);
			//Create array of XML specific attributes
			$xml = simplexml_load_string($itemDetailRow['item_specificattribute']);
			$specificAttrValVar = array();
			$specificAttrName = array();
			$specificAttributesArray = (array)$xml;
			foreach($specificAttributesArray as $attribute => $value) 
			{
				$specificAttrName[] = $attribute;
				$specificAttrValVar[] = array($attribute => $value);
			}
			//Model creation with data
			$modelItemDetails = new ItemDetails(['idetails_id'=>$itemDetailRow['idetails_id'],'item_id'=>$itemDetailRow['item_id'],'item_color'=>$itemDetailRow['item_color'],'item_size'=>$itemDetailRow['item_size'],'item_price'=>$itemDetailRow['item_price'],'item_desc'=>$itemDetailRow['item_desc'],'item_photo_front'=>$itemDetailRow['item_photo_front'],'item_photo_back'=>$itemDetailRow['item_photo_back'],'item_photo_model1'=>$itemDetailRow['item_photo_model1'],'item_photo_model2'=>$itemDetailRow['item_photo_model2'],'item_photo_model3'=>$itemDetailRow['item_photo_model3'],'item_available_qnt'=>$itemDetailRow['item_available_qnt'],'item_discountPrice'=>$itemDetailRow['item_discountPrice'],'item_discountPer'=>$itemDetailRow['item_discountPer'],'item_specificattribute'=>$itemDetailRow['item_specificattribute'],'specificAttrValVar'=>$specificAttrValVar]);
			//After click on update details
			if ($modelItemDetails->load(Yii::$app->request->post()) && $modelItemDetails->validate()) 
			{
				//Create XML for specific attribute
				$specificAttr = array();
				for($j=0;$j<sizeof($modelItemDetails->specificAttrValVar);$j++)
				{
				  foreach($modelItemDetails->specificAttrValVar[$j] as $attribute => $value) 
				  {
					$specificAttr[$attribute] = $value;
				  }
				}
				$sx = new SimplestXML();
				$xml = '';
				if(sizeof($specificAttr)>0)
				{
				$xml = $sx->to_xml('specificAttrbiutes', $specificAttr);
				}
				$modelItemDetails->item_specificattribute = $xml;
				$update = $modelItemDetails->updateItemDetails();
				unset($session['itemDetailRow']);
				$showupdatedetails = false;
				//Go to other page
			}
			//Return view
			return $this->render('updateitem',['itemModel'=>$itemModel,'itemData'=>$itemData,'mirrorValues'=>$mirrorValues,'itemColors'=>$itemColors,'itemSizes'=>$itemSizes,'showupdatedetails'=>$showupdatedetails,'modelItemDetails'=>$modelItemDetails,'specificAttrValVar'=>$specificAttrValVar,'specificAttrName'=>$specificAttrName,'showColorNumberSelection'=>$showColorNumberSelection]);
		}
		else
		{
			$showupdatedetails = false;
			$itemData = (new Item)->getItemData($itemId);
			$itemModel = new Item;
			$mirrorValues = array(1,2,3,4,5);
			$itemColors = (new ItemDetails)->getItemColors($itemId);
			$itemSizes = (new ItemDetails)->getItemSizes($itemId,$itemColors[0]['item_color']);
			return $this->render('updateitem',['itemModel'=>$itemModel,'itemData'=>$itemData,'mirrorValues'=>$mirrorValues,'itemColors'=>$itemColors,'itemSizes'=>$itemSizes,'showupdatedetails'=>$showupdatedetails,'showColorNumberSelection'=>$showColorNumberSelection]);
		}
	}
	
	public function actionUpdateitemdata()
	{
		$mirrorValues = array(1,2,3,4,5);
		$update = (new Item)->updateItem($_POST['itemid'],$_POST['itemname'],$mirrorValues[$_POST['itemmirrval']],$_POST['itemhash']);
	}
	
	public function actionFetchsizes()
	{
		$itemSizes = (new ItemDetails)->getItemSizes($_POST['itemid'],$_POST['color']);
		echo '<option value="0">Select Size</option>';
		foreach($itemSizes as $size) 
		{
			echo '<option value="'.$size['item_size'].'">'.$size['item_size'].'</option>';
		} 
	}
	
	public function actionDummy($color,$itemid,$size)
	{
		$session = new Session;
		$session->open();
		$itemDetailRow = (new ItemDetails)->getItemDetail($itemid,$color,$size);
		$session['itemDetailRow'] = $itemDetailRow;
		$this->redirect('index.php?r=item/default/updateitem&itemId='.$itemid);
	}
	
	public function actionDestroy()
	{
		$session = new Session;
		$session->open();
		$session->destroy();
	}
	
	public function actionDeteteitemdetailrow()
	{
		$idetailsid = $_POST['idetailsid'];
		if((new ItemDetails)->deleteItemDetail($idetailsid))
		{	
			$session = new Session;
			$session->open();
			unset($session['itemDetailRow']);
			echo 'Deletion successful';
		}
		else
			echo 'Some error occurred, please try again!';
	}
	
	public function actionShowupdatenocolorselector($item_id)
	{
			$showupdatedetails = false;
			$showColorNumberSelection = true;
			$showColorSizeImageSelection = false;
			
			$itemData = (new Item)->getItemData($item_id);
			$itemModel = new Item;
			$mirrorValues = array(1,2,3,4,5);
			$itemColors = (new ItemDetails)->getItemColors($item_id);
			$itemSizes = (new ItemDetails)->getItemSizes($item_id,$itemColors[0]['item_color']);
			return $this->render('updateitem',['itemModel'=>$itemModel,'itemData'=>$itemData,'mirrorValues'=>$mirrorValues,'itemColors'=>$itemColors,'itemSizes'=>$itemSizes,'showupdatedetails'=>$showupdatedetails,'showColorNumberSelection'=>$showColorNumberSelection,'showColorSizeImageSelection'=>$showColorSizeImageSelection,'colorNumbers'=>$this->colorNumbers]);
	}
	
	public function actionShowupdatecolorsizeimage($item_id)
	{
			$showupdatedetails = false;
			$showColorNumberSelection = true;
			$showColorSizeImageSelection = true;
			$itemData = (new Item)->getItemData($item_id);
			$itemModel = new Item(['item_id'=>$itemData['item_id'],'item_name'=>$itemData['item_name'],'item_mirrorval'=>$itemData['item_mirrorval'],'item_sub_category_id'=>$itemData['item_sub_category_id'],'item_hashTag'=>$itemData['item_hashTag']]);
			$colors = (new Colors)->getColors();
			$mirrorValues = array(1,2,3,4,5);
			$itemColors = (new ItemDetails)->getItemColors($item_id);
			$itemSizes = (new ItemDetails)->getItemSizes($item_id,$itemColors[0]['item_color']);
			if($itemModel->load(Yii::$app->request->post()))
			{
				print_r(Yii::$app->request->post());
			}
			return $this->render('updateitem',['itemModel'=>$itemModel,'itemData'=>$itemData,'mirrorValues'=>$mirrorValues,'itemColors'=>$itemColors,'itemSizes'=>$itemSizes,'showupdatedetails'=>$showupdatedetails,'showColorNumberSelection'=>$showColorNumberSelection,'showColorSizeImageSelection'=>$showColorSizeImageSelection,'colorNumbers'=>$this->colorNumbers,'colors'=>$colors]);
	}
	
	public function actionUpdateimage($path,$item_id)
	{
		$itemDetailsModel = new ItemDetails;
		if($itemDetailsModel->load(Yii::$app->request->post()) && isset($itemDetailsModel->img->extension))
			{
				$itemDetailsModel->img = UploadedFile::getInstance($itemDetailsModel, 'img');
				$itemDetailsModel->img->saveAs($path);
			}
		$this->redirect('index.php?r=item/default/updateitem&itemId='.$item_id);
	}
}
