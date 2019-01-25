<?php 
require '../application/lib/Dev.php';
require_once '../twig/vendor/autoload.php';
require_once '../twig/vendor/twig/twig/lib/Twig/Autoloader.php';

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
Twig_Autoloader::register();
$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);

echo $twig->render('Hello {{ name }}!', array('name' => 'Fabien'));




