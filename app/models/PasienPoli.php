<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien_poli".
 *
 * @property int $id
 * @property int $pasien_id
 * @property int $poli_id
 * @property string|null $waktu_kedatangan
 * @property string|null $waktu_dilayani
 * @property string|null $waktu_selesai
 *
 * @property Pasien $pasien
 * @property Poli $poli
 */
class PasienPoli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien_poli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [[/* 'pasien_id', */ 'poli_id'], 'required'],
            [['pasien_id', 'poli_id'], 'integer'],
            [['waktu_kedatangan', 'waktu_dilayani', 'waktu_selesai'], 'safe'],
            [['pasien_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::className(), 'targetAttribute' => ['pasien_id' => 'id']],
            [['poli_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poli::className(), 'targetAttribute' => ['poli_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pasien_id' => 'Pasien ID',
            'poli_id' => 'Poli ID',
            'waktu_kedatangan' => 'Waktu Kedatangan',
            'waktu_dilayani' => 'Waktu Dilayani',
            'waktu_selesai' => 'Waktu Selesai',
        ];
    }

    /**
     * Gets query for [[Pasien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['id' => 'pasien_id']);
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
}
