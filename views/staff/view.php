<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\Repair */

$this->title = $model->getAttributeLabel('id') . " " . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'รายการแจ้งซ่อม'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box'>
    <div class='box-header hidden-print'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->    

    <div class='box-body pad'>
        <?= $this->render('_view', ['model' => $model]) ?> 
    </div><!--box-body pad-->
</div><!--box box-info-->

<?php /* =
  $this->render('viewComment', [
  'model' => $model
  ]);
  ?>

  <?php
  if (Yii::$app->user->can('staffMaterial')) {
  if ($model->status == 1) {
  echo $this->render('_formProcess', [
  'model' => $model
  ]);
  }
  } */
?>