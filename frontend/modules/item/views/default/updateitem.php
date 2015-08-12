<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\web\Session;
use frontend\modules\item\models\SuperCategory;
use frontend\modules\item\models\ItemList;
use frontend\modules\item\models\Item;
use frontend\modules\item\models\SubCategory;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$session = new Session;
$session->open();
$this->title = 'Update Item';
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){
	
	$('#itemnametextbox').keypress(function(e) {
    if(e.which == 13) {
		var itemid = document.getElementById('hiddenItemId').value;
		var itemname = document.getElementById('itemnametextbox').value;
		var itemmirrval = document.getElementById('itemmirrvallist').value;
		var itemhash = document.getElementById('itemhashtextbox').value;
        $.ajax({
				type:'POST',	            
	            url:'index.php?r=item/default/updateitemdata',
			    data:'itemid='+itemid+'&itemname='+itemname+'&itemmirrval='+itemmirrval+'&itemhash='+itemhash,
	            success:function(data) {
				},
				 error:function(jqXHR, textStatus, errorThrown){
				 alert('error::'+errorThrown);}
	         });
    }
	});
	
	$('#itemhashtextbox').keypress(function(e) {
    if(e.which == 13) {
		var itemid = document.getElementById('hiddenItemId').value;
		var itemname = document.getElementById('itemnametextbox').value;
		var itemmirrval = document.getElementById('itemmirrvallist').value;
		var itemhash = document.getElementById('itemhashtextbox').value;
        $.ajax({
				type:'POST',	            
	            url:'index.php?r=item/default/updateitemdata',
			    data:'itemid='+itemid+'&itemname='+itemname+'&itemmirrval='+itemmirrval+'&itemhash='+itemhash,
	            success:function(data) {
				},
				 error:function(jqXHR, textStatus, errorThrown){
				 alert('error::'+errorThrown);}
	         });
    }
	});
	
	
	$('#itemmirrvallist').on('change',function()
	{
		var itemid = document.getElementById('hiddenItemId').value;
		var itemname = document.getElementById('itemnametextbox').value;
		var itemmirrval = document.getElementById('itemmirrvallist').value;
		var itemhash = document.getElementById('itemhashtextbox').value;
        $.ajax({
				type:'POST',	            
	            url:'index.php?r=item/default/updateitemdata',
			    data:'itemid='+itemid+'&itemname='+itemname+'&itemmirrval='+itemmirrval+'&itemhash='+itemhash,
	            success:function(data) {
				},
				 error:function(jqXHR, textStatus, errorThrown){
				 alert('error::'+errorThrown);}
	         });
	});
	
	$('#itemcolorlist').on('change',function()
	{
		var color = document.getElementById('itemcolorlist').value;
		var itemid = document.getElementById('hiddenItemId').value;
		$.ajax({
				type:'POST',	            
	            url:'index.php?r=item/default/fetchsizes',
			    data:'itemid='+itemid+'&color='+color,
	            success:function(data) {
					$('#itemsizelist').empty().append(data);
				},
				 error:function(jqXHR, textStatus, errorThrown){
				 alert('error::'+errorThrown);}
	         });
	});
	
	$('#itemsizelist').on('change',function()
	{
		var color = document.getElementById('itemcolorlist').value;
		var itemid = document.getElementById('hiddenItemId').value;
		var size = document.getElementById('itemsizelist').value;
		window.location = "index.php?r=item/default/dummy&color="+color+"&itemid="+itemid+"&size="+size;
	});
	
	$('#deletesize').on('click',function(){
		if (confirm('Are you sure yo want to delete?')) {
        var idetailsid = document.getElementById('hiddenIdetailsId').value;
		var itemid = document.getElementById('hiddenItemId').value;
		$.ajax({
				type:'POST',	            
	            url:'index.php?r=item/default/deteteitemdetailrow',
			    data:'idetailsid='+idetailsid,
	            success:function(data) {
					alert(data);
					window.location = "index.php?r=item/default/updateitem&itemId="+itemid;
				},
				 error:function(jqXHR, textStatus, errorThrown){
				 alert('error::'+errorThrown);}
	         });
    }
	});
	
	$('#addcolor').on('click',function(){
		var itemid = document.getElementById('hiddenItemId').value;
		window.location = "index.php?r=item/default/showupdatenocolorselector&item_id="+itemid;
	});
	
});
JS;
$this->registerJs($script);
?>
<div id='maindiv'>
<input type='hidden' id="hiddenItemId" value = "<?= $itemData['item_id']?>"/>
<?= '<label class="control-label">Name</label>' ?>
<?= Html::activeInput('text',$itemModel, 'item_name',['style'=>'width:150px','value'=>$itemData['item_name'],'class' => 'form-control','id'=>'itemnametextbox'])?>
<br/>
<?= '<label class="control-label">Hashtag</label>' ?>
<?= Html::activeInput('text',$itemModel, 'item_hashTag',['style'=>'width:150px','value'=>$itemData['item_hashTag'],'class' => 'form-control','id'=>'itemhashtextbox'])?>
<br/>
<?= '<label class="control-label">Mirror Value</label>' ?>
<?php for($i=0;$i<sizeof($mirrorValues);$i++)
{
	if($itemData['item_mirrorval'] == $mirrorValues[$i])
	{
		$itemModel->item_mirrorval = $i;
		break;
	}
}
?>
<br/>
<?= Html::activeDropDownList($itemModel,'item_mirrorval',$mirrorValues,['id'=>'itemmirrvallist','style'=>'width:150px']) ?>
<br/><br/>
<?= '<label class="control-label">Select Color </label>' ?>
<br/>
<div class="row row-list" style="padding-left:15px;">
<div class="col-xs-4">
<select id="itemcolorlist" style="width:150px;">
<?php foreach($itemColors as $color) {?>
<option value="<?= $color['item_color'] ?>"><?= $color['item_color'] ?></option>
<?php } ?>
</select>
</div>
<div class="col-xs-4">
<?= Html::button('Add New Color',['class'=>'btn btn-primary','id'=>'addcolor']) ?>
</div>
</div>
<?= '<label class="control-label">Select size </label>' ?>
<br/>
<select id="itemsizelist" style="width:150px">
<option value="0">Select Size</option>
<?php foreach($itemSizes as $size) {?>
<option value="<?= $size['item_size'] ?>"><?= $size['item_size'] ?></option>
<?php } ?>
</select>
<!-- Update Item Details -->
<?php 
if($showupdatedetails)
{
$session = new Session;
$session->open();
?>
<div id="lightbox" style="position:absolute; width:100%">
<div class="row row-list">
<div class="col-xs-4">
<h4><?= 'Size  - '.$modelItemDetails->item_size ?></h4>
<h4><?= 'Color  - '.$modelItemDetails->item_color ?></h4>
</div>
<div class="col-xs-4">
<input type='hidden' id="hiddenIdetailsId" value = "<?= $modelItemDetails->idetails_id?>"/>
<?= Html::button('Delete this size',['class'=>'btn btn-primary','id'=>'deletesize']) ?>
</div>
</div>

<div class="row row-list">
	<div class="col-xs-4">
	<?php $rand = (new yii\base\Security)->generateRandomString(5);?>
	<?= Html::img($modelItemDetails->item_photo_front.'?dummy='.$rand,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	<?php $formImg = ActiveForm::begin(['method'=>'post','action'=>'index.php?r=item/default/updateimage&path='.$modelItemDetails->item_photo_front .'&item_id='.$itemData['item_id'],'options' => ['enctype' => 'multipart/form-data']]) ?>
	<?= $formImg->field($modelItemDetails, 'img')->fileInput(['accept' => 'image/*','style'=>'padding:0px;'])->label(false); ?>
	<?= Html::submitButton('Update Image',['class'=>'btn btn-primary']) ?>
	<?= Html::endForm() ?>
	</div>
	<div class="col-xs-4">
	<?php $rand = (new yii\base\Security)->generateRandomString(5);?>
	<?= Html::img($modelItemDetails->item_photo_back.'?dummy='.$rand,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	<?php $formImg = ActiveForm::begin(['method'=>'post','action'=>'index.php?r=item/default/updateimage&path='.$modelItemDetails->item_photo_back .'&item_id='.$itemData['item_id'],'options' => ['enctype' => 'multipart/form-data']]) ?>
	<?= $formImg->field($modelItemDetails, 'img')->fileInput(['accept' => 'image/*','style'=>'padding:0px;'])->label(false); ?>
	<?= Html::submitButton('Update Image',['class'=>'btn btn-primary']) ?>
	<?= Html::endForm() ?>
	</div>
	<div class="col-xs-4">
	<?php $rand = (new yii\base\Security)->generateRandomString(5);?>
	<?= Html::img($modelItemDetails->item_photo_model1.'?dummy='.$rand,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	<?php $formImg = ActiveForm::begin(['method'=>'post','action'=>'index.php?r=item/default/updateimage&path='.$modelItemDetails->item_photo_model1 .'&item_id='.$itemData['item_id'],'options' => ['enctype' => 'multipart/form-data']]) ?>
	<?= $formImg->field($modelItemDetails, 'img')->fileInput(['accept' => 'image/*','style'=>'padding:0px;'])->label(false); ?>
	<?= Html::submitButton('Update Image',['class'=>'btn btn-primary']) ?>
	<?= Html::endForm() ?>
	</div>
	<div class="col-xs-4">
	<?php $rand = (new yii\base\Security)->generateRandomString(5);?>
	<?= Html::img($modelItemDetails->item_photo_model2.'?dummy='.$rand,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	<?php $formImg = ActiveForm::begin(['method'=>'post','action'=>'index.php?r=item/default/updateimage&path='.$modelItemDetails->item_photo_model2 .'&item_id='.$itemData['item_id'],'options' => ['enctype' => 'multipart/form-data']]) ?>
	<?= $formImg->field($modelItemDetails, 'img')->fileInput(['accept' => 'image/*','style'=>'padding:0px;'])->label(false); ?>
	<?= Html::submitButton('Update Image',['class'=>'btn btn-primary']) ?>
	<?= Html::endForm() ?>
	</div>
	<div class="col-xs-4">
	<?php $rand = (new yii\base\Security)->generateRandomString(5);?>
	<?= Html::img($modelItemDetails->item_photo_model3.'?dummy='.$rand,['width'=>200,'height'=>200, 'style'=>'padding:10px']);?>
	<?php $formImg = ActiveForm::begin(['method'=>'post','action'=>'index.php?r=item/default/updateimage&path='.$modelItemDetails->item_photo_model3 .'&item_id='.$itemData['item_id'],'options' => ['enctype' => 'multipart/form-data']]) ?>
	<?= $formImg->field($modelItemDetails, 'img')->fileInput(['accept' => 'image/*','style'=>'padding:0px;'])->label(false); ?>
	<?= Html::submitButton('Update Image',['class'=>'btn btn-primary']) ?>
	<?= Html::endForm() ?>
	</div>
</div>

<?php $form = ActiveForm::begin(['method'=>'post','action'=>'','options' => ['enctype' => 'multipart/form-data']]) ?>
 <div class="row row-list">
 <div class="col-xs-4">
 <?= $form->field($modelItemDetails, 'item_price')->textInput(['style'=>'width:100px']); ?>
 <?= $form->field($modelItemDetails, 'item_desc')->textArea(['style'=>'width:100px']); ?>
 <?= $form->field($modelItemDetails, 'item_discountPrice')->textInput(['style'=>'width:100px']); ?>
 <?= $form->field($modelItemDetails, 'item_discountPer')->textInput(['style'=>'width:100px']); ?>
 <?= $form->field($modelItemDetails, 'item_available_qnt')->textInput(['style'=>'width:100px']); ?>
 </div>
 <div class="col-xs-4">
 <?php  
		for($i=0;$i<sizeof($modelItemDetails->specificAttrValVar);$i++)
		{
		 echo $form->field($modelItemDetails, 'specificAttrValVar['.$i.']['.$specificAttrName[$i].']')->textInput(['style'=>'width:100px'])->label($specificAttrName[$i]); 
		}
		?>
 </div>
 </div>
 <?= Html::submitButton('Update Item',['class'=>'btn btn-primary','id'=>'uploaditemsubmit']) ?>
 <?php ActiveForm::end() ?>
 </div>
 <?php }?>
</div>
<br/>
<!-- Show color number selector -->
<?php if($showColorNumberSelection) { ?>
<?= Html::beginForm(['default/showupdatecolorsizeimage','item_id'=>$itemData['item_id']], 'post') ?>
<?= Html::activeDropDownList($itemModel,'numberOfColors',$colorNumbers,['onchange'=>'this.form.submit()','prompt'=>'--Choose Number of Colors--']) ?>
<?= Html::endForm() ?>
<br/>
<?php if($showColorSizeImageSelection){?>
<?php 
$form = ActiveForm::begin(['method' => 'post', 'action' => 'index.php?r=item/default/insetitem&sub_cat_it='.$itemModel->item_sub_category_id .'&item_name='.$itemModel->item_name .'&item_mirrVal='.$itemModel->item_mirrorval .'&item_no_of_colors='.$itemModel->numberOfColors.'&item_id='.$itemModel->item_id.'&item_hash='.$itemModel->item_hashTag,'options' => ['enctype' => 'multipart/form-data']]);
for($i=0;$i<$colorNumbers[$itemModel->numberOfColors];$i++)
{
?>
<?= '<label class="control-label">Enter Details of Item '.($i+1).'</label>' ?><br/>
<?= Html::activeDropDownList($itemModel,'itemColors['.$i.']',
      yii\helpers\ArrayHelper::map($colors, 'color_name', 'color_name'),['prompt'=>'--Choose color--']) ?>

<table>
<tr>
<td>
<?= $form->field($itemModel, 'itemImgFront['.$i.']')->fileInput(['accept' => 'image/*','style'=>'padding:0px;']); ?>
</td>
<td>
<?= $form->field($itemModel, 'itemImgBack['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
<td>
<?= $form->field($itemModel, 'itemImgModel1['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
<td>
<?= $form->field($itemModel, 'itemImgModel2['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
<td>
<?= $form->field($itemModel, 'itemImgModel3['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
</tr>
</table>
<?= $form->field($itemModel, 'itemSize['.$i.']')->checkboxList(['XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL']); ?>
<?php	
}
echo Html::submitButton('Upload Item',['class'=>'btn btn-primary','id'=>'uploaditemsubmit']);
ActiveForm::end();
?>
<?=  $itemModel->item_name.' '.$itemModel->item_mirrorval .' '. $itemModel->numberOfColors ?>
<?php } }	?>