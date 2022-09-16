<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Poli */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poli-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_poli')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'jumlah_loket')->textInput() ?>

    <?= '' // $form->field($model, 'waktu_buka')->textInput() ?>

    <?= '' // $form->field($model, 'waktu_tutup')->textInput() ?>

    <?= '' // $form->field($model, 'waktu_mulai_istirahat')->textInput() ?>

    <?= '' // $form->field($model, 'waktu_selesai_istirahat')->textInput() ?>

    <?= $form->field($model, 'durasi_pelayanan_min')->textInput() ?>

    <?= $form->field($model, 'durasi_pelayanan_max')->textInput() ?>

    <div class="pt-2 text-right">
        <?= Html::button('<i class="fa fa-arrow-left"></i> Cancel', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal'])  ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
