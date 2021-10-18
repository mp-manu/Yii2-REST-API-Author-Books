<?php

use yii\db\Migration;

/**
 * Class m211018_044017_seed_author_table
 */
class m211018_044017_seed_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $this->insert(
                'author',
                [
                    'fullname' => $faker->name,
                    'status' => 1,
                    'created_at' => (new \yii\db\Expression('NOW()'))
                ]
            );
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211018_044017_seed_author_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211018_044017_seed_author_table cannot be reverted.\n";

        return false;
    }
    */
}
