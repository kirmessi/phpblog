<?php

namespace application\core; 

use application\core\View; //подключаем класс View

abstract class Controller {
	
	public $route; 

	public $view;

	public $acl; 
	
	public function __construct($route){
		
		$this->route = $route;
		//debug($route);
		//$_SESSION['admin'] =1;
		//debug($this->checkAcl());
		if (!$this->checkAcl()) { 
			View::errorCode('403'); //если не подходит под условия checkAcl() ошибка доступа
		}

				
		$this->view = new View($route); // создание экземпляра класса 
		$this->model = $this->loadModel($route['controller']); // подгружаем модель по $path контроллера
		

	}

	public function loadModel($name){ //загрузка модели

		$path = 'application\models\\'.ucfirst($name); //пусть к модели
		if (class_exists($path)) { //проверка на существования класса по пути $path

			return new $path; //возвращает экзмепляр класса
	
		}


	
	}

	public function checkAcl(){ //котроль доступа

		$this->acl = require PATH.'application/acl/'.$this->route['controller'].'.php'; //подключает массив по контроллеру

		if ($this->isAcl('all')) { //уровень доступа дял всех  
			return true;
		}
		elseif  (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) { ///только для авторизированных
			return true; 
		}
		elseif  (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) { //для гостей
			return true;
		}
		elseif  (isset($_SESSION['admin']) and $this->isAcl('admin')) { //для админа

			return true;
		}
		return false;
	}

	public function isAcl($key){

		return in_array($this->route['action'], $this->acl[$key]); //Проверяет, присутствует ли в массиве $this->acl[$key]  значение  $this->route['action']

	}

}