<?php

namespace culturePnPsu\repair;

use Yii;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'culturePnPsu\repair\controllers';

    public function init()
    {
        $this->layout = 'left-menu.php';
        Yii::setAlias('@culturePnPsu/repair', '@vendor/culture-pn-psu/yii2-repair');
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
