<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Simulasi */

$this->title = 'Create Simulasi';
$this->params['breadcrumbs'][] = ['label' => 'Simulasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simulasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
