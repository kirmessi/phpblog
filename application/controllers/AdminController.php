<?php

namespace application\controllers; 

use application\core\Controller;
//use application\lib\Pagination;
use application\models\Main;

class AdminController extends Controller {

	

	public function __construct($route){



		parent::__construct($route);
		$this->view->layout ='admin';
		
	}
	
	public function loginAction(){ //главная
		if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/post/add');
		}
		
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('Error', $this->model->error);
			}

		$_SESSION['admin'] = true;
		$this->view->location('admin/post/add');
		}
		$this->view->render('Login');
			
		
	}
	public function logoutAction(){ 
		
		unset($_SESSION['admin']);
		$this->view->redirect('admin/');
		
	}

	public function postaddAction(){ 


		if (!empty($_POST)) {
			if (!$this->model->postValidate($_POST, 'add')) {
				$this->view->message('Error', $this->model->error);
			}
			
			
			$id = $this->model->postAdd($_POST);
			//$this->model->categorypostsAdd();
			$this->model->postUploadImage($_FILES['img']['tmp_name'], $id);
			$this->view->message('success', 'Пост добавлен');
		}

		$vars = [
			
			'list' => $this->model->categoriesList($this->route),
		];
		$this->view->render('Add post', $vars);
		
	}


	public function posteditAction(){ 

		if (!$this->model->isPostExistsAdmin($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->postValidate($_POST, 'edit')) {
				$this->view->message('error', $this->model->error);
			}
			$data = $this->model->postEdit($_POST, $this->route['id']);
			//debug($_POST);
			if ($_FILES['img']['tmp_name']) {
				$this->model->postUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
			}
			if ($data) {
				$this->view->message('success','Cохранено');
			}
			
		}

		$vars = [
			'data' => $this->model->postDataAdmin($this->route['id'])[0],
			'list' => $this->model->categoriesList($this->route),
			//'categories'=>$this->model->categoryPosts(), 
		];
		$this->view->render('Редактировать пост', $vars);
	}

	public function postdeleteAction(){ 

		if (!$this->model->isPostExistsAdmin($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$this->model->postDelete($this->route['id']);
		$this->view->redirect('admin/posts');
		

	}

	public function postsAction() {
		$mainModel = new Main;
		/*$pagination = new Pagination($this->route, $mainModel->postsCount());*/
		$vars = [
			//'pagination' => $pagination->get(),
			'list' => $mainModel->postsList($this->route),
		];
		$this->view->render('Посты', $vars);
	}


	public function categoriesAction() {
		
		/*$pagination = new Pagination($this->route, $mainModel->postsCount());*/
		$vars = [
			//'pagination' => $pagination->get(),
			'list' => $this->model->categoriesList($this->route),
		];
		$this->view->render('Категории', $vars);
	}



	public function categoryaddAction(){ 



		if (!empty($_POST)) {
			if (!$this->model->categoryValidate($_POST)) {
				$this->view->message('Error', $this->model->error);
			}
			$id = $this->model->categoryAdd($_POST);

			
			$this->view->message('success', 'Категория добавлена');
			
		}

		$this->view->render('Add сategoty');
		
	}

	public function categoryeditAction(){ 

		if (!$this->model->isCategoryExistsAdmin($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->categoryValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->categoryEdit($_POST, $this->route['id']);
			
			$this->view->message('success', 'Сохранено');
			
		}


		$vars = [
			'data' => $this->model->categoryDataAdmin($this->route['id'])[0],
		];
		$this->view->render('Редактирование категории', $vars);
	}
	public function categorydeleteAction(){ 

		if (!$this->model->isCategoryExistsAdmin($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$this->model->categoryDelete($this->route['id']);
		$this->view->redirect('admin/categories');
		

	}


}