<?php 

namespace application\core; 

use application\core\View;	

class Router {

	protected $routes = []; //роуты в массиве
	protected $params = []; //контроллеры и экшены в массиве
	
	function __construct(){
			
		$arr = require '../application/config/routes.php'; // подключаем массив роутов
		foreach ($arr as $key => $value) {
			$this->add($key,$value); //записываем в function Add() - $route and $params
		}
		

	}

	public function add($route, $params){

		$route = preg_replace('/{(slug):([^\}]+)}/', '(?P<slug>[-\w]+)', $route);
		$route = preg_replace('/{(id):([^\}]+)}/', '(?P<\1>\2)', $route);
		$route = '#^'.$route.'$#'; //регулярное выражение 
		$this->routes[$route] = $params; //записали в массив контроллера и экшен
		
	}

	public function match(){   //проверка совпадения роута  из массива и текущего адреса
		//debug($this->routes);
		
		$url = trim($_SERVER['REQUEST_URI'],'/'); //убераем '/' у текущего url
	
		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $matches)) { //Выполняет проверку на соответствие регулярному выражению
				
				foreach ($matches as $key => $match) {
					
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
				$this->params = $params; //запсиали в перменную масси контроллера и экшена
				
			
				return true; //если маршрут найдено возвращает true
			}
		}
		return false; //если маршрут yне найдено возвращает false
	}

	
	public function run(){

		if ($this->match()) {

			$path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller'; //автозагрузка класса по контроллеру к примеру application\controllers\MainController
			
			if(class_exists($path)){ //проверка на существования класса по пути $path
				
				$action = $this->params['action'].'Action'; //записываем в $action  метод класса к примеру indexAction
				
				if (method_exists($path, $action)) { //проверка на существования метода в пути $path
					$controller = new $path($this->params);//создаем экземпляр класса по пути
					
					$controller->$action();
					
				}
				else {

					View::errorCode(404); // если метод не найден 404
				}
			}
			else{
			
			View::errorCode(404);//если класс не найден 404
			}
		}
		else {
			
			View::errorCode(404); //если не найдено совпадений по $path
		}
		
	}
}
