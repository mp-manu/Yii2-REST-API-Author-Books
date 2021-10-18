<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m211018_035954_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(11)->notNull(),
            'author_id' => $this->integer(11)->notNull(),
            'status' => $this->integer(2)
        ]);

        $this->addForeignKey(
            'fk-book_author-book_id',
            'book_author',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-book_author-author_id',
            'book_author',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author}}');
    }
}
