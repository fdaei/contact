<?php

use yii\db\Migration;

class m221102_082952_create_table_business_timeline extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business_timeline}}',
            [
                'id' => $this->primaryKey(),
                'business_id' => $this->integer()->notNull(),
                'year' => $this->date()->notNull(),
                'description' => $this->text()->notNull(),
                'status' => $this->boolean()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('business_id', '{{%business_timeline}}', ['business_id']);
        $this->createIndex('created_by', '{{%business_timeline}}', ['created_by']);
        $this->createIndex('updated_by', '{{%business_timeline}}', ['updated_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_timeline}}');
    }
}
