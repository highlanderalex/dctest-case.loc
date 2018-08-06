<?php
define("DEBUG", 0);
define("ROOT", dirname(__DIR__));
define("CONFIG", ROOT . "/config");
define("LIBS", ROOT . "/core/libs");
define("CORE", ROOT . "/core");
define("CACHE", ROOT . "/tmp/cache");
define("WWW", ROOT . "/public");
define("LAYOUT", "default");
define("TMP",ROOT."/tmp");
define("APP",ROOT."/app");

$app_path = "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["PHP_SELF"]}";
$app_path = preg_replace("#[^/]+$#", "", $app_path);
$app_path = str_replace("/public/", "", $app_path);

define("PATH", $app_path);
//define("ADMIN",PATH."/admin");

set_time_limit(0);
ini_set('MAX_EXECUTION_TIME', 15);
require_once ROOT."/vendor/autoload.php";
