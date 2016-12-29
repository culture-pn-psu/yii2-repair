<?php

namespace culturePnPsu\repair\controllers;

use Yii;
use culturePnPsu\repair\models\Repair;
use culturePnPsu\repair\models\DirectorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * DirectorController implements the CRUD actions for Repair model.
 */
class DirectorController extends Controller {

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
        $searchModel = new DirectorSearch();
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
            if ($model->admin_status == 0) { //ไม่อนุมัติ
                $model->status = 4; //ไม่อนุมัติ
            } elseif ($model->admin_status == 1) { //อนุมัติ
                $model->status = 3; //อนุมัติ
            }
            $model->admin_at = time();
            if ($model->save()) {
                if ($model->status == 3) {
                    Yii::$app->notification->sent('พิจารณาเสนออนุมัติซ่อม : ' . $model->material->title, Url::to(['/repair/default/view', 'id' => $model->id]), $model->createdBy, Yii::$app->user);
                    Yii::$app->notification->sent('พิจารณาเสนออนุมัติซ่อม : ' . $model->material->title, Url::to(['/repair/approve/view', 'id' => $model->id]), $model->staffMaterial, Yii::$app->user);
                } elseif ($model->status == 4) {
                    Yii::$app->notification->sent('ไม่อนุมัติการซ่อม : ' . $model->material->title, Url::to(['/repair/approve/view', 'id' => $model->id]), $model->staffMaterial, Yii::$app->user);
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
