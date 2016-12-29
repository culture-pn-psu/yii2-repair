<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\RepairProcess */
/* @var $form yii\widgets\ActiveForm */
use common\models\User;

//echo "<pre>";
//print_r(User::findByRole('admin'));
//exit();
?> 
<div class="box box-widget hidden-print">
    <div class="box-header with-border">
        <i class="fa fa-check-square-o"></i> เลือกเจ้าหน้า หัวหน้า และผู้บริหารในการออกความคิดเห็น
    </div>
    <!-- /.box-header -->
    <div class="box-body box-comments">
        <?php $form = ActiveForm::begin(); ?> 
        <div class="row"> 
            <div class="col-sm-4 col-sm-offset-2"> 
                <?= $form->field($model, 'staff_id')->dropDownList(User::findByRole('staffIt'), ['prompt' => 'เลือก']) ?>    

            </div> 
        </div> 
        <div class="row"> 
            <div class="col-sm-4 col-sm-offset-2"> 
                <?= $form->field($model, 'boss_id')->dropDownList(User::findByRole('headSupport'), ['prompt' => 'เลือก']) ?>    

            </div> 
        </div> 
        <div class="row"> 
            <div class="col-sm-4 col-sm-offset-2"> 
                <?= $form->field($model, 'admin_id')->dropDownList(User::findByRole('director'), ['prompt' => 'เลือก']) ?>    

            </div> 
        </div>
    </div>

    <div class="box-footer"> 

        <div class="row"> 
            <div class="col-sm-4 col-sm-offset-2"> 
                <div class="form-group"> 
                    <?= Html::submitButton(Yii::t('person', 'รับเรื่อง'), ['class' => 'btn btn-primary']) ?> 
                </div>    
            </div>    
        </div>    


    </div>

    <?php
    ActiveForm::end();
    ?>


</div>