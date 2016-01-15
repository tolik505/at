<?php

use console\components\Migration;

/**
 * Class m151026_123134_create_menu_table_translation migration
 */
class m151026_123134_create_menu_table_translation extends Migration
{
    /**
     * Migration related table name
     */
    public $tableName = '{{%menu_translation}}';

    /**
     * main table name, to make constraints
     */
    public $tableNameRelated = '{{%menu}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'model_id' => $this->integer()->notNull()->comment('Related model id'),
                'language' => $this->string(16)->notNull()->comment('Language'),

                'label' => $this->string()->defaultValue(null)->comment('Label'),
            ],
            $this->tableOptions
        );

        $this->addPrimaryKey('', $this->tableName, ['model_id', 'language']);

        $this->addForeignKey(
            'fk-menu_translation-model_id-menu-id',
            $this->tableName,
            'model_id',
            $this->tableNameRelated,
            'id',
            'CASCADE',
            'CASCADE'
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
