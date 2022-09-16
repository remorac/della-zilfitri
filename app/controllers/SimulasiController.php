<?php

namespace app\controllers;

use app\models\Pasien;
use app\models\PasienPoli;
use app\models\Poli;
use app\models\Simulasi;
use app\models\SimulasiSearch;
use app\models\Timeline;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * SimulasiController implements the CRUD actions for Simulasi model.
 */
class SimulasiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Simulasi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SimulasiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Simulasi model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Simulasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Simulasi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Simulasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Simulasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Simulasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Simulasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Simulasi::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDuplicate($id)
    {
        $model = new Simulasi();

        if ($model->load(Yii::$app->request->post())) {
            /* $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save()) {
                    $duplication = $model->duplicatePackageQuestions($reference);
                    if ($duplication['success']) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($duplication['errors']));
                    }
                } else {
                    Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
                }
            } catch (\Exception $exception) {
                Yii::$app->session->addFlash('error', $exception->getMessage());
            }
            $transaction->rollBack(); */
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-duplicate', [
                'model' => $model
            ]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionPoliCreate($simulasi_id)
    {
        $simulasi = $this->findModel($simulasi_id);
        $model = new Poli();
        $model->simulasi_id = $simulasi_id;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->simulasi_id]);
            } else {
                Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
            }
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-poli', [
                'model' => $model
            ]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionPoliUpdate($id)
    {
        $model = Poli::findOne($id);
        if (!$model) throw new NotFoundHttpException('The requested data does not exist.');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->simulasi_id]);
            } else {
                Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
            }
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-poli', [
                'model' => $model
            ]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }



    public function actionPasienCreate($simulasi_id)
    {
        $simulasi = $this->findModel($simulasi_id);
        $model = new Pasien();
        $model->simulasi_id = $simulasi_id;
        $model->pasienPolis = [new PasienPoli()];

        Yii::$app->session->set('simulasi_id', $simulasi_id);

        if ($model->load(Yii::$app->request->post())) {
            $model->pasienPolis = Yii::$app->request->post('PasienPoli', []);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->simulasi_id]);
            } else {
                Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
            }
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-pasien', [
                'model' => $model
            ]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionPasienUpdate($id)
    {
        $model = Pasien::findOne($id);
        if (!$model) throw new NotFoundHttpException('The requested data does not exist.');

        Yii::$app->session->set('simulasi_id', $model->simulasi_id);

        if (!$model->pasienPolis) $model->pasienPolis = [new PasienPoli()];

        if ($model->load(Yii::$app->request->post())) {
            $model->pasienPolis = Yii::$app->request->post('PasienPoli', []);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->simulasi_id]);
            } else {
                Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
            }
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-pasien', [
                'model' => $model
            ]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionTimeline($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
            $model->populateTimelines();
            $model->setTimes();
            $model->setStats();
            return $this->redirect(['timeline', 'id' => $id]);
        } 

        return $this->render('timeline', [
            'model' => $model,
        ]);
    }
}
