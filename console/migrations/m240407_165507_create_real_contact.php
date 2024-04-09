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
                'national_id' => $this->string(128)->notNull(),
                'coin' => $this->integer()->defaultValue(0),
                'birth_city_id' => $this->integer()->unsigned()->null(),
                'birth_province_id'=>$this->integer()->unsigned()->null(),
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%real_contact}}');
    }
}
