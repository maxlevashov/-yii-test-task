<?php

namespace app\services;

use Yii;
use app\models\Offers;
use app\models\OffersFilterForm;

class OffersService
{
    
    public function getList()
    {
        $form = new OffersFilterForm();
        $where = [];
        $request = Yii::$app->request;
        $isColorFilterSelected = false;
        $isSizeFilterSelected = false;
        if ($request->isPost) {
            $offersFilterForm = Yii::$app->request->post('OffersFilterForm');
            if (!empty($offersFilterForm['color_id'])) {
                $isColorFilterSelected = true;
                $where['color_id'] = $offersFilterForm['color_id'];
                $form->color_id = $offersFilterForm['color_id'];
            }
            if (!empty($offersFilterForm['size_id'])) {
                $isSizeFilterSelected = true;
                $where['size_id'] = $offersFilterForm['size_id'];
                $form->size_id = $offersFilterForm['size_id'];
            }
        } 
        
        $offersAll = Offers::find();
        $offers = $offersAll->where($where)->all();
        $offersAll = $offersAll->all();
        $colors = [];
        $sizes = [];
        
        foreach ($offers as $offer) {
            $colors[$offer->color->id] = $offer->color->name;
            $sizes[$offer->size->id] = $offer->size->name;
        }
        
        foreach ($offersAll as $offer) {
            $colorsAll[$offer->color->id] = $offer->color->name;
            $sizesAll[$offer->size->id] = $offer->size->name;
        }
        $colors = $isSizeFilterSelected ? $colors : $colorsAll;
        $sizes = $isColorFilterSelected  ? $sizes : $sizesAll;
        
        return [
            $offers, $colors, $sizes, $form,
        ];
    }
}

