<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\Repair */

$this->title = $model->material_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'รายการแจ้งซ่อม'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
        <div class="box-tools">
            <?=Html::a('พิมพ์',['print','id'=>$model->id],['class'=>'btn btn-primary btn-sm','target'=>'_blank']);?>
            
        </div>
    </div><!--box-header -->

    <div class='box-body pad'>
        <?php if($model->status==0):?>
        <p>
            <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a(Yii::t('app', 'ลบ'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </p>
        <?php endif; ?>
        
        <?= Html::tag('h3', 'ใบแจ้งซ่อมครุภัณฑ์', ['class' => 'text-center']) ?>
        <?= Html::tag('h4', Yii::$app->name, ['class' => 'text-center']) ?>
        
        <div class='row'>
            <div class='col-sm-3 col-sm-offset-6 text-right'>
                <?= $model->getAttributeLabel('id') ?>
            </div>
            <div class='col-sm-3'>
                 <?= $model->id; ?>
            </div><!--col -->
        </div><!--row -->
        
        <div class='row'>
             <div class='col-sm-3 col-sm-offset-6 text-right'>
                 <?= $model->getAttributeLabel('inform_at') ?>
                  </div>
            <div class='col-sm-3'>
                 <?= Yii::$app->thaiFormatter->asDate($model->inform_at, 'long') ?>
            </div><!--col -->
        </div><!--row -->
        <p>&nbsp;</p>

        <div class='row'>
            <div class='col-sm-12'>
                <?=
                DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th class="text-right">{label}</th><td> {value}</td></tr>',
                    'attributes' => [
                        [
                            'label' => 'ผู้ขอรับบริการ',
                            'format' => 'html',
                            'value' => $model->createdBy->displaynameImg,
                        ],
                        [
                            'label' => 'ตำแหน่ง/ฝ่าย',
                            'value' => $model->createdBy->personPosition . ' ' . $model->createdBy->personParent,
                        ],
                        [
                            'label' => 'เบอร์ติดต่อ',
                            'value' => $model->createdBy->personTel,
                        ],
                        'material_id',
                        'material.title',
                        'problem:html',
                        //'type',
                        [
                            'attribute' => 'type',
                            'value' => $model->typeLabel,
                        ],
                        'statusLabel:html',
                    ],
                ])
                ?>
            </div><!--col -->
        </div><!--row -->





    </div><!--box-body pad-->
</div><!--box box-info-->

<?php
// รับเรื่อง
if (isset($model->staffMaterial_id) && $model->status > 1):

    echo $this->render('viewComment', [
        'model' => $model
    ]);

endif;
?>



 <?php /*=Yii::$app->runAction('/material/material/history',['id'=>$model->material_id,'header'=>false])*/ ?>