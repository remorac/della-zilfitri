<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Timeline;

/**
 * TimelineSearch represents the model behind the search form of `app\models\Timeline`.
 */
class TimelineSearch extends Timeline
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'simulasi_id', 'poli_id', 'pasien_id', 'status', 'jumlah_antrian'], 'integer'],
            [['waktu'], 'safe'],
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
    public function search($params)
    {
        $query = Timeline::find();

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
            'id' => $this->id,
            'simulasi_id' => $this->simulasi_id,
            'waktu' => $this->waktu,
            'poli_id' => $this->poli_id,
            'pasien_id' => $this->pasien_id,
            'status' => $this->status,
            'jumlah_antrian' => $this->jumlah_antrian,
        ]);

        return $dataProvider;
    }
}
