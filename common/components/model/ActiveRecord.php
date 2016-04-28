<?php

namespace common\components\model;

/**
 * Class ActiveRecord
 * @package common\components\model
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    use Helper;

    public $showCreateButton = true;
    public $showUpdateButton = true;
    public $showDeleteButton = true;

    /**
     * @inheritdoc
     * @return DefaultQuery
     */
    public static function find()
    {
        return new DefaultQuery(get_called_class());
    }
}
