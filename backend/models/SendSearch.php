<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Send;

/**
 * SendSearch represents the model behind the search form about `backend\models\Send`.
 */
class SendSearch extends Send
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name1', 'customer_user_name2'], 'safe'],
            [['sytle_id'], 'integer'],
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
        $query = Send::find();

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
            'sytle_id' => $this->sytle_id,
        ]);

        $query->andFilterWhere(['like', 'customer_user_name1', $this->customer_user_name1])
            ->andFilterWhere(['like', 'customer_user_name2', $this->customer_user_name2]);

        return $dataProvider;
    }
}
