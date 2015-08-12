<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\Session;
use kartik\select2\Select2;
use frontend\modules\item\models\SuperCategory;
use frontend\modules\item\models\ItemList;
use frontend\modules\item\models\Item;
use frontend\modules\item\models\ItemDetails;
use frontend\modules\item\models\SubCategory;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$session = new Session;
$session->open();
$this->title = 'Upload Item Details';
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){
});
JS;
$this->registerJs($script);

//print_r($itemData);
//print_r($model);
?>
<div id="lightbox" style="position:absolute; width:100%">
<h4><?= 'Name - '.$itemData['item_name'] ?></h4>
<h4><?= 'Mirror Value  - '.$itemData['item_mirrorval'] ?></h4>
<h4><?= 'Size  - '.$modelItem->item_size ?></h4>
<h4><?= 'Color  - '.$modelItem->item_color ?></h4>
<div class="row row-list">
	<div class="col-xs-4">
	<?= Html::img($modelItem->item_photo_front,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	</div>
	<div class="col-xs-4">
	<?= Html::img($modelItem->item_photo_back,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	</div>
	<div class="col-xs-4">
	<?= Html::img($modelItem->item_photo_model1,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	</div>
	<div class="col-xs-4">
	<?= Html::img($modelItem->item_photo_model2,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	</div>
	<div class="col-xs-4">
	<?= Html::img($modelItem->item_photo_model3,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	</div>
</div>

 <?php $form = ActiveForm::begin(['method'=>'post','action'=>'index.php?r=item/default/showitemdetailsforinsert&i='.$i,'options' => ['enctype' => 'multipart/form-data']]) ?>
 <div class="row row-list">
 <div class="col-xs-4">
 <?= $form->field($modelItem, 'item_price')->textInput(['style'=>'width:100px']); ?>
 <?= $form->field($modelItem, 'item_desc')->textArea(['style'=>'width:100px']); ?>
 <?= $form->field($modelItem, 'item_discountPrice')->textInput(['style'=>'width:100px']); ?>
 <?= $form->field($modelItem, 'item_discountPer')->textInput(['style'=>'width:100px']); ?>
 <?= $form->field($modelItem, 'item_available_qnt')->textInput(['style'=>'width:100px']); ?>
 </div>
 <div class="col-xs-4">
 <?php  
		for($i=0;$i<sizeof($modelItem->specificAttrValVar);$i++)
		{
		 echo $form->field($modelItem, 'specificAttrValVar['.$i.']['.$specificAttrName[$i].']')->textInput(['style'=>'width:100px'])->label($specificAttrName[$i]); 
		}
		?>
 </div>
</div>
 <?= Html::submitButton('Upload Item',['class'=>'btn btn-primary','id'=>'uploaditemsubmit']) ?>
 <?php ActiveForm::end() ?>
 </div>