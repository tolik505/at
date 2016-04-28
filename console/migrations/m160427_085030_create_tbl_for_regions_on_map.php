<?php

use console\components\Migration;

/**
 * Class m160427_085030_create_tbl_for_regions_on_map migration
 */
class m160427_085030_create_tbl_for_regions_on_map extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%regions_map_scale}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey(),

                'label' => $this->string()->notNull(),
                'lat' => $this->string(255)->notNull(),
                'long' => $this->string(255)->notNull(),
                'scale' => $this->string(255)->notNull(),

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
