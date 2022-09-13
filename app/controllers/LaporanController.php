<?php

namespace app\controllers;

use app\models\Pemeriksaan;
use yii\web\Controller;

class LaporanController extends Controller
{
    public function actionIndex($year = null, $month = null)
    {
        if (!$year) $year = date('Y');
        if (!$month) $month = date('m');

        $query = Pemeriksaan::find();
        if ($year) $query->andWhere(['YEAR(tanggal)' => $year]);
        if ($month) $query->andWhere(['MONTH(tanggal)' => $month]);
        $pemeriksaans = $query->all();

        return $this->render('index', [
            'year' => $year,
            'month' => $month,
            'pemeriksaans' => $pemeriksaans,
        ]);
    }
}
