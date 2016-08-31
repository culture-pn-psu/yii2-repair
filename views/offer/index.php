<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel culturePnPsu\repair\models\RepairOfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reserve', 'Repairs');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class='box box-info'>
        <div class='box-header'>
            <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        </div><!--box-header -->

        <div class='box-body pad'>
            <div class="repair-index">
            
            <!--<h1><?= Html::encode($this->title) ?></h1>-->
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <p>
                <?= Html::a(Yii::t('reserve', 'Create Repair'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>                            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                            'id',
            'material_id',
            'problem:ntext',
            'solving:ntext',
            'status',
            // 'type',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'inform_at',
            // 'inform_by',
            // 'staffMaterial_id',
            // 'staffMaterial_at',
            // 'staff_id',
            // 'staff_status',
            // 'staff_comment:ntext',
            // 'staff_at',
            // 'boss_id',
            // 'boss_status',
            // 'boss_comment:ntext',
            // 'boss_at',
            // 'admin_id',
            // 'admin_status',
            // 'admin_comment:ntext',
            // 'admin_at',
            // 'repair_at',
            // 'returned_at',

                ['class' => 'yii\grid\ActionColumn'],
                ],
                ]); ?>
                        <?php Pjax::end(); ?>        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
