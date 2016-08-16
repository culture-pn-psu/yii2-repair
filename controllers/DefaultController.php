<?php

namespace backend\modules\repair\controllers;

use Yii;
use backend\modules\repair\models\Repair;
use backend\modules\repair\models\RepairSearch;
use backend\modules\repair\models\RepairDraftSearch;
use backend\modules\repair\models\RepairingSearchAllstaff;
use backend\modules\repair\models\RepairDoneSearchAllstaff;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\material\models\Material;

/**
 * DefaultController implements the CRUD actions for Repair model.
 */
class DefaultController extends Controller {

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
        $searchModel = new RepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDraft() {
        $searchModel = new RepairDraftSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('draft', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRepairing() {
        $searchModel = new RepairingSearchAllstaff();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDone() {
        $searchModel = new RepairDoneSearchAllstaff();        
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
        
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }
    
     public function actionPrint($id) {
         $this->layout='print';
        return $this->render('print', [
                    'model' => $this->findModel($id),
        ]);
    }
    

    /**
     * Creates a new Repair model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Creates a new Repair model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Repair();
        $modelMaterial = new Material();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $model->material_id = $this->chkTb(Material::className(), $post, 'material_id', 'title');

            $model->created_at = time();
            $model->created_by = Yii::$app->user->id;
            if (isset($post['save'])) {
                $model->status = 0;
            } elseif (isset($post['send'])) {
                $model->inform_at = time();
                $model->status = 1;
            }

            if ($model->save()) {
                if (isset($post['save'])) {
                    return $this->redirect(['update', 'id' => $model->id]);
                } elseif (isset($post['send'])) {
                    Yii::$app->notification->sent('ขอยื่นแจ้งซ่อม', \yii\helpers\Url::to(['/material/repaired/view', 'id' => $model->id]), \common\models\User::findByRole('staffMaterial', false), Yii::$app->user);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelMaterial' => $modelMaterial,
            ]);
        }
    }

    /**
     * Updates an existing Repair model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelMaterial = new Material();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $model->material_id = $this->chkTb(Material::className(), $post, 'material_id', 'title');
            $model->created_at = time();
            $model->created_by = Yii::$app->user->id;
            if (isset($post['save'])) {
                $model->status = 0;
            } elseif (isset($post['send'])) {
                $model->inform_at = time();
                $model->status = 1;
            }

            if ($model->save()) {
                if (isset($post['save'])) {
                    return $this->redirect(['update', 'id' => $model->id]);
                } elseif (isset($post['send'])) {
                    Yii::$app->notification->sent('ขอยื่นแจ้งซ่อม', \yii\helpers\Url::to(['/material/repaired/view', 'id' => $model->id]), \common\models\User::findByRole('staffMaterial', false), Yii::$app->user);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'modelMaterial' => $modelMaterial,
        ]);
    }

    /**
     * Deletes an existing Repair model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
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
    
    
    public function chkTb($modelName, $post, $id, $title) {
        $val='';
        switch ($modelName) {
            case 'backend\modules\material\models\Material':                
                $ch_id = $post['Repair'][$id];
                $ch_title = $post['Material']['title'];
                $val=$post['Repair'];
                break;
        }


        if (isset($val[$id])) {
            $modelPost = new $modelName();
            $model = $modelName::findOne(['id' => $val[$id]]);
//            print_r($model);
//            exit();
            if ($model === NULL) {
                //$this->pr($model);
                $model = new $modelName();
                //$model->id = $val[$id];
                //$val[$title]=$val[$id];
//                echo $modelName;
//                exit();
                switch ($modelName) {
                    case 'backend\modules\material\models\Material':
                        $model->id = $ch_id;
                        $model->title = $ch_title;
                        //$model->brand = $val['material_brand'];
                        $model->status = 1;
                        $model->created_at = time();
                        $model->created_by = Yii::$app->user->id;
                        break;
                }
                if (!$model->save()) {
                    print_r($model->getErrors());
                }
                return $model->id;
            } else {
                return $model->id;
            }
        }
    }

}
