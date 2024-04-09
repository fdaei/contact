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
            'national_id' => $this->string()->notNull(),
            'economic_code' => $this->string()->null(),
            'coin' => $this->integer()->defaultValue(0),
            'registration_city_id' => $this->integer()->unsigned()->null(),
            'registration_province_id'=>$this->integer()->unsigned()->null(),
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%legal_contact}}');
    }
}
