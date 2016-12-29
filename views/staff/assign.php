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
        <?= $this->render('_view', ['model' => $model]) ?> 
        <?= $this->render('_assign', ['model' => $model]) ?> 








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





    </div>
