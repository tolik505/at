<?php
/**
 * Created by PhpStorm.
 * User: metal
 * Date: 11.10.15
 * Time: 22:19
 */

namespace common\components\model;

/**
 * Class IsPublishedTrait
 */
trait IsPublishedTrait
{
    /**
     * @return $this
     */
    public function isPublished()
    {
        $this->andWhere(['published' => 1]);
        return $this;
    }
}
