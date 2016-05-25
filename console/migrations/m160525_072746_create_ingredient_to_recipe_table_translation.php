<?php

use console\components\Migration;

/**
 * Class m160525_072746_create_ingredient_to_recipe_table_translation migration
 */
class m160525_072746_create_ingredient_to_recipe_table_translation extends Migration
{
    /**
     * Migration related table name
     */
    public $tableName = '{{%ingredient_to_recipe_translation}}';

    /**
     * main table name, to make constraints
     */
    public $tableNameRelated = '{{%ingredient_to_recipe}}';

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

                'note' => $this->string()->comment('Note'),
            ],
            $this->tableOptions
        );

        $this->addPrimaryKey('', $this->tableName, ['model_id', 'language']);

        $this->addForeignKey(
            'fk-ingredient_to_recipe_translation-to-ingredient_to_recipe-id',
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
