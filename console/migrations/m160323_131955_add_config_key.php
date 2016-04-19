<?php

use console\components\Migration;

/**
 * Class m160323_131955_add_config_key migration
 */
class m160323_131955_add_config_key extends Migration
{
    /**
     * migration table name
     */
    public $tableName = '{{%configuration}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert($this->tableName, [
            'id' => 'endHead',
            'type' => 2,
            'description' => 'End <HEAD>',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert($this->tableName, [
            'id' => 'endBody',
            'type' => 2,
            'description' => 'End <BODY>',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
    }
}
