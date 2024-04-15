<?php

use yii\db\Migration;

/**
 * Class m240414_135205_legal_contact_file
 */
class m240414_135205_legal_contact_file extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%legal_contact_file}}', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(255)->notNull(),
            'file_path' => $this->string(255)->notNull(),
            'contact_id'=>$this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'created_by' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'updated_by' => $this->integer()->unsigned()->notNull(),
            'deleted_at' => $this->integer()->unsigned()->defaultValue(0),
        ]);

        $this->createIndex('idx-legal_contact_file-contact_id', '{{%legal_contact_file}}', 'contact_id');
        $this->createIndex('idx-legal_contact_file-created_by', '{{%legal_contact_file}}', 'created_by');
        $this->createIndex('idx-legal_contact_file-updated_by', '{{%legal_contact_file}}', 'updated_by');

        $this->addForeignKey(
            'fk-legal_contact_file-contact_id',
            '{{%legal_contact_file}}',
            'contact_id',
            'legal_contact',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-legal_contact_file-created_by',
            '{{%legal_contact_file}}',
            'created_by',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-legal_contact_file-updated_by',
            '{{%legal_contact_file}}',
            'updated_by',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-legal_contact_file-contact_id',
            '{{%legal_contact_file}}'
        );
        $this->dropForeignKey(
            'fk-legal_contact_file-created_by',
            '{{%legal_contact_file}}'
        );
        $this->dropForeignKey(
            'fk-legal_contact_file-updated_by',
            '{{%legal_contact_file}}'
        );

        $this->dropIndex('idx-legal_contact_file-contact_id', '{{%legal_contact_file}}');
        $this->dropIndex('idx-legal_contact_file-created_by', '{{%legal_contact_file}}');
        $this->dropIndex('idx-legal_contact_file-updated_by', '{{%legal_contact_file}}');

        $this->dropTable('{{%legal_contact_file}}');
    }
}
