<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Share;

/**
 * ShareSearch represents the model behind the search form about `backend\models\Share`.
 */
class ShareSearch extends Share
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['share_id', 'style_id'], 'integer'],
            [['customer_user_name', 'scope', 'time_stamp'], 'safe'],
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
        $query = Share::find();

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
            'share_id' => $this->share_id,
            'style_id' => $this->style_id,
            'time_stamp' => $this->time_stamp,
        ]);

        $query->andFilterWhere(['like', 'customer_user_name', $this->customer_user_name])
            ->andFilterWhere(['like', 'scope', $this->scope]);

        return $dataProvider;
    }
}
