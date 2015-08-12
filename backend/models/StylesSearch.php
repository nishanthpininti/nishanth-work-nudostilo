<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Styles;

/**
 * StylesSearch represents the model behind the search form about `backend\models\Styles`.
 */
class StylesSearch extends Styles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['style_id', 'item_id'], 'integer'],
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
        $query = Styles::find();

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
            'style_id' => $this->style_id,
            'item_id' => $this->item_id,
        ]);

        return $dataProvider;
    }
}
