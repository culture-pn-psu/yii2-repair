<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
//use yii\widgets\MaskedInput;
//use culturePnPsu\material\models\Material;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use culturePnPsu\repair\models\Repair;

use dosamigos\ckeditor\CKEditor;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\material\models\Repair */
/* @var $form yii\widgets\ActiveForm */
use kartik\widgets\Typeahead;
use common\models\User;

$template = '<div>' .
        '<p class="repo-language"><i class="fa fa-info-circle"></i> {{value}}</p>' .
        '<p class="repo-name">{{display}} <i>{{brand}}</i></p><hr style="margin:5px 0" />' .
        '</div>';
?>



<?= Html::tag('h3', 'แบบฟอร์มแจ้งซ่อมครุภัณฑ์', ['class' => 'text-center']) ?>
<?= Html::tag('h4', Yii::$app->name, ['class' => 'text-center']) ?>
<p>&nbsp;</p>

<?php
$form = ActiveForm::begin([
            'id' => 'form-signup',
            'type' => ActiveForm::TYPE_HORIZONTAL]);
?>
<div class="row">
    <div class="col-sm-12">

        <div class="row">
            <div class="col-sm-2 text-right">
                <label>ชื่อ</label>
            </div>        

            <div class="col-sm-10">
                <?= User::getFullname(); ?>
            </div> 
        </div>
        <div class="row">
            <div class="col-sm-2 text-right">
                <label>ตำแหน่ง/ฝ่าย</label>
            </div>        

            <div class="col-sm-10">
                <?php if (User::getUserPerson()): ?>
                    <?= (User::getUserPerson()) ? User::getUserPerson()->position : ''; ?>
                    <?= (User::getUserPerson()->parent) ? ' / ' . User::getUserPerson()->parent : ''; ?>
                <?php endif; ?>
            </div> 
        </div>

<?=
        $form->field($model, 'material_id')->textInput()->widget(Typeahead::classname(), [
            'options' => ['placeholder' => $model->getAttributeLabel('material_id')],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
                    //'local' => $data,
                    //'limit' => 10,
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('title')",
                    'display' => 'value',
                    'remote' => [
                        'url' => Url::to(['/material/material/list']) . '?q=%QUERY',
                        'wildcard' => '%QUERY'
                    ],
                    'templates' => [
                        //'notFound' => '<div class="text-danger" style="padding:0 8px">Unable to find repositories for selected query.</div>',
                        'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
                    ]
                ]
            ],
            'pluginEvents' => [
                "typeahead:select" => "function(obj, item) { 
                    console.log(item);
                    $('input[name=\"Material[title]\"]').val(item.title).attr('readonly',true);
                    $('.btn-history').show();
                 }",
                "typeahead:render" => "function(obj, item,aa,bb) { 
                    console.log('close:'+item+' '+aa+' '+bb+' '+obj);
                    console.log(item);
                    console.log(obj);
                    if(!item){                        
                        $('input[name=\"Repair[material_title]\"]').val('').attr('readonly',false);
                        $('.btn-history').hide();
                    }
                }",
            ]
        ]);
        ?>


        <?php /*
        echo $form->field($model, 'material_id')->widget(MaskedInput::className(), [
            'mask' => [
                '999-99-999-99/j-9{1,2}/9{1,2}',
                'ศตa7110-9{1,3}-9{1,3}-9{1,2}/9{1,2}-9{1,2}/j',
                'ศตa711-9{1,3}-9{1,3}-9{1,2}/9{1,2}',
                'ศตa9.9-9{1,2}',
                'สวa9999-9{1,3}-9{1,3}-9{1,2}/9{1,2}-9{1,2}/j',
                'สวa999-9{1,3}-9{1,3}-99/j-9{1,2}/9{1,2}',
            //'สว.7105-9{1,3}-9{1,3}-9{1,2}/9{1,2}-9{1,2}/j',
            ],
            'definitions' => [
                'j' => [
                    'validator' => '[ร,ค,ง,ว,บ]',
                ],
                'a' => [
                    'validator' => '[" ",.]',
                ],
                'k' => [
                    'validator' => '[9905]',
                ]
            ]
        ])->widget(Typeahead::classname(), [
            'options' => ['placeholder' => $model->getAttributeLabel('material_id')],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
                    //'local' => $data,
                    //'limit' => 10,
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('title')",
                    'display' => 'value',
                    'remote' => [
                        'url' => Url::to(['/material/material/list']) . '?q=%QUERY',
                        'wildcard' => '%QUERY'
                    ],
                    'templates' => [
                        //'notFound' => '<div class="text-danger" style="padding:0 8px">Unable to find repositories for selected query.</div>',
                        'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
                    ]
                ]
            ],
            'pluginEvents' => [
                "typeahead:select" => "function(obj, item) { 
                    console.log(item);
                    $('input[name=\"Material[title]\"]').val(item.title).attr('readonly',true);
                    $('.btn-history').show();
                 }",
                "typeahead:render" => "function(obj, item,aa,bb) { 
                    console.log('close:'+item+' '+aa+' '+bb+' '+obj);
                    console.log(item);
                    console.log(obj);
                    if(!item){                        
                        $('input[name=\"Repair[material_title]\"]').val('').attr('readonly',false);
                        $('.btn-history').hide();
                    }
                }",
            ]
        ]);*/
        ?>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-2">
                <div class="panel panel-default">                
                    <div class="panel-body">
                        <?=
                        $form->field($modelMaterial, 'title')->textInput(['value' => $model->material_id ? $model->material->title : '', 'readonly' => $model->material_id ? true : false]);
                        ?>

                        <div class="row">               
                            <div class="col-sm-10 col-sm-offset-2">
                                <?=
                                Html::a('ประวัติการซ่อม', '#', ['class' => 'btn btn-default btn-history',
                                    "style" => $model->material_id ? "" : "display:none",
                                ])
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <?= $form->field($model, 'type')->dropDownList(Repair::getItemType());
        ?>

        <?=
        $form->field($model, 'problem')->widget(CKEditor::className(), [
            'options' => ['rows' => 10],
            'preset' => 'custom',
            'clientOptions' => [
                'toolbarGroups' => [
                    ['name' => 'paragraph', 'groups' => ['list', 'indent', 'align']],
                ],
            ],
        ])
        ?>

        <?php if (!$model->isNewRecord): ?>
            <div class="row">
                <div class="col-sm-2 text-right">
                    <label><?= $model->getAttributeLabel('status') ?></label>
                </div>
                <div class="col-sm-10">
                    <?= $model->statusLabel ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">

                <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-primary', 'name' => 'save']) ?> 
                <?= Html::submitButton(Yii::t('app', 'ยืนแจ้งซ่อม'), ['class' => 'btn btn-success', 'name' => 'send']) ?>
            </div>
        </div>



    </div>


</div>



<?php ActiveForm::end(); ?>


<?php
Modal::begin([
    'header' => Html::tag('h4', 'ประวัติการซ่อม'),
    'id' => 'modalHistory',
    'size' => 'modal-lg'
]);
echo Html::tag('div', '', ['id' => 'modalContent']);

Modal::end();


$this->registerJs('
    
    $(".btn-history").click(function(){
        $.get( "' . Yii::$app->urlManager->createUrl('/material/material/history') . '",
            {
               "id":$("#repair-material_id").val(),                    
           },
           function(data){   
           $("#modalHistory").find("#modalContent").html(data);
           $("#modalHistory").modal("show");
          // console.log(data);
           }
        );  
        return;
    });

');

