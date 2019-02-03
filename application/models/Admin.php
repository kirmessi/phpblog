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
		$slugLen = iconv_strlen($_POST['slug']);

		if ($nameLen < 3 or $nameLen > 150) {
			$this->error = 'Имя должно содержать от 3 до 20 символов';
			return false;
		} elseif ($descLen < 10 or $descLen > 300) {
			$this->error = 'Описание должно содержать от 10 до 300 символов';
			return false;
		} elseif ($textLen < 10 or $textLen  > 5000) {
			$this->error = 'Описание должно содержать от 10 до 5000 символов';
			return false;
		} elseif ($slugLen < 4 or $slugLen  > 50 and $type == 'add') {
			$this->error = 'Адрес должен содержать от 4 до 50 символов';
			return false;
		} elseif($this->db->column('SELECT count(*) slug FROM posts WHERE slug="'.$post['slug'].'"') > 0 and $type == 'add') {
   			$this->error = 'Такой адрес уже есть!';
    		return false;
		}   	

		if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
			$this->error = 'Изображение не загружено';
			return false;
		}
		
		return true;
		
	}

	public function categoryValidate($category) {
		
		$nameLen = iconv_strlen($_POST['name']);
		

		if ($nameLen < 3 or $nameLen > 20) {
			$this->error = 'Имя должно содержать от 3 до 20 символов';
			return false;
		} 
		
		return true;
		
	}

	//Посты

	public function postAdd($post) {
	if (!empty($_SESSION['authorize'])) {
		$post['user_id'] = $_SESSION['authorize']['id'];
	} elseif(isset($_SESSION['admin'])) {
		$post['user_id'] = 1;
	}
	if (isset($_POST['visibility'])) {
		$post['visibility'] = 1;
	}
	else {
		$post['visibility'] = 0;
	}
	$this->db->query('INSERT INTO posts (user_id, slug, category_id, name, description, text, visibility)
        VALUES ("'.$post['user_id'].'", "'.$post['slug'].'","'.$post['category_id'].'", "'.$post['name'].'", "'.$post['description'].'", "'.$post['text'].'", "'.$post['visibility'].'")');

			return $this->db->lastInsertId();
	}



	public function postEdit($post,$id) {
		if (isset($_POST['visibility'])) {
		$post['visibility'] = 1;
	}
	else {
		$post['visibility'] = 0;
	}
	$params = [
			'id' => $id,
			'slug'=> $post['slug'],
			'category_id' => $post['category_id'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
			'visibility' => $post['visibility'],
		];
		
		return $this->db->query('UPDATE posts SET id = :id, slug = :slug, category_id = :category_id, name = :name,  description = :description, text = :text, visibility = :visibility WHERE id = :id', $params);
			
	}

	public function postUploadImage($path, $id) {
		move_uploaded_file($path, 'materials/'.$id.'.jpg');
	}

	public function isPostExists($slug){

		return $this->db->column('SELECT slug FROM posts WHERE slug ="'.$slug.'"');

	}
	public function isPostExistsAdmin($id){

		return $this->db->column('SELECT id FROM posts WHERE id ="'.$id.'"');

	}
	
	public function postDelete($id){

		 $this->db->column('DELETE FROM posts WHERE id ="'.$id.'"');
		 unlink('materials/'.$id.'.jpg');
	}
	
//////////////////////////////////////////////////////
	public function postData($slug) {
			return $this->db->row('SELECT posts.*, categories.`name` as `cat_name` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE posts.`slug` = "'.$slug.'"');
	}
	public function postDataAdmin($id) {
			return $this->db->row('SELECT posts.*, categories.`name` as `cat_name` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE posts.`id` = "'.$id.'"');
	}
	
////////////////////////////////////////////////////////////////
	//Категориии

	public function categoryAdd($сategory) {
	
	$this->db->query('INSERT INTO categories (name, slug, description) VALUES ("'.$_POST['name'].'", "'.$_POST['slug'].'", "'.$_POST['description'].'")');

			return $this->db->lastInsertId();
	}

	public function categoryEdit($сategory,$id) {
	$params = [
			'category_id' => $id,
			'name' => $сategory['name'],
			'slug' => $сategory['slug'],
			'description' => $сategory['description'],			
		];
		$this->db->query('UPDATE categories SET name = :name, slug = :slug, description = :description WHERE category_id = :category_id', $params);
			
	}

	public function categoryDelete($id){

		 $this->db->column('DELETE FROM categories WHERE category_id ="'.$id.'"');
		 
	}
	public function isCategoryExistsAdmin($id){

		return $this->db->column('SELECT category_id FROM categories WHERE category_id ="'.$id.'"');

	}

	public function isCategoryExists($slug){

		return $this->db->column('SELECT slug FROM categories WHERE slug ="'.$slug.'"');

	}
	public function categoryDataAdmin($id) {
			return $this->db->row('SELECT * FROM categories WHERE category_id ="'.$id.'"');
	}
	///////////////////////////////
	public function categoryData($slug) {
			return $this->db->row('SELECT * FROM categories WHERE slug ="'.$slug.'"');
	}
///////////////////////////////////////////////
	public function categoriesList($route) {
		
		return $this->db->row('SELECT * FROM categories ORDER BY category_id');
	}


}