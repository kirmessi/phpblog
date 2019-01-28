<?php 

namespace application\models;
use application\core\Model;

class Main extends Model {
	

	public $error;

	public function contactValidate($post) {
		$nameLen = iconv_strlen($_POST['name']);
		$textLen = iconv_strlen($_POST['text']);
		if ($nameLen < 3 or $nameLen > 20) {
			$this->error = 'Имя должно содержать от 3 до 20 символов';
			return false;
		} elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = 'E-mail указан неверно';
			return false;
		} elseif ($textLen < 10 or $textLen > 500) {
			$this->error = 'Сообщение должно содержать от 10 до 500 символов';
			return false;
		}
		return true;
	}
	public function postsCount() {
		return $this->db->column('SELECT COUNT(id) FROM posts');
	}

	public function postsList($route) {
		
		return $this->db->row('SELECT posts.*, categories.`name` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) ORDER BY id DESC ');
	}

	public function categorypostsList($slug) {
		
		return $this->db->row('SELECT posts.*, categories.`name` as `cat_name`, categories.`description` as `cat_desc` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE categories.`slug` ="'.$slug.'"');
	}

	public function categorySelected($slug) {
		
		return $this->db->row('SELECT * FROM categories WHERE categories.`slug` ="'.$slug.'"');
	}

}