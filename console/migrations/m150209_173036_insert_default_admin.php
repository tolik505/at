<?php

use yii\db\Schema;
use console\components\Migration;

/**
 * Class m150209_173036_insert_default_admin migration
 */
class m150209_173036_insert_default_admin extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%admin_user}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert(
            $this->tableName,
            [
                'username' => 'admin',
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
                'email' => 'admin@dev.dev',
                'status' => \common\models\AdminUser::STATUS_ACTIVE,

                'created_at' => time(),
                'updated_at' => time(),
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->truncateTable($this->tableName);
    }
}
