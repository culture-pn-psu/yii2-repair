<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\Repair */

$this->title = 'รับเรื่องการแจ้งซ่อม:เลขที่ ' . " " . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'รายการแจ้งซ่อม'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box'>
    <div class='box-header hidden-print'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        <!--        <div class="box-tools">           
        <?= Html::a('<i class="fa fa-print"></i>', '#', ['class' => 'btn btn-primary btn-sm', 'onclick' => 'window.print();']) ?>
                </div>-->
    </div><!--box-header -->    

    <div class='box-body pad'>
        <div class='row hidden-print'>
            <div class='row'>
                <div class='col-sm-8 col-sm-offset-1'>

                    <div class='row'>
                        <div class='col-sm-12'>
                            <?= Html::tag('h3', 'มอบหมายการซ่อมครุภัณฑ์', ['class' => 'text-left']) ?> 
                        </div>
                    </div><!--row -->





                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table table-borderless'],
                        'template' => '<tr><td class="text-left" width="150"><label>{label}</label></td><td> {value}</td></tr>',
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'inform_by',
                                'value' => $model->informBy->person->fullname,
                            ],
                            [
                                'label' => 'ตำแหน่ง/ฝ่าย',
                                'value' => $model->informBy->personPosition . '/' . $model->informBy->personParent
                            ],
                            [
                                'label' => 'เบอร์ติดต่อ',
                                'value' => $model->informBy->personTel
                            ],
                            [
                                'attribute' => 'inform_at',
                                'value' => Yii::$app->thaiFormatter->asDate($model->inform_at, 'long'),
                            ],
                        ],
                    ])
                    ?>

                    <div class='row'>
                        <div class='col-sm-10 col-sm-offset-1'>

                            <?= Html::tag('h4', 'ขอแจ้งซ่อมพัสดุดังรายการต่อไปนี้') ?>




                            <?=
                            DetailView::widget([
                                'model' => $model,
                                //'options' => ['class' => 'table table-borderless'],
                                'template' => '<tr><td class="text-left" width="150"><label>{label}</label></td><td> {value}</td></tr>',
                                'attributes' => [
                                    'material_id',
                                    'material.title',
                                    [
                                        'attribute' => 'type',
                                        'value' => $model->typeLabel,
                                    ],
                                    'problem:html',
                                ],
                            ])
                            ?>
                        </div><!--col -->
                    </div><!--row -->


                    <div class='row'>
                        <div class='col-sm-11'>


                            <?php $form = ActiveForm::begin(); ?> 


                            <div class='row'>
                                <div class='col-sm-6'> 
                                    <?php
                                    if ($model->type == 2) {
                                        echo $form->field($model, 'staff_id')->dropDownList(User::findByRole('staffIt'), ['prompt' => 'เลือก'])->label('เจ้าหน้าที่คอมฯ');
                                    }
                                    ?>
                                    <?= $form->field($model, 'boss_id')->dropDownList(User::findByRole('headSupport'), ['prompt' => 'เลือก'])->label('หัวหน้าเจ้าหน้าที่พัสดุ') ?>
                                    <?= $form->field($model, 'admin_id')->dropDownList(User::findByRole('director'), ['prompt' => 'เลือก'])->label(Yii::t('system', 'director')) ?>
                                </div>
                            </div>


                            <div class="form-group"> 
                                <?= Html::submitButton(Yii::t('person', 'รับเรื่อง'), ['class' => 'btn btn-primary']) ?> 
                            </div>

                            <?php
                            ActiveForm::end();
                            ?>

                        </div><!--box-body pad-->  
                    </div><!--box box-info-->




                </div><!--col -->
            </div><!--row -->
        </div>
    </div>
