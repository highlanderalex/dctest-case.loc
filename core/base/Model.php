<?php

namespace framework\base;

use PDO;

class Model
{
    private $conection;
    private static $queries = [];

    public function __construct()
    {
        $db = require CONFIG."/db.php";
        try 
		{
            $this->conection = new PDO($db["dsn"], $db["user"],$db["password"]);
            $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } 
		catch (\PDOException $exception) 
		{
            throw new \Exception($exception->getMessage());
        }
    }

    public function __destruct()
    {
        return $this->conection = null;
    }

    public function onllyRow($query, $params = [])
    {
        try 
		{
            $start = microtime(true);
            $statment = $this->conection->prepare($query);
            $statment->execute($params);
            $end = microtime(true);
            self::$queries[]=$query . ' | time: ' . number_format(($end-$start),4);
            return $statment->fetch();
        } 
		catch (\PDOException $exception) 
		{
            throw new \Exception($exception->getMessage());
        }
    }

    public function AllRows($query, $params = [])
    {
        try 
		{
            $start = microtime(true);
            $statment = $this->conection->prepare($query);
            $statment->execute($params);
            $end = microtime(true);
            self::$queries[]=$query . ' | time: ' . number_format(($end-$start),4);
            return $statment->fetchAll();//множество запросов
        } 
		catch (\PDOException $exception) 
		{
            throw new \Exception($exception->getMessage());
        }
    }

    public function insertRow($query, $params = [])
    {
        try 
		{
            $statment = $this->conection->prepare($query);
            $statment->execute($params);
            return true;
        } 
		catch (\PDOException $exception) 
		{
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateRow($query, $params = [])
    {
        $this->insertRow($query, $params);
    }

    public function deleteRow($query, $params = [])
    {
        $this->insertRow($query, $params);
    }
	
    public static function debugger(){
        return self::$queries;
    }
}
