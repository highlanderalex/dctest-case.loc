<?php

namespace app\models;

use framework\libs\Pagination;

class Client extends AppModel
{
    public function getMax(Pagination $pagination, $perpage)
    {
        $start = $pagination->getStart();
		
		$query = "SELECT c.id,c.firstname,c.lastname,SUM(o.total) as summa FROM clients c ";
		$query .= "JOIN orders o ON c.id=o.customer_id WHERE o.status='success' ";
		$query .= "GROUP BY c.id ORDER BY summa DESC LIMIT $start, $perpage";
        $data = $this->allRows($query);
		
        return $data;
    }
	
	public function getLastYear(Pagination $pagination, $perpage)
    {
        $start = $pagination->getStart();
		
		$query = "SELECT c.id,c.firstname,c.lastname,c.registration_date FROM clients c ";
		$query .= "JOIN orders o ON c.id=o.customer_id WHERE o.status!='success' ";
		$query .= "AND o.order_date > LAST_DAY(CURDATE()) - INTERVAL 1 YEAR ";
		$query .= "GROUP BY c.id ORDER BY c.registration_date DESC LIMIT $start, $perpage";
        $data = $this->allRows($query);
		
        return $data;
    }
	
	public function addClients()
	{
		$dataToInsert = [];
		$query = "INSERT INTO clients (firstname, lastname, registration_date) VALUES ";

		for($i = 1; $i <= 1000000; $i++)
		{
			$firstname = 'FirstName' . $i;
			$lastname = 'LastName' . $i;
			$rand_time = rand(time() - 3600*24*365*2, time());
			$date = date('Y-m-d H:i:s', $rand_time);
			array_push($dataToInsert, $firstname, $lastname, $date);
			
			$query .= "(?, ?, ?),";	
		}
		
		$query = rtrim($query, ',');
		$data = $this->insertRow($query, $dataToInsert);
		unset($dataToInsert);
		return true;	
	}
	
	public function getClients()
	{
		$query = "SELECT id, registration_date FROM clients";
        $data = $this->allRows($query);
        return $data;
	}
	
	public function check()
	{
		$query = "SELECT id FROM clients LIMIT 2";
        $data = $this->allRows($query);
        if(count($data))
			return true;
		
		return false;
	}
}
