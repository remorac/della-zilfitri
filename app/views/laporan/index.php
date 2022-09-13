<?php

use app\models\Pasien;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Hasil Pemeriksaan';
$this->params['breadcrumbs'][] = $this->title;

$years = [];
for ($i = date('Y'); $i >= 2018 ; $i--) { 
    $years[$i] = $i;
}
$months = [];
for ($i = 1; $i <= 12 ; $i++) { 
    $months[$i] = date('F', mktime(0, 0, 0, $i, 10));
}

?>
<div class="pasien-index">

    <?php $form = ActiveForm::begin(['action' => ['/laporan'], 'method' => 'get']); ?>
    <table>
        <tr>
            <td width="200px;" style="padding-right:10px"><?= Html::dropDownList('month', $month, $months, ['class' => 'form-control']) ?></td>
            <td width="100px;" style="padding-right:10px"><?= Html::dropDownList('year', $year, $years, ['class' => 'form-control']) ?></td>
            <td width="100px;" style="padding-right:10px"><?= Html::submitButton('Refresh', ['class' => 'btn btn-info']) ?></td>
            <td width="100px;" style="padding-right:10px"><?= Html::button('Print', ['class' => 'btn btn-outline-secondary', 'onClick' => 'window.print();']) ?></td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

    <p></p>
    <div class="" style="border:2px solid #ddd; border-radius:8px; box-shadow: inset 0 0 0px rgba(0,0,0,0.05); padding:8px">
    <div class="printable">
        <br>
        <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
        <p class="text-center"><?= date('F', mktime(0, 0, 0, $month, 10)) ?> <?= $year ?></p>
        <p></p>
        <table class="table table-bordered" style="margin-bottom: 0;">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Hasil</th>
                <th>Keterangan</th>
            </tr>
        <?php $i = 0; ?>
        <?php foreach ($pemeriksaans as $pemeriksaan) { ?>
            <tr>
                <td class="text-center" style="width:1px; white-space:nowrap"><?= ++$i ?></td>
                <td><?= $pemeriksaan->tanggal; ?></td>
                <td><?= $pemeriksaan->pasien->nama; ?></td>
                <td><?= $pemeriksaan->pasien->umur; ?></td>
                <td><?= $pemeriksaan->pasien->alamat; ?></td>
                <td><?= Yii::$app->formatter->asDecimal($pemeriksaan->result, 2); ?></td>
                <td><?= $pemeriksaan->resultText; ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
    </div>

</div>

<style>
@media print {
    body * {
        visibility:hidden;
    }
    a[href]:after {
        content: none !important;
    }
    .printable, .printable * {
        visibility:visible;
    }
    .printable {
        position: absolute;
        width: 90%;
        top:20px !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>