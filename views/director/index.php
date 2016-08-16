<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\material\models\RepairedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('person', 'รายการแจ้งซ่อม');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

<!--        <p>
        <?= Html::a(Yii::t('person', 'Create Repair'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>-->

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'material_id',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::a('<i class="fa fa-info-circle"></i> ' . Html::tag('b',$model->material->title) , ['view', 'id' => $model->id])."<br/>" .Html::tag('small',$model->material_id,['style'=>'color:#aaa;']);
                    },
                        ],
                        'problem:html',
                        //'type',
//                        [
//                            'attribute' => 'type',
//                            'filter' => \backend\modules\material\models\Repair::getItemType(),
//                            'format' => 'html',
//                            'value' => 'TypeLabel'
//                        ],
                        [
                            'attribute' => 'status',
                            'filter' => \backend\modules\material\models\Repair::getItemStatus(),
                            'format' => 'html',
                            'value' => 'statusLabel'
                        ],
                        [
                            'attribute' => 'inform_by',
                            'format' => 'html',
                            'filter' => common\models\User::getListUser(),
                            'value' => 'createdBy.displaynameImg',
                        ],
                        [
                            'attribute' => 'staffMaterial_at',
                            'format' => 'datetime',
                        //'filter' => common\models\User::getListUser(),
                        ],
                    //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
