<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\OffersService;
use Yii;
use app\models\OffersFilterForm;


class SiteController extends Controller
{
    
    private $service;
    
    public function __construct(
        $id, 
        $module, 
        OffersService $service, 
        $config = []
    ) {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }
    
    /**
     * Displays homepage.
     * 
     * @return string
     */
    public function actionIndex()
    {
        $form = new OffersFilterForm();
        $selectedFilters = [];
        $where = [];

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->loadRequest($form, $where, $selectedFilters);
        }
        
        list($offersAll, $offersFiltered) = $this->service->getOffers($where);
        
        list($colors, $sizes) = $this->service->getFilters($offersAll, $offersFiltered, $selectedFilters);
        
        return $this->render('index', [
            'offers' => $offersFiltered,
            'colors' => $colors,
            'sizes' =>  $sizes,
            'model' => $form,
        ]);
    }

}
