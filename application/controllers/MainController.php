<?php

namespace application\controllers; 

use application\core\Controller;
use application\lib\Db;
use application\models\Admin;

class MainController extends Controller {

	public function indexAction(){ //главная
			$vars = [
			'list' => $this->model->postsList($this->route),
			'session'   => $_SESSION,
		];
		$this->view->rendertwig($this->route,$vars);	
	}

	public function contactAction(){ //контакты
		
		if (!empty($_POST)) {
			if (!$this->model->contactValidate($_POST)) {
				$this->view->message('Error' ,$this->model->error);
			}
			mail('test@utoo.email', 'Сообщение из блога', $_POST['name'].'|'.$_POST['email'].'|'.$_POST['text']);
			$this->view->message('Success' ,'Ваше сообщение успешно отправлено');
		}

		$this->view->rendertwig($this->route,array());	
	}

	public function aboutAction(){ //о нас
		$this->view->rendertwig($this->route,array());	
	}

	public function postAction() {
		$adminModel = new Admin;
		if (!$adminModel->isPostExists($this->route['slug'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $adminModel->postData($this->route['slug'])[0],
		];
		$this->view->rendertwig($this->route,$vars);
		}

	public function categoryAction() {
		$adminModel = new Admin;
		if (!$adminModel->isCategoryExists($this->route['slug'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'list' => $this->model->categorypostsList($this->route['slug']),
			'category'=>$this->model->categorySelected($this->route['slug']), 
		];
		$this->view->rendertwig($this->route,$vars);
	}

	public function authorAction() {
	
		if (!$this->model->isAuthorExists($this->route['id'])) {
			$this->view->errorCode(404);
		}

		$vars = [
			'list' => $this->model->authorpostsList($this->route['id']),
			'author'=>$this->model->AuthorSelected($this->route['id'])[0], 
		];
		$this->view->rendertwig($this->route,$vars);
		//$this->view->render('sadsada',$vars);
	}

	public function loginAction(){ 
		
	if (!empty($_POST)) {

		if (!$this->model->loginValidate($_POST)) {
			$this->view->message('Error' ,$this->model->error);
			}
			$this->model->login($_POST);
			$id = $this->model->loginId($_POST)[0];
			$_SESSION['authorize'] = true;
			$_SESSION['authorize'] = $id;
			$this->view->location('dashboard');	

		}
		if(isset($_SESSION['authorize']))    {

   		$this->view->redirect('dashboard');
		}

		$this->view->rendertwig($this->route,array());	
	}

	public function registerAction(){ 

		if (!empty($_POST)) {
			if (!$this->model->registerValidate($_POST)) {
				$this->view->message('Error' ,$this->model->error);
			}
			$this->model->register($_POST);
			$this->view->message('Success' ,'Your are registered now!');
		}

		if(isset($_SESSION['authorize']))    {
   		$this->view->redirect('dashboard');
		}

		$this->view->rendertwig($this->route,array());	
	}

	public function dashboardAction(){
		
		$vars = [
			'list' => $this->model->dashboard($_SESSION['authorize']['id']),
			'session'   => $_SESSION,
			'posts' => $this->model->postsListcurrnetUser($_SESSION['authorize']['id']),
			'data' =>$this->model->postsListforUser($this->route,$_SESSION['authorize']['id'])[0],
			
		];
		$this->view->rendertwig($this->route,$vars);	

	}

	public function dashboardaddAction(){

		$adminModel = new Admin;
		if (!empty($_POST)) {
			if (!$adminModel->postValidate($_POST, 'add')) {
				$this->view->message('Error', $adminModel->error);
			}
			$id = $adminModel->postAdd($_POST);
	
			$adminModel->postUploadImage($_FILES['img']['tmp_name'], $id);
			$this->view->message('success', 'Пост добавлен на модерацию');
		}
		$vars = [
			'list' => $this->model->dashboard($_SESSION['authorize']['id']),
			'session'   => $_SESSION,
			'categories'=> $adminModel->categoriesList($this->route),
			
		];
		$this->view->rendertwig($this->route,$vars);	
	}
	public function dashboardeditAction(){ 
		
		$adminModel = new Admin;
		if (!$this->model->isPostExistsMain($this->route['id'])) {
			$this->view->errorCode(404);
		}
		elseif($this->model->isPostExistsMain($this->route['id']) != $this->model->isPostBelongToUser($_SESSION['authorize']['id'],$this->route['id'])){
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$adminModel->postValidate($_POST, 'edit')) {
				$this->view->message('error', $this->adminModel->error);
			}
			$data = $adminModel->postEdit($_POST, $this->route['id']);
			//debug($_POST);
			if ($_FILES['img']['tmp_name']) {
				$this->adminModel->postUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
			}
			if ($data) {
				$this->view->message('success','Cохранено');
			}
			
		}

		$vars = [
			'data' => $adminModel->postDataAdmin($this->route['id'])[0],
			'categories' => $adminModel->categoriesList($this->route),
			'session'   => $_SESSION,
		];
		$this->view->rendertwig($this->route, $vars);
	}

	public function dashboarddeleteAction(){ 
		if (!$this->model->isPostExistsMain($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if($this->model->isPostExistsMain($this->route['id']) != $this->model->isPostBelongToUser($_SESSION['authorize']['id'],$this->route['id'])){
			$this->view->errorCode(404);
		}
		$this->model->postDeleteBelongToUser($this->route['id']);
		$this->view->redirect('dashboard');
	}

	public function dashboardsettingsAction(){ 

		if (!empty($_POST)) {
			if (!$this->model->settingsValidate($_POST)) {
				$this->view->message('Error' ,$this->model->error);
			}
			$this->model->UserSettings($_POST, $_SESSION['authorize']['id']);
			$this->view->message('Success' ,'Updated');
		}

		$vars = [
			'data' => $this->model->dashboard($_SESSION['authorize']['id'])[0],
			'session'   => $_SESSION,
		];
		$this->view->rendertwig($this->route, $vars);
		//$this->view->render('adas',$vars);
	}

	public function logoutAction(){
		unset($_SESSION['authorize']);
		$this->view->redirect('');
	}

}