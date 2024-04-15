<?php

use yii\db\Migration;

class m221102_113448_create_table_city extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%city}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'province_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string(128)->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue(0),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%city}}', ['created_by']);
        $this->createIndex('province_id', '{{%city}}', ['province_id']);
        $this->createIndex('updated_by', '{{%city}}', ['updated_by']);

        $this->addForeignKey(
            'fk-city-province_id',
            'city',
            'province_id',
            'province',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'ince_city_ibfk_1',
            '{{%city}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_city_ibfk_2',
            '{{%city}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );


    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-city-province_id',
            'city'
        );
        $this->dropForeignKey(
            'ince_city_ibfk_1',
            '{{%city}}'
        );
        $this->dropForeignKey(
            'ince_city_ibfk_2',
            '{{%city}}'
        );

        $this->dropIndex('created_by', '{{%city}}');
        $this->dropIndex('province_id', '{{%city}}');
        $this->dropIndex('updated_by', '{{%city}}');

        $this->dropTable('{{%city}}');
    }

}