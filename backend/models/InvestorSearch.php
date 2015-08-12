<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Investor;

/**
 * InvestorSearch represents the model behind the search form about `backend\models\Investor`.
 */
class InvestorSearch extends Investor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['investor_user_name', 'investor_first_name', 'investor_last_name', 'investor_address1', 'investor_address2', 'investor_email', 'investor_gender'], 'safe'],
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
        $query = Investor::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'investor_user_name', $this->investor_user_name])
            ->andFilterWhere(['like', 'investor_first_name', $this->investor_first_name])
            ->andFilterWhere(['like', 'investor_last_name', $this->investor_last_name])
            ->andFilterWhere(['like', 'investor_address1', $this->investor_address1])
            ->andFilterWhere(['like', 'investor_address2', $this->investor_address2])
            ->andFilterWhere(['like', 'investor_email', $this->investor_email])
            ->andFilterWhere(['like', 'investor_gender', $this->investor_gender]);

        return $dataProvider;
    }
}
