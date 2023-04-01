<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
//use app\models\Offers;
//use app\models\OffersFilterForm;
use app\services\OffersService;


class SiteController extends Controller
{
    
    private $service;
    
    public function __construct($id, $module, OffersService $service, $config = [])
    {
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
