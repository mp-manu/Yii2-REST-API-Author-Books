<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m211018_035419_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'publish_year' => $this->integer(11)->notNull(),
            'isbn' => $this->integer(11),
            'status' => $this->integer(2),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(11),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(11)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
