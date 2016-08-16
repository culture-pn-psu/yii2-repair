<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\material\models\RepairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('repair', 'รายการแจ้งซ่อมทั้งหมด');
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$this->title?></h3>

        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">

        <div class="table-responsive">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => ['class' => 'table table-hover table-striped'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a('<i class="fa fa-info-circle"></i> ' . Html::tag('b',$model->id) , ['view', 'id' => $model->id]);
                        }
                            ],
                    [
                        'attribute' => 'material_id',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::tag('span',Html::tag('b',$model->material->title) , ['view', 'id' => $model->id])."<br/>" .Html::tag('small',$model->material_id,['style'=>'color:#aaa;']);
                        }
                            ],
                            //'material.title',
                            'problem:html',
                            [
                                'attribute' => 'status',
                                'filter' => \backend\modules\material\models\Repair::getItemStatus(),
                                'format' => 'html',
                                'value' => 'statusLabel'
                            ],
                            //'created_at:datetime',
                            [
                                'attribute' => 'created_at',
                                'format' => 'datetime',
                                'headerOptions' => ['width' => '200'],
                                'filter' => DatePicker::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'created_at',
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ]),
//                            'value' => function($model) {
//                                return Yii::$app->thaiFormatter->asDateTime($model->created_at, 'medium');
//                            },
                            //'visible' => Yii::$app->user->can('AllStaff')
                            ],
//                [
//                    'attribute' => 'created_by',
//                    'value' => 'createdBy.displayname',
//                    'filter' => common\models\User::getListUser(),
//                ],
//                [
//                    'attribute' => 'inform_at',
//                    'format' => 'datetime',
//                    'filter' => common\models\User::getListUser(),                    
//                    'visible' => Yii::$app->user->can('adminRepair')
//                ],        
//                [
//                    'attribute' => 'inform_by',
//                    'filter' => common\models\User::getListUser(),
//                    'value' => 'informBy.displayname',
//                    'visible' => Yii::$app->user->can('adminRepair')
//                ],
                            // 'staff_id',
                            // 'admin_id',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {view} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return $model->status == 0 ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url) : '';
                                    },
                                    'delete' => function ($url, $model) {
                                        return $model->status == 0 ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url) : '';
                                    },
                                ],
                                'visible' => Yii::$app->user->can('AllStaff')
                            ],
                        ],
                    ]);
                    ?>


            <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding">
        <div class="mailbox-controls">

        </div>
    </div>
</div>
<!-- /. box -->
      