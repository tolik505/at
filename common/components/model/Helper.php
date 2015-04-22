<?php

namespace common\components\model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Helper
 * @package common\components\model
 */
trait Helper
{
    /**
     * In Model required definition like this:
     *
     *  const TYPE_ONE = 1;
     *  const TYPE_TWO = 2;
     *  protected static $type = [
     *      self::TYPE_ONE => 'Type one language key',
     *      self::TYPE_TWO => 'Type two language key',
     *  ];
     *
     * @param string $attribute the attribute name
     * @param string $category the translation category
     * @return array
     */
    public static function getList($attribute, $category = 'app')
    {
        static $labels = null;
        static $categoryName = null;

        if ($labels === null || $categoryName !== $category) {
            $labels = [];
            $categoryName = $category;
            if (is_array(static::${$attribute})) {
                foreach (static::${$attribute} as $key => $value) {
                    $labels[$key] = Yii::t($category, $value);
                }
            }
        }

        return $labels;
    }

    /**
     * Additional method for the {getList}
     *
     * @param string $attribute the attribute name
     * @param string $category the translation category
     * @return array
     */
    public function getListLabel($attribute, $category = 'app')
    {
        return isset(static::getList($attribute, $category)[$this->$attribute])
            ? static::getList($attribute, $category)[$this->$attribute]
            : Yii::t('app', 'Error get attribute value label');
    }

    public static function getItems($key = false, $label = false)
    {
        $class = get_called_class();
        /**
         * @var \yii\db\ActiveRecord $class
         */
        $class = new $class();
        if ($key === false) {
            $key = $class->primaryKey();
            if (count($key) !== 1) {
                return [];
            }
            $key = $key[0];
        }

        if ($label === false) {
            $label = $key;
            if (in_array('label', $class->attributes(), true)) {
                $label = 'label';
            }
        }

        $all = $class::find()->select([$key, $label])->asArray()->all();

        return ArrayHelper::map($all, $key, $label);
    }
}
