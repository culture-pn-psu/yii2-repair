<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\repair\models\Repair */

$this->title = Yii::t('repair', 'Update {modelClass}: ', [
    'modelClass' => 'Repair',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('repair', 'Repairs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('repair', 'Update');
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
