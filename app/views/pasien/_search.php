<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PasienSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasien-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'simulasi_id') ?>

    <?= $form->field($model, 'poli_id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'waktu_kedatangan') ?>

    <?php // echo $form->field($model, 'waktu_dilayani') ?>

    <?php // echo $form->field($model, 'waktu_selesai') ?>

    <?php // echo $form->field($model, 'next_poli_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
