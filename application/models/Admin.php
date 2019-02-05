<?php 

namespace application\models;
use application\core\Model;
use application\core\Config;	
class Admin extends Model {
	

	public $error;


	public function loginValidate($post) {

		$config = Config::getConfig('admin');
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
	$params = [
			'user_id' => $user_id,
			'slug'=> $post['slug'],
			'category_id' => $post['category_id'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
			'visibility' => $post['visibility'],
		];
	$this->db->query('INSERT INTO posts (user_id, slug, category_id, name, description, text, visibility)
        VALUES (: user_id, :slug, :category_id, :name, :description, :text, :visibility)', $params);

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
		$params = [
			
			'slug'=> $slug,
			
		];
		return $this->db->column('SELECT slug FROM posts WHERE slug = :slug', $params);

	}
	public function isPostExistsAdmin($id){
		$params = [
			
			'id'=> $id,
			
		];
		return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);

	}
	
	public function postDelete($id){
		$params = [
			
			'id'=> $id,
			
		];
		 $this->db->column('DELETE FROM posts WHERE id = :id', $params);
		 unlink('materials/'.$id.'.jpg');
	}
	
//////////////////////////////////////////////////////
	public function postData($slug) {
		$params = [
			
			'slug'=> $slug,
			
		];
			return $this->db->row('SELECT posts.*, categories.`name` as `cat_name` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE posts.`slug` = :slug', $params);
	}
	public function postDataAdmin($id) {
		$params = [
			
			'id'=> $id,
			
		];
			return $this->db->row('SELECT posts.*, categories.`name` as `cat_name` FROM posts INNER JOIN categories ON (posts.`category_id`= categories.`category_id`) WHERE posts.`id` = :id', $params);
	}
	
////////////////////////////////////////////////////////////////
	//Категориии

	public function categoryAdd($сategory) {
		$params = [
			
			'name'=> $_POST['name'],
			'slug'=> $_POST['slug'],
			'description'=> $_POST['description'],
		];
	$this->db->query('INSERT INTO categories (name, slug, description) VALUES ( :name, :slug, :description)', $params);

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

	public function categoryDelete($category_id){
		$params = [
			
			'category_id'=> $category_id,
			
		];
		 $this->db->column('DELETE FROM categories WHERE category_id = :category_id', $params);
		 
	}
	public function isCategoryExistsAdmin($category_id){
		$params = [
			
			'category_id'=> $category_id,
			
		];
		return $this->db->column('SELECT category_id FROM categories WHERE category_id = :category_id', $params);

	}

	public function isCategoryExists($slug){
		$params = [
			
			'slug'=> $slug,
			
		];
		return $this->db->column('SELECT slug FROM categories WHERE slug = :slug', $params);

	}
	public function categoryDataAdmin($category_id) {
		$params = [
			
			'category_id'=> $category_id,
			
		];
			return $this->db->row('SELECT * FROM categories WHERE category_id = :category_id', $params);
	}

	public function categoryData($slug) {
		$params = [
			
			'slug'=> $slug,
			
		];
			return $this->db->row('SELECT * FROM categories WHERE slug = :slug', $params);
	}

	public function categoriesList() {
		
		return $this->db->row('SELECT * FROM categories ORDER BY category_id');
	}


}