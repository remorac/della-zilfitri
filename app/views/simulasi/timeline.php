<?php

use app\models\Timeline;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Simulasi */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Simulasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="simulasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kembali', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'options' => ['class' => 'table table-bordered detail-view'],
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
            'tanggal',
            'keterangan:ntext',
        ],
    ]) ?>

    <br>
    <h4>Timeline Keseluruhan</h4>
    <?php
        $searchModel  = new \app\models\TimelineSearch();
        $dataProvider = $searchModel->search(['TimelineSearch' => ['simulasi_id' => $model->id]]);
        $dataProvider->pagination = false;
    ?>
    
    <?= !$model->timelines
    ? '<div class="form-panel text-muted">Belum ada data.</div>' 
    : '<div class="">'.GridView::widget([
        'tableOptions' => ['class' => 'table table-hover table-bordered grid-view'],
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'waktu',
                'value' => function($model) {
                    return date('H:i', strtotime($model->simulasi->tanggal.' '.$model->waktu));
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'poli_id',
                'value' => 'poli.nama_poli',
            ],
            [
                'attribute' => 'pasien_id',
                'value' => 'pasien.id',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    if ($model->status == Timeline::STATUS_DATANG) return 'Datang';
                    if ($model->status == Timeline::STATUS_DILAYANI) return 'Dilayani';
                    if ($model->status == Timeline::STATUS_SELESAI) return 'Selesai';
                    return null;
                },
            ],
            [
                'attribute' => 'durasi',
                'value' => function($model) {
                    return $model->durasi ? $model->durasi.' menit' : '';
                },
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
            [
                'attribute' => 'jumlah_antri',
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
            [
                'attribute' => 'jumlah_dilayani',
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
            [
                'attribute' => 'jumlah_selesai',
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
        ],
    ]).'</div>'; ?>

    <br>
    <br>
    <?php foreach ($model->polis as $poli) { ?>
        <br>
        <h4>Timeline <?= $poli->nama_poli ?></h4>
        <?php
            $searchModel  = new \app\models\TimelineSearch();
            $dataProvider = $searchModel->search(['TimelineSearch' => ['simulasi_id' => $model->id, 'poli_id' => $poli->id]]);
            $dataProvider->pagination = false;
        ?>
        
        <?= !$model->timelines
        ? '<div class="form-panel text-muted">Belum ada data.</div>' 
        : '<div class="">'.GridView::widget([
            'tableOptions' => ['class' => 'table table-hover table-bordered grid-view'],
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                    'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                ],
                [
                    'attribute' => 'waktu',
                    'value' => function($model) {
                        return date('H:i', strtotime($model->simulasi->tanggal.' '.$model->waktu));
                    },
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'pasien_id',
                    'value' => 'pasien.id',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        if ($model->status == Timeline::STATUS_DATANG) return 'Datang';
                        if ($model->status == Timeline::STATUS_DILAYANI) return 'Dilayani';
                        if ($model->status == Timeline::STATUS_SELESAI) return 'Selesai';
                        return null;
                    },
                ],
                [
                    'attribute' => 'durasi',
                    'value' => function($model) {
                        return $model->durasi ? $model->durasi.' menit' : '';
                    },
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'jumlah_antri',
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'jumlah_dilayani',
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'jumlah_selesai',
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                ],
            ],
        ]).'</div>'; ?>
    <?php } ?>

</div>
