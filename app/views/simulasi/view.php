<?php

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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::button('Duplikat', [
            'value' => Url::to(['duplicate', 'id' => $model->id]), 
            'title' => 'Duplikat', 
            'class' => 'showModalButton btn btn-success'
        ]); ?>
        <?= Html::a('Lihat Hasil', ['result', 'id' => $model->id], ['class' => 'btn btn-info float-right']) ?>
    </p>

    <?= DetailView::widget([
        'options' => ['class' => 'table table-bordered detail-view'],
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
            'keterangan:ntext',
        ],
    ]) ?>

    <br>
    <h4>Poli</h4>
    <?= Html::button('Tambah Poli', [
        'value' => Url::to(['poli-create', 'simulasi_id' => $model->id]), 
        'title' => 'Tambah Poli', 
        'class' => 'showModalButton btn btn-success mb-2'
    ]); ?>
    <?php
        $searchModel  = new \app\models\PoliSearch();
        $dataProvider = $searchModel->search(['PoliSearch' => ['simulasi_id' => $model->id]]);
        $dataProvider->pagination = false;
    ?>
    
    <?= !$model->polis 
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'class'     => 'btn btn-icon btn-xs btn-outline-info',
                            'data-pjax' => 0,
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::button('<i class="fas fa-pen"></i>', [
                            'value'     => Url::to(['poli-update', 'id' => $model->id]),
                            'title'     => 'Update',
                            'class'     => 'showModalButton btn btn-icon btn-xs btn-outline-primary',
                            'data-pjax' => 0,
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', Url::to(['poli-delete', 'id' => $model->id]), [
                            'class'        => 'btn btn-icon btn-xs btn-outline-danger',
                            'data-method'  => 'post',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-pjax'    => 0,
                        ]);
                    },
                ],
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            // 'id',
            // 'simulasi_id',
            'nama_poli',
            'jumlah_loket',
            'waktu_buka',
            'waktu_tutup',
            'waktu_mulai_istirahat',
            'waktu_selesai_istirahat',
            'durasi_pelayanan_min',
            'durasi_pelayanan_max',
        ],
    ]).'</div>'; ?>

    <br>
    <br>
    <h4>Pasien</h4>
    <?= Html::button('Tambah Pasien', [
        'value' => Url::to(['pasien-create', 'simulasi_id' => $model->id]), 
        'title' => 'Tambah Pasien', 
        'class' => 'showModalButton btn btn-success mb-2'
    ]); ?>
    <?php
        $searchModel  = new \app\models\PasienSearch();
        $dataProvider = $searchModel->search(['PasienSearch' => ['simulasi_id' => $model->id]]);
        $dataProvider->pagination = false;
    ?>
    
    <?= !$model->pasiens 
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'class'     => 'btn btn-icon btn-xs btn-outline-info',
                            'data-pjax' => 0,
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::button('<i class="fas fa-pen"></i>', [
                            'value'     => Url::to(['pasien-update', 'id' => $model->id]),
                            'title'     => 'Update',
                            'class'     => 'showModalButton btn btn-icon btn-xs btn-outline-primary',
                            'data-pjax' => 0,
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', Url::to(['pasien-delete', 'id' => $model->id]), [
                            'class'        => 'btn btn-icon btn-xs btn-outline-danger',
                            'data-method'  => 'post',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-pjax'    => 0,
                        ]);
                    },
                ],
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            // 'id',
            // 'simulasi_id',
            'tanggal',
            'waktu_kedatangan',
            [
                'attribute' => 'Alur Kunjungan',
                'value' => function($model) {
                    return $model->pasienPolisText;
                }
            ],
        ],
    ]).'</div>'; ?>

</div>
