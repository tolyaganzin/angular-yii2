<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;

class FilmController extends ActiveController
{
    // указываем класс модели, который будет использоваться
    public $modelClass = 'app\models\Film';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ]);
    }
}
