<?php

namespace application\core; 

class View {
	
	public $route; //массив кконтроллера и экшена
	public $path;
	public $layout ='default'; //задаем дефолтный шаблон отображения страницы
	
	public function __construct($route){
		
		$this->route = $route; //массив кконтроллера и экшена
		$this->path = $route['controller'].'/'.$route['action']; // "main/index"

		
	}
public function render($title, $vars = []) { //HTML render code

		extract($vars); //Импортирует переменные из массива, ключ становится переменной
		$path = '../application/views/'.$this->path.'.php'; ///записываем в переменную путь к вьюхе
		if (file_exists($path)) { //проверка на наличие файла по пути
			ob_start(); //Включение буферизации вывода
			require $path; //подключаем путь вьюхи
			$content = ob_get_clean(); // Получить содержимое текущего буфера и удалит его
			require '../application/views/layouts/'.$this->layout.'.php'; //подключаем шаблон
		} else {

			echo 'Вид не найден:'. $this->path; 

		}
	}

	public static function errorCode($code){

		http_response_code($code);
		$path = '../application/views/errors/'.$code.'.php'; //путь к ошибкам
		
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