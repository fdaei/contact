<?php

use yii\db\Migration;

/**
 * Class m240407_192037_real_legal_contact
 */
class m240407_192037_real_legal_contact extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%real_legal_contact}}',
            [
                'id' => $this->primaryKey(),
                'legal_contact_id' => $this->integer()->unsigned()->notNull(),
                'real_contact_id' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('legal_contact_id_ibfk_1', '{{%real_legal_contact}}', ['legal_contact_id']);
        $this->createIndex('real_contact_id_ibfk_2', '{{%real_legal_contact}}', ['real_contact_id']);

        $this->addForeignKey(
            'legal_contact_id_ibfk_1',
            '{{%real_legal_contact}}',
            ['legal_contact_id'],
            '{{%legal_contact}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'real_contact_id_ibfk_2',
            '{{%real_legal_contact}}',
            ['real_contact_id'],
            '{{%real_contact}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%real_legal_contact}}');
    }

}
