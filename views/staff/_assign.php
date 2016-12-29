<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\widgets\ActiveForm;
use common\models\User;
?>

<?php $form = ActiveForm::begin(); ?> 
<?php

if ($model->type == 2) {
    echo $form->field($model, 'staff_id')->dropDownList(User::findByRole('staffIt'), ['prompt' => 'เลือก'])->label('เจ้าหน้าที่คอมฯ');
}
?>
<?= $form->field($model, 'boss_id')->dropDownList(User::findByRole('headSupport'), ['prompt' => 'เลือก'])->label('หัวหน้าเจ้าหน้าที่พัสดุ') ?>
<?= $form->field($model, 'admin_id')->dropDownList(User::findByRole('director'), ['prompt' => 'เลือก'])->label(Yii::t('system', 'director')) ?>
<?php

ActiveForm::end();
?>