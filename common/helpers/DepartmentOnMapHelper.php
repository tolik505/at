<?php
/**
 * Author: metal
 * Email: metal
 */

namespace common\helpers;


/**
 * Class Dump
 * @package common\helpers
 */
class DepartmentOnMapHelper
{
    /**
     * @inheritdoc
     */
    const TYPE_PLANTS = 0;
    const TYPE_SALES_CONTACTS = 1;

    public static function getBalloonTypeArray(){

        return [
            self::TYPE_PLANTS => 'Plant',
            self::TYPE_SALES_CONTACTS => 'Sales contacts'
        ];

    }
}
