<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pasien;

/**
 * PasienSearch represents the model behind the search form of `app\models\Pasien`.
 */
class PasienSearch extends Pasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'simulasi_id', 'poli_id', 'next_poli_id'], 'integer'],
            [['tanggal', 'waktu_kedatangan', 'waktu_dilayani', 'waktu_selesai'], 'safe'],
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
        $query = Pasien::find();

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
            'poli_id' => $this->poli_id,
            'tanggal' => $this->tanggal,
            'waktu_kedatangan' => $this->waktu_kedatangan,
            'waktu_dilayani' => $this->waktu_dilayani,
            'waktu_selesai' => $this->waktu_selesai,
            'next_poli_id' => $this->next_poli_id,
        ]);

        return $dataProvider;
    }
}
