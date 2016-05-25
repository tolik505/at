    <?php

use console\components\Migration;

/**
 * Class m160525_062723_create_recipe_table migration
 */
class m160525_062723_create_recipe_table extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%recipe}}';

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
                'summary' => $this->text()->defaultValue(null)->comment('Summary'),
                'directions' => $this->text()->defaultValue(null)->comment('Directions'),

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
