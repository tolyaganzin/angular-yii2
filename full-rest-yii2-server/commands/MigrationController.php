<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

use app\models\Film;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MigrationController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionFilms($value = 10)
    {
      $faker = \Faker\Factory::create();
      for ($i=0; $i < $value; $i++) {
        $film = new Film();
        $film->title = $faker->sentence(2, true);
        $film->storyline = $faker->sentences(10, true);
        $film->director = $faker->name;
        $film->year = $faker->year;
        $film->save();
      }
    }

}
