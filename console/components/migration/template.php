<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name */
/* @var $tableName string the new migration table name */

echo "<?php\n";
?>

use console\components\Migration;

/**
 * Class <?= $className ?> migration
 */
class <?= $className ?> extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%<?= $tableName; ?>}}';

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
                'content' => $this->text()->defaultValue(null)->comment('Content'),

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
