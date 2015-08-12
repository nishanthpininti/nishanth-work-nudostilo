<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `backend\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name', 'customer_first_name', 'customer_last_name', 'customer_address1', 'customer_address2', 'customer_email', 'customer_gender', 'customer_from', 'customer_favcolor', 'customer_birthdate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'customer_birthdate' => $this->customer_birthdate,
        ]);

        $query->andFilterWhere(['like', 'customer_user_name', $this->customer_user_name])
            ->andFilterWhere(['like', 'customer_first_name', $this->customer_first_name])
            ->andFilterWhere(['like', 'customer_last_name', $this->customer_last_name])
            ->andFilterWhere(['like', 'customer_address1', $this->customer_address1])
            ->andFilterWhere(['like', 'customer_address2', $this->customer_address2])
            ->andFilterWhere(['like', 'customer_email', $this->customer_email])
            ->andFilterWhere(['like', 'customer_gender', $this->customer_gender])
            ->andFilterWhere(['like', 'customer_from', $this->customer_from])
            ->andFilterWhere(['like', 'customer_favcolor', $this->customer_favcolor]);

        return $dataProvider;
    }
}
