<?php

use yii\db\Schema;
use console\components\Migration;

/**
 * Class m150216_123758_create_session_table migration
 */
class m150216_123758_create_session_table extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%session}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => 'CHAR(64) NOT NULL PRIMARY KEY',
                'expire' => Schema::TYPE_INTEGER,
                'data' => 'LONGBLOB',
            ],
            $this->tableOptions
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
