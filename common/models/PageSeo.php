<?php

namespace common\models;

use Yii;
use notgosu\yii2\modules\metaTag\components\MetaTagRegister;


/**
 * @inheritdoc
 */
class PageSeo extends \common\models\base\PageSeo
{
    /** @const int */
    const ID_HOME_PAGE = 1;


    /** @param int $pageSeoId */
    public static function registerSeo($pageSeoId)
    {
        /** @var PageSeo $model */
        $model = PageSeo::findOne($pageSeoId);

        if ($model) {
            MetaTagRegister::register($model);
        }
    }
}
