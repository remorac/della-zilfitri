<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id
 * @property int $simulasi_id
 * @property int $poli_id
 * @property string $tanggal
 * @property string $waktu_kedatangan
 * @property string $waktu_dilayani
 * @property string $waktu_selesai
 * @property int|null $next_poli_id
 *
 * @property Poli $nextPoli
 * @property Poli $poli
 * @property Simulasi $simulasi
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['simulasi_id', 'poli_id', 'tanggal', 'waktu_kedatangan', 'waktu_dilayani', 'waktu_selesai'], 'required'],
            [['simulasi_id', 'poli_id', 'next_poli_id'], 'integer'],
            [['tanggal', 'waktu_kedatangan', 'waktu_dilayani', 'waktu_selesai'], 'safe'],
            [['poli_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poli::className(), 'targetAttribute' => ['poli_id' => 'id']],
            [['next_poli_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poli::className(), 'targetAttribute' => ['next_poli_id' => 'id']],
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
            'poli_id' => 'Poli ID',
            'tanggal' => 'Tanggal',
            'waktu_kedatangan' => 'Waktu Kedatangan',
            'waktu_dilayani' => 'Waktu Dilayani',
            'waktu_selesai' => 'Waktu Selesai',
            'next_poli_id' => 'Next Poli ID',
        ];
    }

    /**
     * Gets query for [[NextPoli]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNextPoli()
    {
        return $this->hasOne(Poli::className(), ['id' => 'next_poli_id']);
    }

    /**
     * Gets query for [[Poli]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoli()
    {
        return $this->hasOne(Poli::className(), ['id' => 'poli_id']);
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
}
