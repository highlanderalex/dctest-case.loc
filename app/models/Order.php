<?php

namespace app\models;

use framework\libs\Pagination;

class Order extends AppModel
{
    public function getThreeMonth(Pagination $pagination, $perpage)
    {
        $start = $pagination->getStart();
		
		$query = "SELECT c.firstname,c.lastname,o.order_date FROM orders o ";
		$query .= "JOIN clients c ON c.id=o.customer_id WHERE WEEKDAY(o.order_date) < 5 ";
		$query .= "AND o.order_date > LAST_DAY(CURDATE()) - INTERVAL 3 MONTH ";
		$query .= "ORDER BY o.order_date DESC LIMIT $start, $perpage";
        $data = $this->allRows($query);
		
        return $data;
    }
	
	public function addOrders($clients = [])
	{
		if(empty($clients))
			return false;
		
		$dataToInsert = [];
		$field_status = ['success', 'processing'];
		$query = "INSERT INTO orders (customer_id, total, status, order_date) VALUES ";
		
		for($i = 1; $i <= 500000; $i++)
		{
			$key = array_rand($clients);
			$customer_id = $clients[$key]['id'];
			$total = rand(500, 20000);
			$status_key = array_rand($field_status);
			$status = $field_status[$status_key];
			
			$days = rand(1, 100);
			$order_date = strtotime($clients[$key]['registration_date']) + $days*3600*24;
			if($order_date > time())
			{
				$order_date = date('Y-m-d H:i:s', time());
			}
			else
			{
				$order_date = date('Y-m-d H:i:s', $order_date);
			}
			
			array_push($dataToInsert, $customer_id, $total, $status, $order_date);
			$query .= "(?, ?, ?, ?),";	
			
		}
		$query = rtrim($query, ',');
		$data = $this->insertRow($query, $dataToInsert);
		unset($dataToInsert);
		return true;	
	}
	
	public function check()
	{
		$query = "SELECT id FROM orders LIMIT 2";
        $data = $this->allRows($query);
        if(count($data))
			return true;
		
		return false;
	}
}
