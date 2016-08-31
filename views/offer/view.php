<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\repair\models\Repair */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'Repairs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="repair-view">

            <!--<h1><?= Html::encode($this->title) ?></h1>-->

            <p>
                <?= Html::a(Yii::t('reserve', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('reserve', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => Yii::t('reserve', 'Are you sure you want to delete this item?'),
                'method' => 'post',
                ],
                ]) ?>
            </p>

            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'id',
            'material_id',
            'problem:ntext',
            'solving:ntext',
            'status',
            'type',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'inform_at',
            'inform_by',
            'staffMaterial_id',
            'staffMaterial_at',
            'staff_id',
            'staff_status',
            'staff_comment:ntext',
            'staff_at',
            'boss_id',
            'boss_status',
            'boss_comment:ntext',
            'boss_at',
            'admin_id',
            'admin_status',
            'admin_comment:ntext',
            'admin_at',
            'repair_at',
            'returned_at',
            ],
            ]) ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
