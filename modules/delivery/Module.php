<?php

namespace app\modules\delivery;

/**
 * delivery module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\delivery\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layout = 'delivery';
        // custom initialization code goes here
    }
}
