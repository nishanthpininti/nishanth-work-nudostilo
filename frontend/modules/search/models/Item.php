<?php
namespace frontend\modules\search\models;
class Item extends \yii\elasticsearch\ActiveRecord
{
    /**
     * @return array the list of attributes for this record
     */
    public function attributes()
    {
        // path mapping for '_id' is setup to field 'id'
        return ['id','item_id','item_name','default_photo','item_mirrorval','item_designer_id','item_sub_category_id','item_hashTag','item_upload_time','item_color','item_size','item_desc','item_photo_front','item_photo_back','item_photo_model1','item_photo_model2','item_photo_model3','item_available_qnt','item_discountPrice','item_discountPer','item_specificattribute','designer_first_name'];
    }
     public function rules() {
        return [[['item_name','default_photo','item_mirrorval','item_designer_id','item_sub_category_id','item_hashTag','item_upload_time','item_color','item_size','item_desc','item_photo_front','item_photo_back','item_photo_model1','item_photo_model2','item_photo_model3','item_available_qnt','item_discountPrice','item_discountPer','item_specificattribute','designer_first_name'],'string'],
                [['id','item_id'],'safe'],
                //['item_price','double'],
         ];} 

        /*   public static function index() {
            return "[ 'mapping' => [ 
                     'item' => [
                    'properties' => [ 
                            'item_price' => [
                    'type' => 'string',
                    'index' => 'not_analyzed',
            ],]]]
                    ]";
        } */  
    /**s
     * @return ActiveQuery defines a relation to the Order record (can be in other database, e.g. redis or sql)
     */
    /* public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id'])->orderBy('id');
    } */

    /**
     * Defines a scope that modifies the `$query` to return only active(status = 1) customers
     */
    public static function active($query)
    {
        $query->andWhere(['status' => 1]);
    }
}
?>
