<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id
 * @property int $simulasi_id
 * @property string $nama_pasien
 * @property string $waktu_kedatangan
 *
 * @property PasienPoli[] $pasienPolis
 * @property Simulasi $simulasi
 */
class Pasien extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;
    
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
            [['simulasi_id', 'nama_pasien', 'waktu_kedatangan'], 'required'],
            [['simulasi_id'], 'integer'],
            [['nama_pasien', 'waktu_kedatangan'], 'safe'],
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
            'nama_pasien' => 'Nama Pasien',
            'waktu_kedatangan' => 'Waktu Kedatangan',
        ];
    }

    /**
     * Gets query for [[PasienPolis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasienPolis()
    {
        return $this->hasMany(PasienPoli::className(), ['pasien_id' => 'id']);
    }
    public function setPasienPolis($value)
    {
        $this->loadRelated('pasienPolis', $value);
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

    public function getPasienPolisText()
    {
        $array = [];
        foreach ($this->pasienPolis as $pasienPoli) {
            $array[] = $pasienPoli->poli->nama_poli;
        }
        return implode(', ', $array);
    }
}
