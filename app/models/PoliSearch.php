<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Poli;

/**
 * PoliSearch represents the model behind the search form of `app\models\Poli`.
 */
class PoliSearch extends Poli
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'simulasi_id', 'jumlah_loket', 'durasi_pelayanan_min', 'durasi_pelayanan_max'], 'integer'],
            [['nama_poli', 'waktu_buka', 'waktu_tutup', 'waktu_mulai_istirahat', 'waktu_selesai_istirahat'], 'safe'],
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
        $query = Poli::find();

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
            'jumlah_loket' => $this->jumlah_loket,
            'waktu_buka' => $this->waktu_buka,
            'waktu_tutup' => $this->waktu_tutup,
            'waktu_mulai_istirahat' => $this->waktu_mulai_istirahat,
            'waktu_selesai_istirahat' => $this->waktu_selesai_istirahat,
            'durasi_pelayanan_min' => $this->durasi_pelayanan_min,
            'durasi_pelayanan_max' => $this->durasi_pelayanan_max,
        ]);

        $query->andFilterWhere(['like', 'nama_poli', $this->nama_poli]);

        return $dataProvider;
    }
}
