<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Timeline */

$this->title = 'Create Timeline';
$this->params['breadcrumbs'][] = ['label' => 'Timelines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
