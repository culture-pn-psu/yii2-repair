<?php

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;

/* @var $this \yii\web\View */
/* @var $content string */

$controller = $this->context;
//$menus = $controller->module->menus;
//$route = $controller->route;
?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>

<div class="row">
    <div class="col-md-3 hidden-print">

        <?= Html::a('<i class="fa fa-wrench"></i> ' . Yii::t('app', 'แจ้งซ่อม'), ['/repair/default/create'], ['class' => 'btn btn-primary btn-block margin-bottom']) ?>


        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php /* =BaseStringHelper::truncate($this->title,20); */ ?>
                    ระบบแจ้งซ่อม
                </h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">

                <?php
                $nav = new common\models\Navigate();
                echo dmstr\widgets\Menu::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked'],
                    //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                    'items' => $nav->menu(4),
                ])
                ?>                 

            </div>
            <!-- /.box-body -->
        </div>

        <?php
        if (Yii::$app->user->can('staffIt') ||
                Yii::$app->user->can('staffMaterial')
        ):
            ?>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        สำหรับเจ้าหน้าที่
                    </h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">

                    <?php
                    $nav = new common\models\Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $nav->menu(5),
                    ])
                    ?>                 

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        <?php endif; ?>

<?php /* if (Yii::$app->user->can('headSupport')): ?>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        สำหรับหัวหน้า
                    </h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">

                    <?php
                    $nav = new common\models\Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $nav->menu(6),
                    ])
                    ?>                 

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
<?php endif; ?>

<?php if (Yii::$app->user->can('director')): ?>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        สำหรับผู้บริหาร
                    </h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">

                    <?php
                    $nav = new common\models\Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $nav->menu(7),
                    ])
                    ?>                 

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
<?php endif; */?>
    </div>
    <!-- /.col -->


    <div class="col-md-9">
<?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->


</div>


<?php $this->endContent(); ?>
