<?php 
require_once PATH.'vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(PATH.'application/views/main');
$twig = new Twig_Environment($loader);
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
