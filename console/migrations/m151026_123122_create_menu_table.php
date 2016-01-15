<?php

use console\components\Migration;

/**
 * Class m151026_123122_create_menu_table migration
 */
class m151026_123122_create_menu_table extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%menu}}';

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

                'parent_id' => $this->integer()->defaultValue(null)->comment('Parent'),

                'model_class' => $this->string(100)->notNull()->comment('Model'),
                'model_pk' => $this->string(50)->defaultValue(null)->comment('Model ID'),

                'published' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('Published'),
                'position' => $this->integer()->notNull()->defaultValue(0)->comment('Position'),

                'created_at' => $this->integer()->comment('Created at'),
                'updated_at' => $this->integer()->comment('Updated at'),
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
