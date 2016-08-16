<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\repair\models\Repair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'material_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'solving')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'inform_at')->textInput() ?>

    <?= $form->field($model, 'inform_by')->textInput() ?>

    <?= $form->field($model, 'staffMaterial_id')->textInput() ?>

    <?= $form->field($model, 'staffMaterial_at')->textInput() ?>

    <?= $form->field($model, 'staff_id')->textInput() ?>

    <?= $form->field($model, 'staff_status')->textInput() ?>

    <?= $form->field($model, 'staff_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'staff_at')->textInput() ?>

    <?= $form->field($model, 'boss_id')->textInput() ?>

    <?= $form->field($model, 'boss_status')->textInput() ?>

    <?= $form->field($model, 'boss_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'boss_at')->textInput() ?>

    <?= $form->field($model, 'admin_id')->textInput() ?>

    <?= $form->field($model, 'admin_status')->textInput() ?>

    <?= $form->field($model, 'admin_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'admin_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('repair', 'Create') : Yii::t('repair', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
