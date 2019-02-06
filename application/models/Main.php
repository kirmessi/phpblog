<?php 

namespace application\models;
use application\core\Model;

class Main extends Model {
	

	public $error;

	public function contactValidate($post) {
		$nameLen = iconv_strlen($_POST['title']);
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

	public function postsList() {
	
		return $this->db->row('SELECT posts.*,users.`username` as `username`, categories.`title` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) INNER JOIN users ON (posts.`author_id`= users.`id`) WHERE posts.`visibility`= 1 ORDER BY id DESC ');
	}
	public function postsListcurrnetUser($author_id) {
		$params = [
			'author_id' => $author_id,
		];
		return $this->db->row('SELECT * FROM posts WHERE author_id = :author_id', $params);
	}

	public function postsListforAdmin($route) {
		
		return $this->db->row('SELECT posts.*, categories.`title` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) ORDER BY id DESC ');
	}
	public function postsListforUser($route, $author_id) {
		$params = [
			'author_id' => $author_id,
		];
		return $this->db->row('SELECT posts.*, categories.`title` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE posts.`author_id` = :author_id ORDER BY id DESC', $params);
	}

	public function categorypostsList($slug) {
		$params = [
			'slug' => $slug,
		];
		return $this->db->row('SELECT posts.*, categories.`title` as `cat_name`, categories.`description` as `cat_desc` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE categories.`slug` = :slug', $params);
	}

	public function authorpostsList($author_id) {
		$params = [
			'author_id' => $author_id,
		];
		return $this->db->row('SELECT posts.*,users.`username` as `username`, categories.`title` as `cat_name`, categories.`slug` as `cat_slug`FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) INNER JOIN users ON (posts.`author_id`= users.`id`) WHERE posts.`author_id`= :author_id ORDER BY id DESC ' , $params);
	}

	public function categorySelected($slug) {
		$params = [
			'slug' => $slug,
		];
		return $this->db->row('SELECT * FROM categories WHERE categories.`slug` = :slug', $params);
	}
	public function AuthorSelected($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT username FROM users WHERE id = :id', $params);
	}

	public function register($post){
		$params = [
			'username' => $post['username'],
			'email'=> $post['email'],
			'password' => md5($post['password']),
		];
		return $this->db->query('INSERT INTO users (username, email, password)
        VALUES (:username , :email, :password)', $params);
	}

	public function login($username){
		$params = [
			'username' => $username['username'],
		];
		return $this->db->row('SELECT username FROM users WHERE username = :username', $params);
		
	}
	public function loginId($username){
		$params = [
			'username' => $username['username'],
		];
		return $this->db->row('SELECT id FROM users WHERE username = :username', $params);
		
	}

	public function dashboard($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
	}
	public function isPostExistsMain($id){
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);

	}

	public function isPostExistsToAuthor($author_id){
		$params = [
			'author_id' => $author_id,
		];
		return $this->db->row('SELECT * FROM posts WHERE author_id = :author_id', $params);

	}
	public function isAuthorExists($id){
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM users WHERE id = :id', $params);

	}
	public function isPostBelongToUser($author_id, $id){
		$params = [
			'author_id' => $author_id,
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM posts WHERE author_id = :author_id and id = :id', $params);

	}
	public function postDeleteBelongToUser($id){ 
		$params = [
			'id' => $id,
		];
		$this->db->column('DELETE FROM posts WHERE id = :id', $params);
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