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
    <?php $form = ActiveForm::begin(); ?> 
    <div class="row"> 
        <div class="col-sm-4 col-sm-offset-1"> 
            <?= $form->field($model, 'staff_id')->dropDownList(User::findByRole('staffIt'), ['prompt' => 'เลือก']) ?>    

        </div> 
    </div>

    <div class="row"> 
        <div class="col-sm-4 col-sm-offset-1"> 
            <?= $form->field($model, 'boss_id')->dropDownList(User::findByRole('headSupport'), ['prompt' => 'เลือก']) ?>    

        </div> 
    </div> 
    <div class="row"> 
        <div class="col-sm-4 col-sm-offset-1"> 
            <?= $form->field($model, 'admin_id')->dropDownList(User::findByRole('director'), ['prompt' => 'เลือก']) ?>    

        </div> 
    </div>

    <div class="row"> 
        <div class="col-sm-4 col-sm-offset-1"> 

            <div class="form-group"> 
                <?= Html::submitButton(Yii::t('person', 'แจ้งผู้เกี่ยวข้อง'), ['class' => 'btn btn-primary']) ?> 
            </div>    

        </div> 
    </div>

    <?php
    ActiveForm::end();

?>
