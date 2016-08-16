<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\material\models\Repair */

$this->title = Yii::t('app', 'แจ้งซ่อมครุภัณฑ์ {modelClass}: ', [
            'modelClass' => 'Repair',
        ]) . ' ' . $model->material_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('repair', 'ระบบแจ้งซ่อมครุภัณฑ์'), 'url' => ['/repair']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <?=
        $this->render('_form', [
            'model' => $model,
            'modelMaterial' => $modelMaterial,
        ])
        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
