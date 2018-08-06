<?php

namespace app\controllers;

use framework\libs\Pagination;
use framework\App;

class MainController extends AppController
{
    public function indexAction()
	{
		$this->set([]);
	}
	
	public function filltableAction()
	{
		if(!$this->isAjax())
			throw new \Exception('Страница не найдена', 404);
		sleep(1);
		
		//логика заполнения таблиц
		if(!$this->client->check())
		{
			$this->client->addClients();
		}
			
		if(!$this->order->check())
		{
			$clients = $this->client->getClients();
			for($i=1; $i<4; $i++)
			{
				$this->order->addOrders($clients);
			}
		}
			
		$response['clients'] = 'Таблица clients заполнена: OK';
		$response['orders'] = 'Таблица orders заполнена: OK';
			
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
		die;
	}
	
	public function maxAction()
    {
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$total = App::$app->getProperty('total');
		$perpage = App::$app->getProperty('pagination');
		$pagination = new Pagination($page, $perpage, $total);
		
		$data = $this->client->getMax($pagination, $perpage);
		$this->set(compact('data', 'pagination', 'total'));
    }
	
	public function lastyearAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$total = App::$app->getProperty('total');
		$perpage = App::$app->getProperty('pagination');
		$pagination = new Pagination($page, $perpage, $total);
		
		$data = $this->client->getLastYear($pagination, $perpage);
		$this->set(compact('data', 'pagination', 'total'));
    }
	
	public function threemonthAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$total = App::$app->getProperty('total');
		$perpage = App::$app->getProperty('pagination');
		$pagination = new Pagination($page, $perpage, $total);
		
		$data = $this->order->getThreeMonth($pagination, $perpage);
		$this->set(compact('data', 'pagination', 'total'));
    }  
}