<?php

use yii\db\Migration;

/**
 * Class m240407_165507_create_real_contact
 */
class m240407_165507_create_real_contact extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%real_contact}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'image'=> $this->string(256)->null(),
                'first_name' => $this->string(128)->notNull(),
                'last_name' => $this->string(128)->notNull(),
                'national_code' => $this->string(128)->notNull(),
                'coin' => $this->integer()->defaultValue(0),
                'birth_city_id' => $this->integer()->unsigned()->notnull(),
                'birth_province_id'=>$this->integer()->unsigned()->notnull(),
                'birth_address'=>$this->string()->null(),
                'registration_date' =>$this->integer()->unsigned()->notNull(),
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
            ],
            $tableOptions
        );

        $this->createIndex('idx-real_contact-birth_city_id', '{{%real_contact}}', 'birth_city_id');
        $this->createIndex('idx-real_contact-birth_province_id', '{{%real_contact}}', 'birth_province_id');
        $this->createIndex('idx-real_contact-created_by', '{{%real_contact}}', 'created_by');
        $this->createIndex('idx-real_contact-updated_by', '{{%real_contact}}', 'updated_by');

        $this->addForeignKey(
            'fk-real_contact-birth_city_id',
            '{{%real_contact}}',
            'birth_city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-real_contact-birth_province_id',
            '{{%real_contact}}',
            'birth_province_id',
            '{{%province}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-real_contact-created_by',
            '{{%real_contact}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-real_contact-updated_by',
            '{{%real_contact}}',
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
            'fk-real_contact-birth_city_id',
            '{{%real_contact}}'
        );
        $this->dropForeignKey(
            'fk-real_contact-birth_province_id',
            '{{%real_contact}}'
        );
        $this->dropForeignKey(
            'fk-real_contact-created_by',
            '{{%real_contact}}'
        );
        $this->dropForeignKey(
            'fk-real_contact-updated_by',
            '{{%real_contact}}'
        );

        $this->dropIndex('idx-real_contact-birth_city_id', '{{%real_contact}}');
        $this->dropIndex('idx-real_contact-birth_province_id', '{{%real_contact}}');
        $this->dropIndex('idx-real_contact-created_by', '{{%real_contact}}');
        $this->dropIndex('idx-real_contact-updated_by', '{{%real_contact}}');

        $this->dropTable('{{%real_contact}}');

    }
}
