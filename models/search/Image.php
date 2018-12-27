<?php

namespace darealfive\media\models\search;

use darealfive\base\interfaces\Searchable;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use darealfive\media\models\base\Image as ImageModel;
use yii\data\BaseDataProvider;

/**
 * Image represents the model behind the search form of `darealfive\media\models\base\Image`.
 */
class Image extends ImageModel implements Searchable
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'alt', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search(array $params = []): BaseDataProvider
    {
        $query = $this::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alt', $this->alt]);

        return $dataProvider;
    }
}
