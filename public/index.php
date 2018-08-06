<?php
require_once dirname(__DIR__)."/config/init.php";
require_once LIBS."/helpers/function.php";
require_once CONFIG."/routes.php";
new \framework\App();
/*
\framework\App::$app->setProperty("slava","tes_slava");
debug(\framework\App::$app->getProperty("email_admin"));
debug(\framework\App::$app->getProperties());*/
//throw new Exception("text execption",404);
/*$min = new \framework\libs\MinMax();
echo $min->min(10,20);*/
//$min->min(5,10);
/*$str = new \framework\libs\Tag("a");
$str->setText("text p")->setAtr(["href"=>"#"])->show();*/
//debug(\framework\Router::getRoutes());

