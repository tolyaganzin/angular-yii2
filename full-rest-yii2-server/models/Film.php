<?php

namespace app\models;
use Yii;

class Film extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'film';
    }

    public function rules()
    {
        return [
            [['title', 'director', 'year'], 'required'],
            [['storyline'], 'string'],
            [['year'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['director'], 'string', 'max' => 100]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'storyline' => 'Storyline',
            'director' => 'Director',
            'year' => 'Year',
        ];
    }
}
