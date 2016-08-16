<?php

namespace backend\modules\repair;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\repair\controllers';

    public function init()
    {
        $this->layout = 'left-menu.php';
        parent::init();

        // custom initialization code goes here
    }
}
