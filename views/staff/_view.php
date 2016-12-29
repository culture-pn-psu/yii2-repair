<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>


<div class='row hidden-print'>
    <div class='col-sm-4 col-sm-offset-8 text-right'>
        <small >
            <?= $model->getAttributeLabel('id') ?>
            <u> <?= $model->id; ?></u>
        </small>
    </div>
</div><!--row -->

<div class='row hidden-print'>
    <div class='col-xs-4 col-xs-offset-8 col-sm-4 col-sm-offset-8 text-right'>   
        <small >
            <?= $model->getAttributeLabel('status') ?>
            <?= $model->statusLabel; ?>
        </small>
    </div><!--col -->
</div><!--row -->

<div class='row'>
    <div class='col-sm-12'>
        <?= Html::tag('h3', 'ใบแจ้งซ่อมครุภัณฑ์', ['class' => 'text-center']) ?>                
        <?= Html::tag('h4', Yii::$app->name, ['class' => 'text-center']) ?>
    </div>
</div><!--row -->

<div class='row'>            
    <div class='col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-6 text-center'>
        <?php /* = $model->getAttributeLabel('inform_at') */ ?> 
        <?= Yii::t('app', 'วันที่') ?> 
        <?= Yii::$app->thaiFormatter->asDate($model->inform_at, 'long') ?>
    </div><!--col -->
</div><!--row -->
<p>&nbsp;</p>

<div class='row'>
    <div class='col-sm-12'>
        <p style="text-indent: 15%;">
            <?= Html::tag('b', $model->getAttributeLabel('id')) ?>
            <span class="border-bottom-dashed"><?= $model->id; ?></span>
        </p>
        <p style="text-indent: 15%;">
            <?= Html::tag('b', 'ชื่อ') ?> <span class="border-bottom-dashed"><?= $model->createdBy->person->fullname ?></span>
        </p>

        <p style="text-indent: 15%;">
            <?= Html::tag('b', 'ตำแหน่ง/ฝ่าย') ?> <span class="border-bottom-dashed"><?= $model->createdBy->personPosition . '/' . $model->createdBy->personParent ?></span>&nbsp;
            <!--            </p>
            
                        <p style="text-indent: 15%;">-->
            <?= $model->createdBy->personTel ? Html::tag('b', 'เบอร์ติดต่อ') . ' <span class="border-bottom-dashed">' . $model->createdBy->personTel . '</span>&nbsp' : '' ?>
        </p>
        <br/>
        <p style="text-indent: 15%;">
            <?= Html::tag('b', 'ขอแจ้งซ่อมพัสดุดังรายการต่อไปนี้') ?>
        </p>

        <p style="text-indent: 15%;">
            
             <?= Html::tag('b', 'ชื่อ') ?> <span class="border-bottom-dashed"><?= $model->createdBy->person->fullname ?></span>
            <?=
            DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table'],
                'template' => '<tr><td class="text-right" width="150"><label>{label}</label></td><td> {value}</td></tr>',
                'attributes' => [
                    //'material_id',
                  //  'material.title',
                    [
                        'attribute' => 'material.title',
                        'value' => $model->material->title ." (".$model->material_id.") ประเภท ".$model->typeLabel,
                    ],
                    [
                        'attribute' => 'type',
                        'value' => $model->typeLabel,
                    ],
                    'problem:html',
                ],
            ])
            ?>
        </p>
    </div><!--col -->
</div><!--row -->

<div class='row'>
    <div class='col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-6 text-center'>
        ลงชื่อ ..................................................... <br/>
        ( <?= $model->informBy->person->fullname ?> )
        <br/>
        ผู้แจ้งซ่อม
    </div><!--col -->
</div><!--row -->


