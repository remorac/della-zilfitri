<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "simulasi".
 *
 * @property int $id
 * @property string $nama
 * @property string|null $keterangan
 *
 * @property Pasien[] $pasiens
 * @property Poli[] $polis
 */
class Simulasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'simulasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['keterangan'], 'string'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[Pasiens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasiens()
    {
        return $this->hasMany(Pasien::className(), ['simulasi_id' => 'id']);
    }

    /**
     * Gets query for [[Polis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPolis()
    {
        return $this->hasMany(Poli::className(), ['simulasi_id' => 'id']);
    }
}
