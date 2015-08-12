<?php

namespace frontend\modules\profile\models;

use Yii;

/**
 * This is the model class for table "cust_des_endorsement".
 *
 * @property string $customer_user_name
 * @property string $designer_user_name
 * @property double $sense_of_fashion
 * @property double $sense_of_style
 * @property double $decisiveness
 * @property double $creativity
 *
 * @property Designer $designerUserName
 * @property Customer $customerUserName
 */
class CustDesEndorsement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cust_des_endorsement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['customer_user_name', 'designer_user_name'], 'required'],
            [['sense_of_fashion', 'sense_of_style', 'decisiveness', 'creativity'], 'number'],
            [['customer_user_name', 'designer_user_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_user_name' => 'Customer User Name',
            'designer_user_name' => 'Designer User Name',
            'sense_of_fashion' => 'Sense Of Fashion',
            'sense_of_style' => 'Sense Of Style',
            'decisiveness' => 'Decisiveness',
            'creativity' => 'Creativity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignerUserName()
    {
        return $this->hasOne(Designer::className(), ['designer_user_name' => 'designer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_user_name']);
    }
	
	public function getDesignerendorsementbyme($username1,$username2)
	{
		$myEvaluations = CustDesEndorsement::find()->where(['designer_user_name' => $username1, 'customer_user_name' => $username2])->one();
		return $myEvaluations;
	}
	
	public function updateDesignerRating($username1, $username2, $rating, $ratingField)
	{
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('cust_des_endorsement', [$ratingField => $rating], 'designer_user_name="'.$username1.'" and customer_user_name="'.$username2.'"')->execute();
		return true;
	}
	
	public function calculateSaveOverallRating($ratingfield,$username)
	{
		$connection=\Yii::$app->db;
		$command = $connection->createCommand("SELECT sum(".$ratingfield.") FROM cust_des_endorsement where designer_user_name='".$username."'");
		$sum = $command->queryScalar();
		$count = CustDesEndorsement::find()->where(['designer_user_name' => $username])->count();
		if($count>0)
		{
		$newrating = ($sum/$count);
		}
		else
		{
		$newrating = 0;	
		}
		$connection ->createCommand()->update('endorsement', [$ratingfield => $newrating], 'user_name ="'.$username.'"')->execute();
		return $newrating;
	}
	
	public function showEndorsementToCustomer($customerusername,$designerusername)
	{
		$count = CustDesEndorsement::find()->where(['customer_user_name' => $customerusername,'designer_user_name' => $designerusername])->count();
		if($count > 0)
		{
			return true;
		}
		return false;
	}
}
