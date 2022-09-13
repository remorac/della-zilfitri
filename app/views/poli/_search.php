<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PoliSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poli-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'simulasi_id') ?>

    <?= $form->field($model, 'nama_poli') ?>

    <?= $form->field($model, 'jumlah_loket') ?>

    <?= $form->field($model, 'waktu_buka') ?>

    <?php // echo $form->field($model, 'waktu_tutup') ?>

    <?php // echo $form->field($model, 'waktu_mulai_istirahat') ?>

    <?php // echo $form->field($model, 'waktu_selesai_istirahat') ?>

    <?php // echo $form->field($model, 'durasi_pelayanan_min') ?>

    <?php // echo $form->field($model, 'durasi_pelayanan_max') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
