<?php 
require '../application/lib/Dev.php';
define('PATH',realpath(dirname(__FILE__).'/../').'/');

spl_autoload_register('autoload');

function autoload($class){
	$file = str_replace('\\', '/', $class.'.php');
	$path = PATH.$file;
   if (file_exists($path)) {
   	require $path;
   }
}

use application\core\Router;

session_start();
$router = new Router;
$router->run();



