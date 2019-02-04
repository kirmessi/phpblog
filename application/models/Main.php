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

	public function registerValidate($post) {
		 
    
		$nameLen = iconv_strlen($_POST['username']);
		$textLen = iconv_strlen($_POST['password']);
		if ($nameLen < 3 or $nameLen > 20) {
			$this->error = 'Username должно содержать от 3 до 20 символов';
			return false;
		} elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = 'E-mail указан неверно';
			return false;
		} elseif ($post['password'] !== $post['repassword']) {
			$this->error = 'Пароли не совпадают';
			return false;
		}
	
		elseif ($this->db->column('SELECT count(*) username FROM users WHERE username="'.$post['username'].'"') > 0) {
   			$this->error = 'Такой логин уже есть!';
    		return false;
		}   	

		return true;
	}

	public function loginValidate($post) {
		if(isset($_SESSION['admin']))    {
		$this->error = 'Вы уже зарегистрировались как админ!';
		return false;
		}

	if($this->db->column('SELECT count(*) username FROM users WHERE username="'.$post['username'].'"') <= 0){
    		$this->error = 'Такого логина не существует';
    		return false;
    	}
    	if($this->db->column('SELECT count(*) password FROM users WHERE password="'.md5($post['password']).'"') <= 0){
    		$this->error = 'Пароль не верный';
    		return false;
    	}
	return true;
    }

    public function settingsValidate($post) {
		
		$textLen = iconv_strlen($_POST['password']);
		if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = 'E-mail указан неверно';
			return false;
		} elseif ($post['password'] !== $post['repassword']) {
			$this->error = 'Пароли не совпадают';
			return false;
		}
		return true;
    }

	public function postsList($route) {
	
		return $this->db->row('SELECT posts.*,users.`username` as `username`, categories.`name` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) INNER JOIN users ON (posts.`user_id`= users.`id`) WHERE posts.`visibility`= 1 ORDER BY id DESC ');
	}
	public function postsListcurrnetUser($user_id) {
		return $this->db->row('SELECT * FROM posts WHERE user_id = "'.$user_id.'"');
	}

	public function postsListforAdmin($route) {
		
		return $this->db->row('SELECT posts.*, categories.`name` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) ORDER BY id DESC ');
	}
	public function postsListforUser($route, $user_id) {
		
		return $this->db->row('SELECT posts.*, categories.`name` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE posts.`user_id` = "'.$user_id.'" ORDER BY id DESC ');
	}

	public function categorypostsList($slug) {
		
		return $this->db->row('SELECT posts.*, categories.`name` as `cat_name`, categories.`description` as `cat_desc` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE categories.`slug` ="'.$slug.'"');
	}

	public function authorpostsList($route) {
		return $this->db->row('SELECT posts.*,users.`username` as `username`, categories.`name` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) INNER JOIN users ON (posts.`user_id`= users.`id`) WHERE posts.`user_id`= "'.$route.'"  ORDER BY id DESC ');
		
		return $this->db->row('SELECT posts.*, categories.`name` as `cat_name`, categories.`description` as `cat_desc` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE categories.`slug` ="'.$slug.'"');
	}

	public function categorySelected($slug) {
		
		return $this->db->row('SELECT * FROM categories WHERE categories.`slug` ="'.$slug.'"');
	}
	public function AuthorSelected($route) {
		
		return $this->db->row('SELECT username FROM users WHERE id ="'.$route.'"');
	}

	public function register($post){
		return $this->db->query('INSERT INTO users (username, email, password)
        VALUES ("'.$post['username'].'","'.$post['email'].'", "'.md5($post['password']).'")');
	}

	public function login($post){
		return $this->db->row('SELECT username FROM users WHERE username="'.$post['username'].'"');
		
	}
	public function loginId($post){
		return $this->db->row('SELECT id FROM users WHERE username="'.$post['username'].'"');
		
	}

	public function dashboard($id) {
		return $this->db->row('SELECT * FROM users WHERE id = "'.$id.'"');
	}
	public function isPostExistsMain($id){

		return $this->db->column('SELECT id FROM posts WHERE id ="'.$id.'"');

	}

	public function isPostExistsToAuthor($user_id){

		return $this->db->row('SELECT * FROM posts WHERE user_id ="'.$user_id.'"');

	}
	public function isAuthorExists($user_id){

		return $this->db->column('SELECT id FROM users WHERE id ="'.$user_id.'"');

	}
	public function isPostBelongToUser($user_id, $id){

		return $this->db->column('SELECT id FROM posts WHERE user_id ="'.$user_id.'" and id ="'.$id.'"');

	}
	public function postDeleteBelongToUser($id){ 

	$this->db->column('DELETE FROM posts WHERE id ="'.$id.'"');
		 unlink('materials/'.$id.'.jpg');
	}
	public function UserSettings($post, $id){
		$params = [
			'id' => $id,
			'email'=> $post['email'],
			'password' => md5($post['password']),
		];
		
		return $this->db->query('UPDATE users SET id = :id, email = :email, password = :password WHERE id = :id', $params);
	}

}