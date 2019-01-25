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

		if ($nameLen < 3 or $nameLen > 150) {
			$this->error = 'Имя должно содержать от 3 до 20 символов';
			return false;
		} elseif ($descLen < 10 or $descLen > 300) {
			$this->error = 'Описание должно содержать от 10 до 300 символов';
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
	
	$this->db->query('INSERT INTO posts (slug, category_id, name, description, text)
        VALUES ("'.$post['slug'].'","'.$post['category_id'].'", "'.$post['name'].'", "'.$post['description'].'", "'.$post['text'].'")');

			return $this->db->lastInsertId();
	}



	public function postEdit($post,$id) {
	$params = [
			'id' => $id,
			'slug'=> $post['slug'],
			'category_id' => $post['category_id'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('UPDATE posts SET slug = :slug, category_id = :category_id, name = :name,  description = :description, text = :text WHERE id = :id', $params);
			
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