<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Language]].
 *
 * @see Language
 */
class LanguageQuery extends \common\components\model\ActiveQuery
{
    use \common\components\model\IsPublishedTrait;

    /**
     * @inheritdoc
     * @return Language[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Language|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
