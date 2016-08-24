<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\repair\models\ApproveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'material_id') ?>

    <?= $form->field($model, 'problem') ?>

    <?= $form->field($model, 'solving') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'inform_at') ?>

    <?php // echo $form->field($model, 'inform_by') ?>

    <?php // echo $form->field($model, 'staffMaterial_id') ?>

    <?php // echo $form->field($model, 'staffMaterial_at') ?>

    <?php // echo $form->field($model, 'staff_id') ?>

    <?php // echo $form->field($model, 'staff_status') ?>

    <?php // echo $form->field($model, 'staff_comment') ?>

    <?php // echo $form->field($model, 'staff_at') ?>

    <?php // echo $form->field($model, 'boss_id') ?>

    <?php // echo $form->field($model, 'boss_status') ?>

    <?php // echo $form->field($model, 'boss_comment') ?>

    <?php // echo $form->field($model, 'boss_at') ?>

    <?php // echo $form->field($model, 'admin_id') ?>

    <?php // echo $form->field($model, 'admin_status') ?>

    <?php // echo $form->field($model, 'admin_comment') ?>

    <?php // echo $form->field($model, 'admin_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('repair', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('repair', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
