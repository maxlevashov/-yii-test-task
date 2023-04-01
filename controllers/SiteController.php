<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\OffersService;


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
        list($offers, $colors, $sizes, $form) = $this->service->filter();
        
        return $this->render('index', [
            'offers' => $offers,
            'colors' => $colors,
            'sizes' =>  $sizes,
            'model' => $form,
        ]);
    }

}
