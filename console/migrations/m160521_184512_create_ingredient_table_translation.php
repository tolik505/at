<?php

use console\components\Migration;

/**
 * Class m160521_184512_create_ingredient_table_translation migration
 */
class m160521_184512_create_ingredient_table_translation extends Migration
{
    /**
     * Migration related table name
     */
    public $tableName = '{{%ingredient_translation}}';

    /**
     * main table name, to make constraints
     */
    public $tableNameRelated = '{{%ingredient}}';

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
            ],
            $this->tableOptions
        );

        $this->addPrimaryKey('', $this->tableName, ['model_id', 'language']);

        $this->addForeignKey(
            'fk-ingredient_translation-model_id-ingredient-id',
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
