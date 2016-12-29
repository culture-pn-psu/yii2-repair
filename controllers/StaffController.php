<?php

namespace culturePnPsu\repair\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use culturePnPsu\repair\models\Repair;
use culturePnPsu\repair\models\RepairStaffSearch;
use culturePnPsu\repair\models\StaffIndexSearch;
use culturePnPsu\repair\models\StaffConsiderSearch;
use culturePnPsu\repair\models\StaffRepairingSearch;
use culturePnPsu\repair\models\StaffDoneSearch;

/**
 * StaffController implements the CRUD actions for Repair model.
 */
class StaffController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Repair models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StaffIndexSearch();
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
      
        return $this->render('view', [
                    'model' => $model,
        ]);
    }
    
    
    public function actionAssign($id) {
        
        $model = $this->findModel($id);
        
        if($model->load(Yii::$app->request->post())){
            $model->status = 2;
            $model->staffMaterial_id = Yii::$app->user->id;
            if($model->save()){
                Yii::$app->session->setFlash('sussess','บันทึกแล้ว');
                return $this->redirect(['view','id'=>$model->id]);
            }
            
        }
        return $this->render('assign', [
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

   
    /**
     * Lists all Repair models.
     * @return mixed
     */
    public function actionConsider() {
        $searchModel = new StaffConsiderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('consider', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
   
    /**
     * Lists all Repair models.
     * @return mixed
     */
    public function actionRepairing() {
        $searchModel = new StaffRepairingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('repairing', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Repair models.
     * @return mixed
     */
    public function actionDone() {
        $searchModel = new StaffDoneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('done', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
