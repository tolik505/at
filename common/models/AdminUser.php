<?php

namespace common\models;

use Yii;

/**
 * @inheritdoc
 *
 * @property UserAuth[] $userAuths
 */
class AdminUser extends \common\models\base\AdminUser
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuths()
    {
        return $this->hasMany(UserAuth::className(), ['user_id' => 'id']);
    }

}
