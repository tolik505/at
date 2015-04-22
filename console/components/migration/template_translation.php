<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name */
/* @var $tableName string the new migration table name */

echo "<?php\n";
?>

use yii\db\Schema;
use console\components\Migration;

/**
 * Class <?= $className ?> migration
 */
class <?= $className ?> extends Migration
{
    /**
     * Migration related table name
     */
    public $tableName = '{{%<?= $tableName . '_translation' ?>}}';

    /**
     * main table name, to make constraints
     */
    public $tableNameRelated = '{{%<?= $tableName ?>}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'model_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Related model id"',
                'language' => Schema::TYPE_STRING . '(16) NOT NULL COMMENT "Language"',

                // examples:
                //'label' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Label"',
                //'content' => Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Content"',
            ],
            $this->tableOptions
        );

        $this->addPrimaryKey('', $this->tableName, ['model_id', 'language']);

        $this->addForeignKey(
            'fk-<?= $tableName . '_translation' ?>-model_id-<?= $tableName ?>-id',
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
