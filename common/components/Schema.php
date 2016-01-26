<?php
/**
 * Created by PhpStorm.
 * User: metal
 * Date: 11.10.15
 * Time: 21:33
 */

namespace common\components;

/**
 * Class Schema
 */
class Schema extends \yii\db\mysql\Schema
{
    /**
     * @inheritdoc
     */
    public function createColumnSchemaBuilder($type, $length = null)
    {
        return new ColumnSchemaBuilder($type, $length);
    }
}
