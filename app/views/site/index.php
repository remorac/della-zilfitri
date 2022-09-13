<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Simulasi</h1>

        <p class="lead">Antrian Pasien Puskesmas Lintau Buo.</p>
        <br>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/pasien']) ?>">Mulai Simulasi</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">

                <p>
                    
                </p>

                <p><a class="btn btn-outline-secondary d-none" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
