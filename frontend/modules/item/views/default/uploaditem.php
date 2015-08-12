<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\Session;
use kartik\select2\Select2;
use frontend\modules\item\models\SuperCategory;
use frontend\modules\item\models\ItemList;
use frontend\modules\item\models\Item;
use frontend\modules\item\models\SubCategory;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$session = new Session;
$session->open();
$this->title = 'Upload Item';
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){
});
JS;
$this->registerJs($script);
?>
<!--Super category dropdown-->
<?= Html::beginForm(['default/selectcategory'], 'post') ?>
<?= Html::activeDropDownList($super_cat_model,'super_category_id',
      yii\helpers\ArrayHelper::map($superCategoryData, 'super_category_id', 'super_category_name'),['onchange'=>'this.form.submit()','prompt'=>'--Choose Upload Type--']) ?>
<?= Html::endForm() ?>
<br/>
<!-- Category dropdown -->
<?php if($showCategory) { ?>
<?= Html::beginForm(['default/selectsubcategory','super_cat_id'=>$super_cat_model->super_category_id], 'post') ?>
<?= Html::activeDropDownList($category_model,'category_id',
      yii\helpers\ArrayHelper::map($categoryData, 'category_id', 'category_name'),['onchange'=>'this.form.submit()','prompt'=>'--Choose Category Type--']) ?>
<?= Html::endForm() ?>
<br/>
<!-- SubCategory Drop Down -->
<?php if($showSubCategory) { ?>
<?= Html::beginForm(['default/selectnumberofcolors','super_cat_id'=>$super_cat_model->super_category_id,'cat_id'=>$category_model->category_id], 'post') ?>
<?= Html::activeDropDownList($SubCategory_model,'sub_category_id',
      yii\helpers\ArrayHelper::map($SubcategoryData, 'sub_category_id', 'sub_category_name'),['onchange'=>'this.form.submit()','prompt'=>'--Choose Sub Category Type--']) ?>
<?= Html::endForm() ?>
<br/>
<!-- Show color number selector -->
<?php if($showColorNumberSelection) { ?>
<?= Html::beginForm(['default/showcolorsizeimage','super_cat_id'=>$super_cat_model->super_category_id,'cat_id'=>$category_model->category_id,'sub_cat_it'=>$SubCategory_model->sub_category_id], 'post') ?>
Name of Product: <?= Html::activeInput('text',$modelItem, 'item_name',['style'=>'width:100px'])?><br/><br/>
Product Hashtag: <?= Html::activeInput('text',$modelItem, 'item_hashTag',['style'=>'width:100px'])?>
<br/><br/>
<?= Html::activeDropDownList($modelItem,'item_mirrorval',$mirrorValues,['prompt'=>'--Choose Mirror Value--']) ?>
<br/><br/>
<?= Html::activeDropDownList($modelItem,'numberOfColors',$colorNumbers,['onchange'=>'this.form.submit()','prompt'=>'--Choose Number of Colors--']) ?>
<?= Html::endForm() ?>
<br/>
<?php if($showColorSizeImageSelection){?>
<?php 
$form = ActiveForm::begin(['method' => 'post', 'action' => 'index.php?r=item/default/insetitem&sub_cat_it='.$SubCategory_model->sub_category_id .'&item_name='.$modelItem->item_name .'&item_mirrVal='.$modelItem->item_mirrorval .'&item_no_of_colors='.$modelItem->numberOfColors.'&item_id=new&item_hash='.$modelItem->item_hashTag,'options' => ['enctype' => 'multipart/form-data']]);
for($i=0;$i<$colorNumbers[$modelItem->numberOfColors];$i++)
{
?>
<?= '<label class="control-label">Enter Details of Item '.($i+1).'</label>' ?><br/>
<?= Html::activeDropDownList($modelItem,'itemColors['.$i.']',
      yii\helpers\ArrayHelper::map($colors, 'color_name', 'color_name'),['prompt'=>'--Choose color--']) ?><br/>
<table>
<tr>
<td>
<?= $form->field($modelItem, 'itemImgFront['.$i.']')->fileInput(['accept' => 'image/*','style'=>'padding:0px;']); ?>
</td>
<td>
<?= $form->field($modelItem, 'itemImgBack['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
<td>
<?= $form->field($modelItem, 'itemImgModel1['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
<td>
<?= $form->field($modelItem, 'itemImgModel2['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
<td>
<?= $form->field($modelItem, 'itemImgModel3['.$i.']')->fileInput(['accept' => 'image/*']); ?>
</td>
</tr>
</table>
<?= $form->field($modelItem, 'itemSize['.$i.']')->checkboxList(['XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL']); ?>
<?php	
}
echo Html::submitButton('Upload Item',['class'=>'btn btn-primary','id'=>'uploaditemsubmit']);
ActiveForm::end();
?>
<?=  $modelItem->item_name.' '.$modelItem->item_mirrorval .' '. $modelItem->numberOfColors ?>
<?php } ?>
<!-- If end of color number selector --><?php } ?>
<!--If end of SubCategory--><?php } ?>
<!--If end of Category--><?php } ?>
<br/>



  

  
  
