<?php

use yii\db\Migration;

/**
 * Class m211018_044634_seed_book_author_table
 */
class m211018_044634_seed_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $this->insert(
                'book_author',
                [
                    'book_id'         => (int)rand(1, 50),
                    'author_id'       => (int)rand(1, 20),
                    'status' => 1
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211018_044634_seed_book_author_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211018_044634_seed_book_author_table cannot be reverted.\n";

        return false;
    }
    */
}
