<?php

namespace culturePnPsu\repair\controllers;

use Yii;
use culturePnPsu\repair\models\Repair;
use culturePnPsu\repair\models\DoneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * DoneController implements the CRUD actions for Repair model.
 */
class DoneController extends Controller {

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
        $searchModel = new DoneSearch();
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
            if ($model->status == 8) { //ส่งคืน
                $model->returned_at = time();
            }

            if ($model->save()) {
                if ($model->status == 8) {
                    Yii::$app->notification->sent('ส่งคืนแล้ว : ' . $model->material->title, Url::to(['/repair/default/view', 'id' => $model->id]), $model->createdBy, Yii::$app->user);
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
