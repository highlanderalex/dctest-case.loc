<?php

namespace framework;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) 
		{
            error_reporting(-1);
        } 
		else 
		{
            error_reporting(0);
        }
        set_exception_handler([$this, "exceptionHandler"]);
    }

    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayErrors('Исключение',$e->getMessage(),$e->getFile(),$e->getLine(),$e->getCode());
    }

    protected function logErrors($message, $file, $line)
    {
        error_log("[" . date('Y-m_d H:i:s') . "] Текст ошибки: " . $message . " | Фаил: " . $file . " | Строка: " . $line .
            "\r\n********\r\n", 3, TMP . "/errors.log");
    }

    protected function displayErrors($errno, $errormessage,$errorfile, $errorline, $response = 404)
    {
        http_response_code($response);
        if(!DEBUG && $response == 404)
		{
            require_once WWW."/errors/404.php";
            die();
        }
        if (DEBUG)
		{
            require_once WWW."/errors/dev.php";
        }
		else
		{
            require_once WWW."/errors/prod.php";
        }
        die();
    }
}