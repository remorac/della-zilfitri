<?php

use app\models\Poli;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<td>
    <?= Html::activeHiddenInput($model, "[$key]id") ?>
    <?= Html::activeDropDownList($model, "[$key]poli_id", ArrayHelper::map(Poli::find()->where(['simulasi_id' => Yii::$app->session->get('simulasi_id')])->all(), 'id', 'nama_poli'), ['class' => 'form-control', 'prompt' => '']) ?>
</td>

<td style="width:1px; white-space:nowrap; text-align:right; vertical-align:middle">
    <a data-action="delete" title="Delete" href="#" class="btn btn-sm btn-outline-danger"><span class="fa fa-times"></span></a>
</td>
