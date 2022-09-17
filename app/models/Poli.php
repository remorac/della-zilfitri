<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "poli".
 *
 * @property int $id
 * @property int|null $simulasi_id
 * @property string $nama_poli
 * @property int $jumlah_loket
 * @property string $waktu_buka
 * @property string $waktu_tutup
 * @property string|null $waktu_mulai_istirahat
 * @property string|null $waktu_selesai_istirahat
 * @property int|null $durasi_pelayanan_min
 * @property int|null $durasi_pelayanan_max
 *
 * @property PasienPoli[] $pasienPolis
 * @property Simulasi $simulasi
 * @property Timeline[] $timelines
 */
class Poli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'poli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['simulasi_id', 'jumlah_loket', 'durasi_pelayanan_min', 'durasi_pelayanan_max'], 'integer'],
            [['nama_poli'], 'required'],
            [['waktu_buka', 'waktu_tutup', 'waktu_mulai_istirahat', 'waktu_selesai_istirahat'], 'safe'],
            [['nama_poli'], 'string', 'max' => 255],
            [['simulasi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Simulasi::className(), 'targetAttribute' => ['simulasi_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'simulasi_id' => 'Simulasi ID',
            'nama_poli' => 'Nama Poli',
            'jumlah_loket' => 'Jumlah Loket',
            'waktu_buka' => 'Waktu Buka',
            'waktu_tutup' => 'Waktu Tutup',
            'waktu_mulai_istirahat' => 'Waktu Mulai Istirahat',
            'waktu_selesai_istirahat' => 'Waktu Selesai Istirahat',
            'durasi_pelayanan_min' => 'Durasi Pelayanan Min',
            'durasi_pelayanan_max' => 'Durasi Pelayanan Max',
        ];
    }

    /**
     * Gets query for [[PasienPolis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasienPolis()
    {
        return $this->hasMany(PasienPoli::className(), ['poli_id' => 'id']);
    }

    /**
     * Gets query for [[Simulasi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSimulasi()
    {
        return $this->hasOne(Simulasi::className(), ['id' => 'simulasi_id']);
    }

    /**
     * Gets query for [[Timelines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimelines()
    {
        return $this->hasMany(Timeline::className(), ['poli_id' => 'id']);
    }
}
