<?php

use app\models\PasienPoli;
use kartik\date\DatePicker;
use mdm\widgets\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Poli */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poli-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'waktu_kedatangan')->textInput() ?>

    <div class="card grid-view tabular-input mt-2 mb-2">
        <table class="table table-condensed table-hover mb-0">
            <thead>
                <tr>
                    <th style="border-top:none; ">Alur Kunjungan</th>
                    <th style="border-top:none; width:1px; white-space:nowrap; text-align:center"><a class="btn-add btn btn-sm btn-success"><span class="fa fa-plus"></span></a></th>
                </tr>
            </thead>
            <?= TabularInput::widget([
                'id'            => 'detail-grid',
                'allModels'     => $model->pasienPolis,
                'model'         => PasienPoli::class,
                'tag'           => 'tbody',
                'form'          => $form,
                'itemOptions'   => ['tag' => 'tr'],
                'itemView'      => '_item-detail',
                'clientOptions' => [
                    'btnAddSelector' => '.btn-add',
                ]
            ]); ?>
        </table>
    </div>

    <div class="pt-2 text-right">
        <?= Html::button('<i class="fa fa-arrow-left"></i> Cancel', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal'])  ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
