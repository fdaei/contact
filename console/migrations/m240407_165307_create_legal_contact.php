<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%legal_entities}}`.
 */
class m240407_165307_create_legal_contact extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%legal_contact}}', [
            'id' => $this->primaryKey()->unsigned(),
            'logo' => $this->string()->null(),
            'name' => $this->string()->notNull(),
            'national_code' => $this->string()->notNull(),
            'economic_code' => $this->string()->null(),
            'coin' => $this->integer()->defaultValue(0),
            'registration_city_id' => $this->integer()->unsigned()->notnull(),
            'registration_province_id'=>$this->integer()->unsigned()->notnull(),
            'registration_address'=>$this->string()->null(),
            'registration_date' => $this->date()->defaultValue(date('Y-m-d')),
            'status' => $this->tinyInteger()->unsigned()->notNull(),
            'summary' => $this->text()->null(),
            'description' => $this->text()->null(),
            'mobile_numbers' => $this->json()->null(),
            'social_links' => $this->json()->null(),
            'phone_numbers' => $this->json()->null(),
            'fax_numbers' => $this->json()->null(),
            'addresses' => $this->json()->null(),
            'emails' => $this->json()->null(),
            'websites' => $this->json()->null(),
            'bank_accounts' => $this->json()->null(),
            'cards' => $this->json()->null(),
            'shaba_numbers' => $this->json()->null(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'created_by' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'updated_by' => $this->integer()->unsigned()->notNull(),
            'deleted_at' => $this->integer()->unsigned()->defaultValue(0),
        ]);
        $this->createIndex('idx-legal_contact-registration_city_id', '{{%legal_contact}}', 'registration_city_id');
        $this->createIndex('idx-legal_contact-registration_province_id', '{{%legal_contact}}', 'registration_province_id');
        $this->createIndex('idx-legal_contact-created_by', '{{%legal_contact}}', 'created_by');
        $this->createIndex('idx-legal_contact-updated_by', '{{%legal_contact}}', 'updated_by');

        $this->addForeignKey(
            'fk-legal_contact-registration_city_id',
            '{{%legal_contact}}',
            'registration_city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-legal_contact-registration_province_id',
            '{{%legal_contact}}',
            'registration_province_id',
            '{{%province}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-legal_contact-created_by',
            '{{%legal_contact}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-legal_contact-updated_by',
            '{{%legal_contact}}',
            'updated_by',
            '{{%user}}',
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
            'fk-legal_contact-registration_city_id',
            '{{%legal_contact}}'
        );
        $this->dropForeignKey(
            'fk-legal_contact-registration_province_id',
            '{{%legal_contact}}'
        );
        $this->dropForeignKey(
            'fk-legal_contact-created_by',
            '{{%legal_contact}}'
        );
        $this->dropForeignKey(
            'fk-legal_contact-updated_by',
            '{{%legal_contact}}'
        );

        $this->dropIndex('idx-legal_contact-registration_city_id', '{{%legal_contact}}');
        $this->dropIndex('idx-legal_contact-registration_province_id', '{{%legal_contact}}');
        $this->dropIndex('idx-legal_contact-created_by', '{{%legal_contact}}');
        $this->dropIndex('idx-legal_contact-updated_by', '{{%legal_contact}}');

        $this->dropTable('{{%legal_contact}}');

    }
}
