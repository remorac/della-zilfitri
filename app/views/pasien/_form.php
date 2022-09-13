<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasien-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'simulasi_id')->textInput() ?>

    <?= $form->field($model, 'poli_id')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'waktu_kedatangan')->textInput() ?>

    <?= $form->field($model, 'waktu_dilayani')->textInput() ?>

    <?= $form->field($model, 'waktu_selesai')->textInput() ?>

    <?= $form->field($model, 'next_poli_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
