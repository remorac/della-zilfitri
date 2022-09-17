<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timeline".
 *
 * @property int $id
 * @property int $simulasi_id
 * @property string|null $waktu
 * @property int $poli_id
 * @property int $pasien_id
 * @property int $status 1 = datang, 2 = dilayani, 3 = selesai
 * @property int|null $durasi
 * @property int|null $jumlah_antri
 * @property int|null $jumlah_dilayani
 * @property int|null $jumlah_selesai
 *
 * @property Pasien $pasien
 * @property Poli $poli
 * @property Simulasi $simulasi
 */
class Timeline extends \yii\db\ActiveRecord
{
    const STATUS_DATANG = 1;
    const STATUS_DILAYANI = 2;
    const STATUS_SELESAI = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timeline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['simulasi_id', 'poli_id', 'pasien_id', 'status'], 'required'],
            [['simulasi_id', 'poli_id', 'pasien_id', 'status', 'durasi', 'jumlah_antri', 'jumlah_dilayani', 'jumlah_selesai'], 'integer'],
            [['waktu'], 'safe'],
            [['simulasi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Simulasi::className(), 'targetAttribute' => ['simulasi_id' => 'id']],
            [['poli_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poli::className(), 'targetAttribute' => ['poli_id' => 'id']],
            [['pasien_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::className(), 'targetAttribute' => ['pasien_id' => 'id']],
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
            'waktu' => 'Waktu',
            'poli_id' => 'Poli',
            'pasien_id' => 'Pasien',
            'status' => 'Status',
            'durasi' => 'Durasi',
            'jumlah_antri' => 'Jumlah Antri',
            'jumlah_dilayani' => 'Jumlah Dilayani',
            'jumlah_selesai' => 'Jumlah Selesai',
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
