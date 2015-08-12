<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Designer;

/**
 * DesignerSearch represents the model behind the search form about `backend\models\Designer`.
 */
class DesignerSearch extends Designer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['designer_user_name', 'designer_first_name', 'designer_last_name', 'designer_address1', 'designer_address2', 'designer_email', 'designer_gender', 'designer_from', 'designer_favcolor', 'designer_birthdate'], 'safe'],
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
        $query = Designer::find();

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
            'designer_birthdate' => $this->designer_birthdate,
        ]);

        $query->andFilterWhere(['like', 'designer_user_name', $this->designer_user_name])
            ->andFilterWhere(['like', 'designer_first_name', $this->designer_first_name])
            ->andFilterWhere(['like', 'designer_last_name', $this->designer_last_name])
            ->andFilterWhere(['like', 'designer_address1', $this->designer_address1])
            ->andFilterWhere(['like', 'designer_address2', $this->designer_address2])
            ->andFilterWhere(['like', 'designer_email', $this->designer_email])
            ->andFilterWhere(['like', 'designer_gender', $this->designer_gender])
            ->andFilterWhere(['like', 'designer_from', $this->designer_from])
            ->andFilterWhere(['like', 'designer_favcolor', $this->designer_favcolor]);

        return $dataProvider;
    }
}
