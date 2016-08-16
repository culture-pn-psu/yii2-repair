<?php

namespace backend\modules\repair\controllers;

use Yii;
use backend\modules\repair\models\Repair;
use backend\modules\repair\models\ComSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ComController implements the CRUD actions for Repair model.
 */
class ComController extends Controller {

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
        $searchModel = new ComSearch();
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
            if ($model->staff_status == 1) { //ซ่อมเอง
                $model->status = 6; //ซ่อมแล้ว
            } elseif ($model->staff_status == 2) { //ส่งร้าน
                $model->status = 2; //ดำเนินการซ่อม
            }
            $model->staff_at = time();
            if ($model->save()) {
                if ($model->status == 5) {
                    Yii::$app->notification->sent('พิจารณาเสนออนุมัติซ่อม : '.$model->material->title, Url::to(['/repair/consider/view', 'id' => $model->id]), $model->boss, Yii::$app->user);
                    
                } elseif ($model->status == 6) {
                    Yii::$app->notification->sent('ซ่อมเสร็จแล้ว : '.$model->material->title, Url::to(['/repair/done/view', 'id' => $model->id]), $model->staffMaterial, Yii::$app->user);
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
