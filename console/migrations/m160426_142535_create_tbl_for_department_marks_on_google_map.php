<?php

use console\components\Migration;

/**
 * Class m160426_142535_create_tbl_for_department_marks_on_google_map migration
 */
class m160426_142535_create_tbl_for_department_marks_on_google_map extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%department_on_map}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey(),

                'contact_person' => $this->string()->defaultValue(null),
                'contact_address' => $this->string()->defaultValue(null),
                'contact_tel' => $this->string()->defaultValue(null),
                'contact_email' => $this->string()->defaultValue(null),
                'contact_fax' => $this->string()->defaultValue(null),

                'mark_baloon_type' => $this->integer()->notNull()->defaultValue(0)->comment('0 - Plant; 1 - Sales contacts'),

                'lat' => $this->string(255)->notNull(),
                'long' => $this->string(255)->notNull(),

                'published' => $this->boolean()->notNull()->defaultValue(1)->comment('Published'),
                'position' => $this->integer()->notNull()->defaultValue(0)->comment('Position'),

                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
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
