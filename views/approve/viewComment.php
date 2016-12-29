<?php

use yii\helpers\Html;

if (isset($model->staffMaterial_id) && $model->status > 1):
    ?>

    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->staffMaterial->displaynameImg ?>
        </div>

        <div class="box-footer box-comments">
            <div class="box-comment">
                <div class="comment-text">
                    รับเรื่องแล้ว
                    <span class="text-muted pull-right"> 
                        <?= Yii::$app->formatter->asDatetime($model->staffMaterial_at) ?>
                    </span>
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
<!--                    
                    </span> /.username -->
                    <?= $model->staff_comment ? '<b>เพราะ </b>' . $model->staff_comment : ''; ?>
                </div>
                <!-- /.comment-text -->
            </div>
            <!-- /.box-comment -->
        </div>

    </div>
<?php endif; ?>


<?php if ($model->boss_status): ?>
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->boss->displaynameImg ?>
        </div>
        <!-- /.box-header -->
        <div class="box-footer box-comments">
            <div class="comment-text">
                <span class="username">
                    <?= $model->bossStatusLabel; ?>
                    <span class="text-muted pull-right"> 
                        <?= Yii::$app->formatter->asDatetime($model->boss_at) ?>
                    </span>
                </span><!-- /.username -->
                <?= $model->boss_comment ? '<b>เพราะ </b>' . $model->boss_comment : ''; ?>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
<?php endif; ?>

<?php if ($model->admin_status): ?>
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $model->admin->displaynameImg ?>
        </div>
        <!-- /.box-header -->
        
        <div class="box-footer box-comments">
            <div class="comment-text">
                <span class="username">
                    <?= $model->adminStatusLabel; ?>
                    <span class="text-muted pull-right"> 
                        <?= Yii::$app->formatter->asDatetime($model->admin_at) ?>
                    </span>
                </span><!-- /.username -->
                <?= $model->admin_comment ? '<b>เพราะ </b>' . $model->admin_comment : ''; ?>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
<?php endif; ?>