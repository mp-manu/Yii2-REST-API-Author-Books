<?php

use yii\db\Migration;

/**
 * Class m211018_044026_seed_book_table
 */
class m211018_044026_seed_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $this->insert(
                'book',
                [
                    'name'         => $faker->catchPhrase,
                    'description'       => $faker->catchPhrase,
                    'publish_year' => (int)$faker->year,
                    'isbn' => $faker->isbn13(),
                    'created_at' => (new \yii\db\Expression('NOW()')),
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
        echo "m211018_044026_seed_book_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211018_044026_seed_book_table cannot be reverted.\n";

        return false;
    }
    */
}
