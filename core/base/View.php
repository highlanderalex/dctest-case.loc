<?php
namespace framework\base;

class View 
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $layout;
    public $data = [];
    public $meta = ['title' => '','description' => '','keywords' => ''];

    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = str_replace("\\", "/", $route['prefix']);
        $this->meta = $meta;
        if($layout === false)
		{
            $this->layout = false;
        }
		else
		{
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data)
    {   
       if(is_array($data) && !empty($data))
	   {
           extract($data);
       } 
       $viewFile = APP . "/views/{$this->prefix}{$this->controller}/" . $this->view . '.php';
        if(file_exists($viewFile))
		{
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }
		else
		{
            throw new \Exception("View {$viewFile} not found", 500);
        }
        if($this->layout !== false)
		{
            $layoutFile = APP . '/views/layouts/' . $this->layout . '.php';
            if(file_exists($layoutFile))
			{
                require_once $layoutFile;
            }
			else
			{
                throw new \Exception("Template {$layoutFile} not found", 500);
            }
        }
    }
    public function getMeta()
    {
        $output = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $output .= '<meta name="description" content="' . $this->meta['description'] . '">' . PHP_EOL;
        $output .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $output;
    }

}