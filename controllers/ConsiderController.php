<?php

namespace culturePnPsu\repair\controllers;

use Yii;
use culturePnPsu\repair\models\Repair;
use culturePnPsu\repair\models\ConsiderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ConsiderController implements the CRUD actions for Repair model.
 */
class ConsiderController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Repair models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ConsiderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Repair model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->boss_status == 0) { //ไม่อนุมัติ
                $model->status = 4; //ไม่อนุมัติ
            } elseif ($model->boss_status == 1) { //อนุมัติ
                $model->status = 2; //อนุมัติ
            }
            $model->boss_at = time();
            if ($model->save()) {
                if ($model->status == 2) {
                    Yii::$app->notification->sent('พิจารณาเสนออนุมัติซ่อม : ' . $model->material->title, Url::to(['/repair/consider/confirm', 'id' => $model->id]), $model->admin, Yii::$app->user);
                } elseif ($model->status == 4) {
                    Yii::$app->notification->sent('ไม่อนุมัติการซ่อม : ' . $model->material->title, Url::to(['/repair/done/view', 'id' => $model->id]), $model->staffMaterial, Yii::$app->user);
                }
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
            }
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }
     
    public function actionConfirm($id) {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->admin_status == 0) { //ซ่อมเอง
                $model->status = 4; //ซ่อมแล้ว
            } elseif ($model->admin_status == 1) { //ส่งร้าน
                $model->status = 2; //ดำเนินการซ่อม
            }
            $model->admin_at = time();
            if ($model->save()) {
                if ($model->status == 2) {
                    Yii::$app->notification->sent('พิจารณาเสนออนุมัติซ่อม : ' . $model->material->title, Url::to(['/repair/consider/view', 'id' => $model->id]), $model->admin, Yii::$app->user);
                } elseif ($model->status == 4) {
                    Yii::$app->notification->sent('ไม่อนุมัติการซ่อม : ' . $model->material->title, Url::to(['/repair/done/view', 'id' => $model->id]), $model->staffMaterial, Yii::$app->user);
                }
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
            }
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Finds the Repair model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Repair the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Repair::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
