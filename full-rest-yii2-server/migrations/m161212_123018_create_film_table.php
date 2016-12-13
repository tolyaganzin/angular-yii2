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
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('film');
    }
}
