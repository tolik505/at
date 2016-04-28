<?php

namespace app\modules\request\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property integer $created_at
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message', 'created_at'], 'required'],
            [['message'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }

    public static function createUrl($route, $params)
    {
        return Url::to(ArrayHelper::merge(
            [$route],
            $params
        ));
    }

    //url for request tasks
    public static function getRequestMailUsUrl($params = []){
        return self::createUrl('/popups/popups/mail-us', $params);
    }
}
