<?php

use yii\db\Migration;

/**
 * Handles the creation of table `film`.
 */
class m161212_123018_create_film_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function Up()
    {
        $this->createTable('film', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'storyline' => $this->text(),
            'director' => $this->string(100)->notNull(),
            'year' => $this->integer(4)->notNull()
        ]);
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
          # code...
          $this->insert('film', [
            'title' => $faker->sentence(2, true),
            'storyline' => $faker->sentences(10, true),
            'director' => $faker->name,
            'year' => $faker->year
          ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('film');
    }
}
