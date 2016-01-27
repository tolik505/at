<?php

use console\components\Migration;
use yii\db\Schema;

class m150209_000001_add_admin_user_table extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%admin_user}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => Schema::TYPE_PK,

            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL DEFAULT ""',
            'username' => Schema::TYPE_STRING . ' NOT NULL COMMENT "User name"',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
            'email' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Email"',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1 COMMENT "Status"',

            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
