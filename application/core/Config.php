<?php 
namespace application\core;

 class Config
 {
 	public static function getConfig($name){
 		if (file_exists(PATH.'application/config/'.$name.'.php')) {
 		return require (PATH.'application/config/'.$name.'.php');
 		} else {
 		return false;
 		}
 	}
 
 } 