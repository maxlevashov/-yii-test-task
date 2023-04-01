<?php

namespace app\models;

use yii\db\ActiveRecord;

class Offers extends ActiveRecord
{
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
    
    public function getColor()
    {
        return $this->hasOne(ProductColor::class, ['id' => 'color_id']);
    }
    
    public function getSize()
    {
        return $this->hasOne(ProductSize::class, ['id' => 'size_id']);
    }
}

