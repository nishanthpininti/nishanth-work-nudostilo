<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
?>

     <div class="modal fade" id="editModal" role="dialog">
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


   $form1 = ActiveForm::begin(['id' => 'activePayment',
  		'action'=>'index.php?r=/cart/default/newcard'
  		
  ]) ?>
                
                <?= $form1->field($model1, 'name_on_card')?>
                <?= $form1->field($model1, 'creditcard_no')?>
                <?= $form1->field($model1, 'billing_address')?>
                <?= $form1->field($model1, 'billing_id')->hiddenInput()->label(false);?>
                <?= $form1->field($model1, 'customer_usr_name')->hiddenInput()->label(false);?>
                <?= $form1->field($model1, 'creditcard_expdate')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd'])?>
               
                
                <div class="form-group1">
                    <?= Html::submitButton('submit', ['class' => 'btn btn-warning editsubmit', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
            </div>
            </div> 