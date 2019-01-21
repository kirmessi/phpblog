<?php 

namespace application\models;
use application\core\Model;

class Admin extends Model {
	

	public $error;


	public function loginValidate($post) {
		$config = require '../application/config/admin.php';
		if ($config['login'] != $_POST['login'] or $config['password'] != $_POST['password']) {
			$this->error = 'Ошибка входа';
			return false;
		}


		
		return true;
	}

	public function postValidate($post, $type) {
		
		$nameLen = iconv_strlen($_POST['name']);
		$descLen = iconv_strlen($_POST['description']);
		$textLen = iconv_strlen($_POST['text']);

		if ($nameLen < 3 or $nameLen > 20) {
			$this->error = 'Имя должно содержать от 3 до 20 символов';
			return false;
		} elseif ($descLen < 10 or $descLen > 100) {
			$this->error = 'Описание должно содержать от 10 до 100 символов';
			return false;
		} elseif ($textLen < 10 or $textLen  > 5000) {
			$this->error = 'Описание должно содержать от 10 до 5000 символов';
			return false;
		}

		if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
			$this->error = 'Изображение не загружено';
			return false;
		}
		
		return true;
		
	}
	public function postAdd($post) {
	
	$this->db->query('INSERT INTO posts (name, description, text)
        VALUES ("'.$post['name'].'", "'.$post['description'].'", "'.$post['text'].'")');

			return $this->db->lastInsertId();
	}
	public function postUploadImage($path, $id) {
		move_uploaded_file($path, 'materials/'.$id.'.jpg');
	}

	public function isPostExists($id){

		return $this->db->column('SELECT id FROM posts WHERE id ="'.$id.'"');

	}
	public function postDelete($id){

		 $this->db->column('DELETE FROM posts WHERE id ="'.$id.'"');
		 unlink('materials/'.$id.'.jpg');
	}

	public function postData($id) {
			return $this->db->row('SELECT * FROM posts WHERE id ="'.$id.'"');
	}

}