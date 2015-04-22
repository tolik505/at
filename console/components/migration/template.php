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
                'id' => Schema::TYPE_PK,

                'label' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Label"',
                'content' => Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Content"',

                'published' => Schema::TYPE_SMALLINT . '(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT "Published"',
                'position' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL DEFAULT 0 COMMENT "Position"',

                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Created at"',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Updated at"',
            ],
            $this->tableOptions
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "<?= $className ?> cannot be reverted.\n";

        return false;
    }
}
