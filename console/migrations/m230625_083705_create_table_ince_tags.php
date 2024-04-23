<?php

use yii\db\Migration;

class m230625_083705_create_table_ince_tags extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tags}}',
            [
                'tag_id' => $this->primaryKey(),
                'name' => $this->string(128)->notNull(),
                'frequency' => $this->integer()->defaultValue('0'),
                'color' => $this->string(10),
                'status' => $this->tinyInteger()->notNull()->defaultValue('1'),
                'deleted_at' => $this->integer()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('fulltext_name', '{{%tags}}', ['name']);
        $this->createIndex('unique_name_deleted_at', '{{%tags}}', ['name', 'deleted_at'], true);
    }

    public function safeDown()
    {
        $this->dropIndex('fulltext_name', '{{%tags}}');
        $this->dropIndex('unique_name_deleted_at', '{{%tags}}');
        $this->dropTable('{{%tags}}');
    }

}