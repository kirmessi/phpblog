<?php 


//ini_set('display_errors', 1);
//error_reporting(E_ALL);

function debug($str) { //дебагер

	echo '<pre>';
	var_dump($str);
	echo '</pre>';
	exit;
}

