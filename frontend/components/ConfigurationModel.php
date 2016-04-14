<?php
/**
 * Author: hanterrian
 */

namespace frontend\components;

use notgosu\yii2\modules\metaTag\components\MetaTagBehavior;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class ConfigurationModel
 *
 * @package frontend\components
 */
class ConfigurationModel extends Model
{
    public function getId()
    {
        return 1;
    }

    public function getIsNewRecord()
    {
        return false;
    }

    public function init()
    {
        parent::init();

        $seo = $this->getBehavior('seo');
        if ($seo && $seo instanceof \notgosu\yii2\modules\metaTag\components\MetaTagBehavior) {
            $this->loadMetaTags();
        }
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'seo' => [
                'class' => MetaTagBehavior::className(),
            ],
        ]);
    }

    public static function register()
    {
        $model = new static;

        ConfigurationMetaTagRegister::register($model, \Yii::$app->language);
    }
}
