<?php
namespace app\models;

use yii\base\Model;

class OffersFilterForm extends Model
{
    public $color_id;
    public $size_id;
 
    
    public function attributeLabels()
    {
        return [
            'color_id' => 'Цвет',
            'size_id' => 'Размер',
        ];
    }
}

