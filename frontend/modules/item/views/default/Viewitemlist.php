<?php
/* @var $this yii\web\View */

use yii\helpers\html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
    <?php
        $index=0;
       foreach ($list as $designerRow){
                            $category =$designerRow->item_sub_category_id;
                            if ($index==0){
                                $lastCategory=$designerRow->item_sub_category_id;
                                //Echo 'inside index'; 
                                Echo '<div>';
                                Echo '<h2>'.'sub category'.$category. '</h2>'. '</div>';
                                Echo '<div class="row">';
                                $index+=1;
                            }
                            if ($category===$lastCategory){
                                //echo '$lastcat is'. $lastCategory .'cat is' .$category;
            				    Echo '<div class="col-sm-3">';
                                // Echo '<h2>'.'sub category'.$category. '</h2>'.'<br></br>';
            				    Echo '<p>'.'<img src="images/designerProfile/a.jpg" height="100px" border="5" >'.'</p>';
            				    //$len= (string) $length;
            				    //print_r ($length);
                                Echo ' <p>'.$designerRow->item_id. '</p>';  
                                Echo ' <p>'.$designerRow->item_name. '</p>'; 
                                
                			    Echo ' <p>'.$designerRow->item_price. '</p>';
                			    Echo ' <p>'.$designerRow->item_color. '</p>';
                			    
                                Echo '</div>' ;
                                $latecategory=$category;
                           }
                           if($category!==$lastCategory){
                                Echo '</div>' ; Echo '<br>';
                               // echo '$lastcat is'. $lastCategory .'cat is' .$category;
                               Echo '<h2>'.'sub category '.$category. '</h2>';
                                
                                Echo '<div class="row">';
                                Echo '<div class="col-sm-3">';
                                Echo '<p>'.'<img src="images/designerProfile/a.jpg" height="100px" border="5" >'.'</p>';
                                
                                Echo ' <p>'.$designerRow->item_id. '</p>';  
                                Echo ' <p>'.$designerRow->item_name. '</p>'; 
                                
                                Echo ' <p>'.$designerRow->item_price. '</p>';
                                Echo ' <p>'.$designerRow->item_color. '</p>';
                                Echo '</div>' ;
                                $lastCategory=$category;
                           }
                		}
                ?>
        </div>

    </div>

