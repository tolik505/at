<?php

use console\components\Migration;

/**
 * Class m160525_072734_create_ingredient_to_recipe_table migration
 */
class m160525_072734_create_ingredient_to_recipe_table extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%ingredient_to_recipe}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey(),

                'ingredient_id' => $this->integer()->notNull()->comment('Ingredient'),
                'recipe_id' => $this->integer()->notNull()->comment('Recipe'),
                'note' => $this->string()->defaultValue(null)->comment('Note'),

                'published' => $this->boolean()->notNull()->defaultValue(1)->comment('Published'),
                'position' => $this->integer()->notNull()->defaultValue(0)->comment('Position'),

                'created_at' => $this->integer()->notNull()->comment('Created At'),
                'updated_at' => $this->integer()->notNull()->comment('Updated At'),
            ],
            $this->tableOptions
        );
        $this->addForeignKey(
            'fk_ingredient_id_to_ingredient_table',
            $this->tableName,
            'ingredient_id',
            \common\models\Ingredient::tableName(),
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_recipe_id_to_recipe_table',
            $this->tableName,
            'recipe_id',
            'recipe',
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
