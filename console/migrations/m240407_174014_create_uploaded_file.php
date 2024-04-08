<?php

use yii\db\Migration;

/**
 * Class m240407_174014_create_uploaded_file
 */
class m240407_174014_create_uploaded_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%uploaded_file}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'model_class' => $this->string(255)->notNull(),
            'file_name' => $this->string()->notNull(),
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
        $this->dropTable('{{%uploaded_file}}');
    }
}
