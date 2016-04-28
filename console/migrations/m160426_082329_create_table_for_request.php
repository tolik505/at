<?php

use console\components\Migration;

/**
 * Class m160426_082329_create_table_for_request migration
 */
class m160426_082329_create_table_for_request extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%request}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey(),

                'name' => $this->string('255')->notNull(),
                'email' => $this->string('255')->notNull(),
                'message' => $this->text()->notNull(),

                'created_at' => $this->integer()->notNull(),
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
