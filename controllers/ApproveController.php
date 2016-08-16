<?php

namespace backend\modules\repair\controllers;

use Yii;
use backend\modules\repair\models\Repair;
use backend\modules\repair\models\ApproveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ApproveController implements the CRUD actions for Repair model.
 */
class ApproveController extends Controller {

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
        $searchModel = new ApproveSearch();
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
            if ($model->status == 5) { //ดำเนินการซ่อม
                $model->repair_at = time(); //ซ่อมแล้ว
            } elseif ($model->status == 8) { //ส่งคืน
                $model->returned_at = time();
            }
            
            if ($model->save()) {
                if ($model->status == 5) {
                    Yii::$app->notification->sent('ดำเนินการซ่อม : ' . $model->material->title, Url::to(['/repair/default/view', 'id' => $model->id]), $model->createdBy, Yii::$app->user);
                } elseif ($model->status == 8) {
                    Yii::$app->notification->sent('ซ่อมเสร็จแล้ว : ' . $model->material->title, Url::to(['/repair/default/view', 'id' => $model->id]), $model->createdBy, Yii::$app->user);
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
