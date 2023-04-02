<?php

namespace app\services;

use app\models\Offers;

/** 
 *  class OffersService
 */
class OffersService
{
    
    /** 
     * Метод метод загружает данные http запроса
     * 
     * @param $form
     * @param &$where
     * @param &$selectedFilters
     * @return void
     */
    public function loadRequest($form, &$where, &$selectedFilters): void
    {
        foreach ($form as $filterName => $filterValue) {
            if (!empty($filterValue)) {
                $selectedFilters[$filterName] = true;
                $where[$filterName] = $filterValue;
            }
        }
    }
    
    /** 
     * Метод получает данные коммерческих предложений
     * 
     * @param array $where
     * @return array
     */
    public function getOffers(array $where): array
    {
        $offers = Offers::find();
        $offersAll = $offers->all();
        $offersFiltered = $offers->where($where)->all();
        
        return [$offersAll, $offersFiltered];
    }
    
    /** 
     * Метод получает данные для фильтров
     * 
     * @param $offersAll
     * @param $offersFiltered
     * @param $selectedFilters
     * @return array
     */
    public function getFilters($offersAll, $offersFiltered, $selectedFilters): array
    {
        $colors = [];
        $sizes = [];
       
        foreach ($offersAll as $offer) {
            if (!isset($selectedFilters['size_id'])) {
                $colors[$offer->color->id] = $offer->color->name;
            }
            if (!isset($selectedFilters['color_id'])) {
                $sizes[$offer->size->id] = $offer->size->name;
            }
        }
        
        foreach ($offersFiltered as $offer) {
            if (isset($selectedFilters['size_id'])) {
                $colors[$offer->color->id] = $offer->color->name;
            }
            if (isset($selectedFilters['color_id'])) {
                $sizes[$offer->size->id] = $offer->size->name;
            }
        }
        
        return [$colors, $sizes];
    }
    
}