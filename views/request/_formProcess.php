<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use culturePnPsu\material\models\Repair;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\RepairProcess */
/* @var $form yii\widgets\ActiveForm */
use common\models\User;

//echo "<pre>";
//print_r(User::findByRole('admin'));
//exit();
?> 
<div class="box box-widget">
    <div class="box-header with-border">
        <i class="fa fa-check-square-o"></i> เลือกเจ้าหน้า หัวหน้า และผู้บริหารในการออกความคิดเห็น
    </div>
    <!-- /.box-header -->
    <div class="box-footer box-comments">
        <?php $form = ActiveForm::begin(); ?> 
        <div class="row"> 
            <div class="col-sm-4"> 
                <?= $form->field($model, 'staff_id')->dropDownList(User::findByRole('staffIt'), ['prompt' => 'เลือก']) ?>    

            </div> 

            <div class="col-sm-4"> 
                <?= $form->field($model, 'boss_id')->dropDownList(User::findByRole('headSupport'), ['prompt' => 'เลือก']) ?>    

            </div> 

            <div class="col-sm-4"> 
                <?= $form->field($model, 'admin_id')->dropDownList(User::findByRole('director'), ['prompt' => 'เลือก']) ?>    

            </div> 
        </div>
    </div>

    <div class="box-footer"> 


        <div class="form-group"> 
            <?= Html::submitButton(Yii::t('person', 'แจ้งผู้เกี่ยวข้อง'), ['class' => 'btn btn-primary']) ?> 
        </div>    


    </div>

    <?php
    ActiveForm::end();
    ?>


</div>