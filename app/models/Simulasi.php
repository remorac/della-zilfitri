<?php

namespace app\models;

use Yii;
use yii\debug\TimelineAsset;

/**
 * This is the model class for table "simulasi".
 *
 * @property int $id
 * @property string $nama
 * @property string $tanggal
 * @property string|null $keterangan
 *
 * @property Pasien[] $pasiens
 * @property Poli[] $polis
 * @property Timeline[] $timelines
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
            [['nama', 'tanggal'], 'required'],
            [['tanggal'], 'safe'],
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
            'nama' => 'Nama Simulasi',
            'tanggal' => 'Tanggal',
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

    /**
     * Gets query for [[Timelines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimelines()
    {
        return $this->hasMany(Timeline::className(), ['simulasi_id' => 'id']);
    }

    public function populateTimelines()
    {
        Timeline::deleteAll(['simulasi_id' => $this->id]);
        foreach ($this->pasiens as $pasien) {
            $first = true;
            foreach ($pasien->pasienPolis as $pasienPoli) {

                $timeline                 = new Timeline();
                $timeline->simulasi_id    = $this->id;
                $timeline->poli_id        = $pasienPoli->poli_id;
                $timeline->pasien_id      = $pasienPoli->pasien_id;
                $timeline->status         = Timeline::STATUS_DATANG;
                if ($first) $timeline->waktu = $pasien->waktu_kedatangan;
                $timeline->save();

                $timeline              = new Timeline();
                $timeline->simulasi_id = $this->id;
                $timeline->poli_id     = $pasienPoli->poli_id;
                $timeline->pasien_id   = $pasienPoli->pasien_id;
                $timeline->status      = Timeline::STATUS_DILAYANI;
                $timeline->save();

                $timeline              = new Timeline();
                $timeline->simulasi_id = $this->id;
                $timeline->poli_id     = $pasienPoli->poli_id;
                $timeline->pasien_id   = $pasienPoli->pasien_id;
                $timeline->status      = Timeline::STATUS_SELESAI;
                $timeline->save();

                $first = false;
            }
        }
        return;
    }

    public function setTimes()
    {
        $done = false;

        while (!$done) {
            $timelines = Timeline::find()->where(['waktu' => null])->all();
            if (!$timelines) $done = true;

            if (!$done) {
                $timelineArrived = Timeline::find()->where([
                    'simulasi_id' => $this->id,
                    'status'      => Timeline::STATUS_DATANG,
                ])->andWhere(['is not', 'waktu', null])->orderBy('waktu ASC')->one();

                if (!$timelineArrived) continue;

                $timelineServed = Timeline::find()->where([
                    'simulasi_id' => $this->id,
                    'poli_id'     => $timelineArrived->poli_id,
                    'pasien_id'   => $timelineArrived->pasien_id,
                    'status'      => Timeline::STATUS_DILAYANI,
                    'waktu'       => null,
                ])->one();

                $offset = 1;
                while (!$timelineServed) {

                    $timelineArrived = Timeline::find()->where([
                        'simulasi_id' => $this->id,
                        'status'      => Timeline::STATUS_DATANG,
                        ])->andWhere(['is not', 'waktu', null])->offset($offset)->orderBy('waktu ASC')->one();

                    if ($timelineArrived) {
                        $timelineServed = Timeline::find()->where([
                            'simulasi_id' => $this->id,
                            'poli_id'     => $timelineArrived->poli_id,
                            'pasien_id'   => $timelineArrived->pasien_id,
                            'status'      => Timeline::STATUS_DILAYANI,
                            'waktu'       => null,
                        ])->one();
                    }
                    $offset++;
                }
                
                $time_served = Timeline::find()->where([
                    'simulasi_id' => $this->id,
                    'poli_id'     => $timelineServed->poli_id,
                    'status'      => Timeline::STATUS_SELESAI,
                ])->orderBy('waktu DESC')->one()->waktu;
                if ($time_served) $time_served = date('H:i', strtotime($this->tanggal.' '.$time_served. ' + 1 minute'));
                $time_served = max($time_served, $timelineArrived->waktu);

                $timelineServed->waktu = $time_served;
                $timelineServed->save();

                $timelineFinished = Timeline::find()->where([
                    'simulasi_id' => $this->id,
                    'poli_id'     => $timelineArrived->poli_id,
                    'pasien_id'   => $timelineArrived->pasien_id,
                    'status'      => Timeline::STATUS_SELESAI,
                    'waktu'       => null,
                ])->one();
                
                if ($timelineFinished) {
                    $duration = 0;
                    while ($duration <= 0) {
                        $duration = mt_rand($timelineServed->poli->durasi_pelayanan_min, $timelineServed->poli->durasi_pelayanan_max);
                    }
                    $date          = $this->tanggal.' '.$timelineServed->waktu;
                    $time_finished = date('H:i', strtotime($date. ' + '.$duration.' minutes'));

                    $timelineFinished->waktu = $time_finished;
                    $timelineFinished->save();

                    $timelineServed->durasi = $duration;
                    $timelineServed->save();

                    $timelineArrived->durasi = (strtotime($this->tanggal.' '.$timelineServed->waktu) - strtotime($this->tanggal.' '.$timelineArrived->waktu)) / 60;
                    $timelineArrived->save();

                    $nextTimeline = Timeline::find()->where([
                        'simulasi_id' => $this->id,
                        'pasien_id'   => $timelineArrived->pasien_id,
                        'status'      => Timeline::STATUS_DATANG,
                        'waktu'       => null,
                    ])->orderBy('id ASC')->one();

                    if ($nextTimeline) {
                        $nextTimeline->waktu = date('H:i', strtotime($this->tanggal.' '.$timelineFinished->waktu. ' + 1 minute'));
                        $nextTimeline->save();
                    }
                }
            }
        }
        return;
    }

    public function setStats()
    {
        $polis = Poli::find()->where(['simulasi_id' => $this->id])->all();
        foreach ($polis as $poli) {
            $timelines       = Timeline::find()->where(['poli_id' => $poli->id])->orderBy('waktu ASC')->all();
            $jumlah_antri    = 0;
            $jumlah_dilayani = 0;
            $jumlah_selesai  = 0;
                
            foreach ($timelines as $timeline) {
                if ($timeline->status == Timeline::STATUS_DATANG) $jumlah_antri++;
                if ($timeline->status == Timeline::STATUS_DILAYANI) {
                    $jumlah_antri--;
                    $jumlah_dilayani++;
                }
                if ($timeline->status == Timeline::STATUS_SELESAI) {
                    $jumlah_dilayani--;
                    $jumlah_selesai++;
                }
                $timeline->jumlah_antri    = $jumlah_antri;
                $timeline->jumlah_dilayani = $jumlah_dilayani;
                $timeline->jumlah_selesai  = $jumlah_selesai;
                $timeline->save();
            }
        }
    }

    public function getUtilization($poli_id = null)
    {
        $duration_total   = Timeline::find()->where(['simulasi_id' => $this->id])->sum('durasi');
        $duration_serving = Timeline::find()->where(['simulasi_id' => $this->id, 'status' => Timeline::STATUS_DILAYANI])->sum('durasi');

        if ($poli_id) {
            $duration_total   = Timeline::find()->where(['simulasi_id' => $this->id, 'poli_id' => $poli_id])->sum('durasi');
            $duration_serving = Timeline::find()->where(['simulasi_id' => $this->id, 'poli_id' => $poli_id, 'status' => Timeline::STATUS_DILAYANI])->sum('durasi');
        }

        if (!$duration_total) return null;
        return Yii::$app->formatter->asPercent($duration_serving/$duration_total);
    }

    public function getQueueAverage($poli_id = null)
    {
        $duration_total = Timeline::find()->where(['simulasi_id' => $this->id])->sum('durasi');
        $queue_total    = Timeline::find()->where(['simulasi_id' => $this->id])->sum('jumlah_antri * durasi');

        if ($poli_id) {
            $duration_total = Timeline::find()->where(['simulasi_id' => $this->id, 'poli_id' => $poli_id])->sum('durasi');
            $queue_total    = Timeline::find()->where(['simulasi_id' => $this->id, 'poli_id' => $poli_id])->sum('jumlah_antri * durasi');
        }

        if (!$duration_total) return null;
        return Yii::$app->formatter->asDecimal(($queue_total/$duration_total), 2). ' orang per menit';
    }

    public function getServingAverage($poli_id = null)
    {
        $duration_total = Timeline::find()->where(['simulasi_id' => $this->id])->sum('durasi');
        $serving_total  = Timeline::find()->where(['simulasi_id' => $this->id])->sum('jumlah_dilayani * durasi');

        if ($poli_id) {
            $duration_total = Timeline::find()->where(['simulasi_id' => $this->id, 'poli_id' => $poli_id])->sum('durasi');
            $serving_total  = Timeline::find()->where(['simulasi_id' => $this->id, 'poli_id' => $poli_id])->sum('jumlah_dilayani * durasi');
        }

        if (!$duration_total) return null;
        return Yii::$app->formatter->asDecimal(($serving_total/$duration_total), 2). ' orang per menit';
    }
}
