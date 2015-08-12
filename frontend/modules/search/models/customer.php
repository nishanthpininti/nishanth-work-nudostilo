<?php
namespace frontend\modules\search\models;
class Customer extends \yii\elasticsearch\ActiveRecord
{
	/**
	 * @return array the list of attributes for this record
	 */
	public function attributes()
	{
		// path mapping for '_id' is setup to field 'id'
		return ['id','customer_user_name', 'customer_first_name','customer_last_name','customer_address1','customer_address2','customer_email', 'customer_gender','customer_from','customer_favcolor','customer_birthdate' ];
	}
	public function rules() {
		return [ [['customer_user_name', 'customer_first_name','customer_last_name','customer_address1','customer_address2','customer_email', 'customer_gender','customer_from','customer_favcolor','customer_birthdate'],'string','max' => 50],
				['id','safe'],
		 ];}

	/**
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