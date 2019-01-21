<?php 

namespace application\core;
use application\lib\Db; //используем класс Db

abstract class Model {

	public $db;

	public function __construct(){
		$this->db = new Db; //создаем экземпляр класса Db
	}

}