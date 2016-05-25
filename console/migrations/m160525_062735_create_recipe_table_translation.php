<?php

use console\components\Migration;

/**
 * Class m160525_062735_create_recipe_table_translation migration
 */
class m160525_062735_create_recipe_table_translation extends Migration
{
    /**
     * Migration related table name
     */
    public $tableName = '{{%recipe_translation}}';

    /**
     * main table name, to make constraints
     */
    public $tableNameRelated = '{{%recipe}}';

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

                'label' => $this->string()->comment('Label'),
                'summary' => $this->text()->comment('Summary'),
                'directions' => $this->text()->comment('Directions'),
            ],
            $this->tableOptions
        );

        $this->addPrimaryKey('', $this->tableName, ['model_id', 'language']);

        $this->addForeignKey(
            'fk-recipe_translation-model_id-recipe-id',
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
