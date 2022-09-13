<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Simulasi */

$this->title = 'Update Simulasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Simulasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simulasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
