<?php

use console\components\Migration;

/**
 * Class m160521_184501_create_ingredient_table migration
 */
class m160521_184501_create_ingredient_table extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%ingredient}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey(),

                'label' => $this->string()->notNull()->comment('Label'),

                'published' => $this->boolean()->notNull()->defaultValue(1)->comment('Published'),
                'position' => $this->integer()->notNull()->defaultValue(0)->comment('Position'),

                'created_at' => $this->integer()->notNull()->comment('Created At'),
                'updated_at' => $this->integer()->notNull()->comment('Updated At'),
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
