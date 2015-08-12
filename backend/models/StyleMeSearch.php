<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StyleMe;

/**
 * StyleMeSearch represents the model behind the search form about `backend\models\StyleMe`.
 */
class StyleMeSearch extends StyleMe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['style_me_id', 'style_id'], 'integer'],
            [['customer_user_name1', 'customer_user_name2', 'my_comment', 'friends_comment', 'end_date', 'completion_status'], 'safe'],
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
        $query = StyleMe::find();

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
            'style_me_id' => $this->style_me_id,
            'style_id' => $this->style_id,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'customer_user_name1', $this->customer_user_name1])
            ->andFilterWhere(['like', 'customer_user_name2', $this->customer_user_name2])
            ->andFilterWhere(['like', 'my_comment', $this->my_comment])
            ->andFilterWhere(['like', 'friends_comment', $this->friends_comment])
            ->andFilterWhere(['like', 'completion_status', $this->completion_status]);

        return $dataProvider;
    }
}
