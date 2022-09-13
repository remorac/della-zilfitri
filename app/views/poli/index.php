<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PoliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Polis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poli-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Poli', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover table-bordered grid-view'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'simulasi_id',
            'nama_poli',
            'jumlah_loket',
            'waktu_buka',
            //'waktu_tutup',
            //'waktu_mulai_istirahat',
            //'waktu_selesai_istirahat',
            //'durasi_pelayanan_min',
            //'durasi_pelayanan_max',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
