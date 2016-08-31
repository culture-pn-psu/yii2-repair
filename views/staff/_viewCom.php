<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use common\models\User;
use yii\helpers\Html;
?>

<div class='row'>
    <div class='col-sm-6 '>
        <?=Html::tag('h3','พิจารณาเจ้าหน้าสารสนเทศ')?>
       <?= $form->field($model, 'staff_status')->radioList(['1'=>'ให้หน่วยงานพัสดุดำเนินการซ่อม','2'=>'เจ้าหน้าที่สารสนเทศซ่อมเอง'], ['prompt' => 'เลือก'])->label(false) ?>
        <?= $form->field($model, 'staff_comment')->textarea() ?>
    </div>
    <div class='col-sm-6 '>
       <?= $form->field($model, 'staff_id')->dropDownList(User::findByRole('staffIt'), ['prompt' => 'เลือก'])->label('เจ้าหน้าที่คอมฯ') ?>
    </div>
</div>