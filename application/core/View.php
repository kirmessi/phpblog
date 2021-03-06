<?php

namespace application\core;



class View {
	
	public $route; //массив контроллера и экшена
	public $path;
	public $layout ='default'; //задаем дефолтный шаблон отображения страницы
	
	public function __construct($route){
		
		$this->route = $route; //массив контроллера и экшена
		$this->path = $route['controller'].'/'.$route['action']; // "main/index"
				
	}

	public function render($title, $vars = []) { //HTML render code for admin-panel
		
		
		extract($vars); //Импортирует переменные из массива, ключ становится переменной
		$path = PATH.'application/views/'.$this->path.'.php'; ///записываем в переменную путь к вьюхе
		
		if (file_exists($path)) { //проверка на наличие файла по пути
			ob_start(); //Включение буферизации вывода
			require $path; //подключаем путь вьюхи
			$content = ob_get_clean(); // Получить содержимое текущего буфера и удалит его
			require PATH.'application/views/layouts/'.$this->layout.'.php'; //подключаем шаблон
		} else {

			echo 'Вид не найден:'. $this->path; 

		}
	}
	public function rendertwig($route,$vars) { //HTML render code
		require PATH.'application/lib/dev.php';

		$temple = $twig->loadTemplate($route['action'].'.php');
		echo $temple->render($vars);
	}
	public static function errorCode($code){

		http_response_code($code);
		$path = PATH.'application/views/errors/'.$code.'.php'; //путь к ошибкам
		
			if (file_exists($path)) { //проверка на наличие файла по пути
				require $path; //подключаем файл ошибок
			}
		exit;
	}

	public function redirect($url){ //редирект по $url

		header('location:'.'/'.$url);
		exit;

	}
	
	
	public function message($status, $message){ 
		exit(json_encode(['status' => $status, 'message' =>$message]));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}
}