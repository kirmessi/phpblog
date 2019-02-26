<?php

namespace application\lib;
use application\core\Config;	
use PDO;

class Db {

	protected $db;
	
	public function __construct() {
		$config = Config::getConfig('db');
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
	}

	public function query($sql, $params = []) {
		$this->db->query("SET NAMES 'utf8'");
		$stmt = $this->db->prepare($sql);

		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_int($val)) {
					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type); // Связывает параметр с заданным значением
			}
		}
		$stmt->execute(); //Запускает подготовленный запрос на выполнение
		return $stmt;
	}

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC); //Извлекает результирующий ряд в виде ассоциативного массива
	}

	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn(); // Возвращает данные одного столбца следующей строки результирующего набора
	}

	public function lastInsertId() {
		return $this->db->lastInsertId(); //Возвращает ID последней вставленной строки или значение последовательности
	}

}

