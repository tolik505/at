<?php
namespace frontend\modules\request\models;

use app\modules\request\models\Request;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class RequestMailUs extends Model
{
    public $name;
    public $email;
    public $message;

    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'E-mail',
            'message' => 'Message',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'message', 'email'], 'required'],
            [['email'], 'email'],
        ];
    }

    /**
     * @return null|\yii\web\IdentityInterface
     */
    public function save()
    {
        if ($this->validate()) {

            $newRequest = new Request();

            $newRequest->name = $this->name;
            $newRequest->email = $this->email;
            $newRequest->message = $this->message;

            $newRequest->created_at = time();

            $newRequest->save(false);

            return $newRequest;
        }

        return null;
    }
}
