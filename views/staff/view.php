<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\material\models\Repair */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'รายการแจ้งซ่อม'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <div class='row'>
            <div class='col-xs-4 col-xs-offset-9 col-sm-4 col-sm-offset-9'>
                <?= $model->getAttributeLabel('id') ?>
                <?= $model->id; ?><br/>
            </div>
            <div class='col-xs-4 col-xs-offset-9 col-sm-4 col-sm-offset-9 hidden-print'>   
                <?= $model->getAttributeLabel('status') ?>
                <?= $model->statusLabel; ?>
            </div><!--col -->
        </div><!--row -->

        <div class='row'>
            <div class='col-sm-12'>
                <?= Html::tag('h3', 'ใบแจ้งซ่อมครุภัณฑ์', ['class' => 'text-center']) ?>
                <?= Html::tag('h4', Yii::$app->name, ['class' => 'text-center']) ?>
            </div>
        </div><!--row -->

        <div class='row'>            
            <div class='col-sm-6 col-sm-offset-6 text-center'>
                <?php /* = $model->getAttributeLabel('inform_at') */ ?> 
                <?= Yii::t('app', 'วันที่') ?> 
                <?= Yii::$app->thaiFormatter->asDate($model->inform_at, 'long') ?>
            </div><!--col -->
        </div><!--row -->
        <p>&nbsp;</p>

        <div class='row'>
            <div class='col-sm-12'>
                <p style="text-indent: 15%;">
                    <?= Html::tag('b', 'ชื่อ') ?> <span class="border-bottom-dashed"><?= $model->createdBy->person->fullname ?></span>
                </p>
                <p style="text-indent: 15%;">
                    <?= Html::tag('b', 'ตำแหน่ง/ฝ่าย') ?> <span class="border-bottom-dashed"><?= $model->createdBy->personPosition . '/' . $model->createdBy->personParent ?></span>&nbsp;
                </p>
                <p style="text-indent: 15%;">
                    <?= $model->createdBy->personTel ? Html::tag('label', 'เบอร์ติดต่อ') . ' <span class="border-bottom-dashed">' . $model->createdBy->personTel . '</span>&nbsp' : '' ?>
                </p>
                <p style="text-indent: 15%;">
                    ขอแจ้งซ่อมพัสดุดังรายการต่อไปนี้
                </p>

                <div class='row'>
                    <div class='col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2'>       
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table'],
                            'template' => '<tr><td class="text-right">{label}</td><td> {value}</td></tr>',
                            'attributes' => [
                                'material_id',
                                'material.title',
                                'problem:html',
                                [
                                    'attribute' => 'type',
                                    'value' => $model->typeLabel,
                                ],
                            ],
                        ])
                        ?>


                    </div><!--col -->
                </div><!--row -->
            </div><!--col -->
        </div><!--row -->

        <div class='row'>
            <div class='col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-6 text-center'>
                ลงชื่อ ..................................................... <br/>
                ( <?= $model->createdBy->fullname ?> )<br/>
                ผู้แจ้งซ่อม
            </div><!--col -->
        </div><!--row -->
        <br/>
        <div class='row'>
            <div class='col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-6 text-center'>
                <br />
                ลงชื่อ ..................................................... <br/>
                ( <?= \common\models\User::findByRole('staffMaterial', false)->fullname; ?> )<br />
                เจ้าหน้าที่พัสดุ
            </div><!--col -->
        </div><!--row -->

        <div class='row'>
            <div class='col-sm-10 col-sm-offset-1'>
                <br/>
                <br/>
                ความคิดเห็น
                <p style="word-break: break-all;line-height: 30px;">
                    _________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________
                </p>
            </div><!--col -->
        </div><!--row -->

        <div class='row'>
            <div class='col-sm-10 col-sm-offset-1 text-center'>
                <br />
                ลงชื่อ ...............................................<br/>

                <?= \common\models\User::find()->where(['username' => 'kamol.ko'])->one()->person->fullname ?><br/>
                <?= Yii::t('system', 'director') ?>
                <br />
                <br />
                <br />
            </div><!--col -->
        </div><!--row -->





    </div><!--box-body pad-->
</div><!--box box-info-->

<div class="hidden-print">
    <?php
    /*
      if (Yii::$app->user->can('staffMaterial')) {
      if ($model->status == 1) {
      echo $this->render('_formProcess', [
      'model' => $model
      ]);
      }
      }
      ?>
      <?php
      if ($model->status >= 2) {
      echo $this->render('viewComment', [
      'model' => $model
      ]);
      } */
    ?>
</div>

<?php
$css = '
    @page 
    {
        size: A4;   /* auto is the initial value */
        margin: 0cm 1.5cm;  /* this affects the margin in the printer settings */
    }
';
$this->registerCss($css, ['media' => 'print']);
