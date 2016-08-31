<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel culturePnPsu\repair\models\RepairStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('repair', 'รายการซ่อมทั้งหมด');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="repair-index">

            <?php Pjax::begin(); ?>                        
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a('<i class="fa fa-info-circle"></i> ' . Html::tag('b', $model->id), ['view', 'id' => $model->id]);
                        },
                            ],
                            [
                                'attribute' => 'material_id',
                                'format' => 'html',
                                'value' => function($model) {
                                    return Html::tag('span', Html::tag('b', $model->material->title) . "<br/>" . Html::tag('small', $model->material_id, ['style' => 'color:#aaa;']));
                                },
                                    ],
                                    'problem:html',
                                    //'type',
                                    [
                                        'attribute' => 'type',
                                        'filter' => \culturePnPsu\repair\models\Repair::getItemType(),
                                        'format' => 'html',
                                        'value' => 'TypeLabel'
                                    ],
//                                    [
//                                        'attribute' => 'status',
//                                        'filter' => \culturePnPsu\repair\models\Repair::getItemStatus(),
//                                        'format' => 'html',
//                                        'value' => 'statusLabel'
//                                    ],
                                    [
                                        'attribute' => 'inform_by',
                                        'format' => 'html',
                                        'filter' => common\models\User::getListUser(),
                                        'value' => 'createdBy.displaynameImg',
                                    ],
                                    [
                                        'attribute' => 'inform_at',
                                        'format' => 'datetime',
                                    //'filter' => common\models\User::getListUser(),
                                    ],
                                //['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]);
                            ?>
                <?php Pjax::end(); ?>     
        </div>
    </div><!--box-body pad-->    
</div><!--box box-info-->
