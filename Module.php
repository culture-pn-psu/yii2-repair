<?php

namespace culturePnPsu\repair;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'culturePnPsu\repair\controllers';

    public function init()
    {
        $this->layout = 'left-menu.php';
        
        if (!isset(Yii::$app->i18n->translations['repair'])) {
            Yii::$app->i18n->translations['repair'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@culturePnPsu/repair/messages'
            ];
        }
        
        parent::init();

        // custom initialization code goes here
    }
}
