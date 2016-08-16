<?php

use yii\helpers\Html;
?>

<?php
// รับเรื่อง
if (isset($model->staffMaterial_id) && $model->status > 1):
    ?>

    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->staffMaterial->displaynameImg ?>
        </div>

        <div class="box-footer box-comments">
            <div class="box-comment">
                <div class="comment-text">
                    รับเรื่องเมื่อวันที่ <?= Yii::$app->formatter->asDatetime($model->staffMaterial_at) ?>
                </div>
                <!-- /.box-comment -->
            </div>
        </div>

    </div>
    <?php
endif;
?>



<?php if ($model->staff_status): ?>
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->staff->displaynameImg ?>
        </div>
        <!-- /.box-header -->
        <div class="box-footer box-comments">
            <div class="box-comment">
                <div class="comment-text">
                    <span class="username">
                        <?= $model->staffStatusLabel; ?>
                        <span class="text-muted pull-right"> 
                            <?= Yii::$app->formatter->asDatetime($model->staff_at) ?>
                        </span>
                    </span><!-- /.username -->
                    <?= $model->staff_comment ? '<b>เนื่องจาก : </b>' . $model->staff_comment : ''; ?>
                </div>
                <!-- /.comment-text -->
            </div>
            <!-- /.box-comment -->
        </div>

    </div>
<?php endif; ?>


<?php if ($model->boss_status || $model->staff_status==2): ?>
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->boss->displaynameImg ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $model->bossStatusLabel; ?>
            <?= $model->boss_comment ? '<b>เนื่องจาก : </b>' . $model->boss_comment : ''; ?>
        </div>
        <div class="box-footer">
            <?= $model->boss_at; ?>
        </div>
        <!-- /.box-body -->
    </div>
<?php endif; ?>

<?php if ($model->admin_status|| $model->boss_status == 1): ?>
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->admin->displaynameImg ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $model->adminStatusLabel; ?>
            <?= $model->admin_comment ? '<b>เนื่องจาก : </b>' . $model->admin_comment : ''; ?>
        </div>
        <!-- /.box-body -->
    </div>
<?php endif; ?>