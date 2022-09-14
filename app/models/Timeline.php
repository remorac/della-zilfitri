<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timeline".
 *
 * @property int $id
 * @property int $simulasi_id
 * @property string $waktu
 * @property int $poli_id
 * @property int|null $pasien_id
 * @property int|null $status 1 = mulai dilayani, 2 = selesai dilayani
 * @property int $jumlah_antrian
 *
 * @property Pasien $pasien
 * @property Poli $poli
 * @property Simulasi $simulasi
 */
class Timeline extends \yii\db\ActiveRecord
{
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
            [['simulasi_id', 'waktu', 'poli_id', 'jumlah_antrian'], 'required'],
            [['simulasi_id', 'poli_id', 'pasien_id', 'status', 'jumlah_antrian'], 'integer'],
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
            'poli_id' => 'Poli ID',
            'pasien_id' => 'Pasien ID',
            'status' => 'Status',
            'jumlah_antrian' => 'Jumlah Antrian',
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
