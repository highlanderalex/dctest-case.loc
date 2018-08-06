<?php

namespace app\controllers;

use framework\App;
use framework\base\Controller;
use app\models\Client;
use app\models\Order;



class AppController extends Controller
{
    protected $client;
	protected $order;
	
	public function __construct($route)
    {
        parent::__construct($route);
        $this->setMeta(App::$app->getProperty('title'), App::$app->getProperty('description'), App::$app->getProperty('keywords'));
		$this->client = new Client();
		$this->order = new Order();
    }

}