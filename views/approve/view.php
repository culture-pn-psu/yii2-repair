<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use culturePnPsu\repair\models\Repair;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\RepairProcess */
/* @var $form yii\widgets\ActiveForm */
use common\models\User;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\Repair */

$this->title = $model->material_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'รายการแจ้งซ่อม'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>
        <?= Html::tag('h3', 'ใบแจ้งซ่อมครุภัณฑ์', ['class' => 'text-center']) ?>
        <?= Html::tag('h4', Yii::$app->name, ['class' => 'text-center']) ?>


        <div class='row'>
            <div class='col-sm-3 col-sm-offset-9'>
                <?= $model->getAttributeLabel('inform_at') ?> <?= Yii::$app->thaiFormatter->asDate($model->inform_at, 'long') ?>
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

<?php
if (Yii::$app->user->can('staffMaterial')):
    $form = ActiveForm::begin();
    ?> 
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->staffMaterial->displaynameImg ?>
        </div>

        <div class="box-footer box-comments">
            <div class="box-comment">
                <div class="comment-text">
                    <?= $form->field($model, 'status')->radioList([5 => 'ดำเนินการซ่อม', 8 => 'ส่งคืนแล้ว']) ?> 

                    <div class="form-group"> 
                        <?= Html::submitButton(Yii::t('person', 'บันทึก'), ['class' => 'btn btn-success']) ?> 
                    </div>

                </div><!-- /.comment-text -->
            </div><!-- /.box-comment -->
        </div>
        <?php
        ActiveForm::end();
    endif;
    ?> 
