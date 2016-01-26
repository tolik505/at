<?php
/**
 * Created by PhpStorm.
 * User: metal
 * Date: 11.10.15
 * Time: 21:34
 */

namespace common\components;

/**
 * Class ColumnSchemaBuilder
 * @package common\components
 */
class ColumnSchemaBuilder extends \yii\db\ColumnSchemaBuilder
{
    /**
     * @var
     */
    protected $comment;

    /**
     * Build full string for create the column's schema
     * @return string
     */
    public function __toString()
    {
        return
            $this->type .
            $this->buildLengthString() .
            $this->buildNotNullString() .
            $this->buildUniqueString() .
            $this->buildDefaultString() .
            $this->buildCheckString() .
            $this->buildCommentString();
    }

    public function buildCommentString()
    {
        return  $this->comment !== null ? " COMMENT '{$this->comment}'" : '';
    }

    /**
     * @param $comment
     * @return $this
     */
    public function comment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
}
