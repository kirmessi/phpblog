<?php

namespace application\controllers; 

use application\core\Controller;
use application\lib\Db;
use application\models\Admin;

class MainController extends Controller {
	public function indexAction(){ //главная
		$vars = [
			//'pagination' => $pagination->get(),
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

	public function loginAction(){ 
	if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('Error' ,$this->model->error);
			}
			$this->model->login($_POST);
			$_SESSION['authorize'] = true;
			$_SESSION['authorize'] = $_POST['username'];
			$this->view->location('dashboard');					
		}
		if(isset($_SESSION['authorize']))    {

   		$this->view->redirect('dashboard');
		}
		/*$vars = [
			//'pagination' => $pagination->get(),
			'list' => $this->model->postsList($this->route),
		];*/
		
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
		
		$this->view->rendertwig($this->route,array());	
	}

	public function dashboardAction(){
		
		$vars = [
			'list' => $this->model->dashboard($_SESSION['authorize']),
			 'session'   => $_SESSION,
			
		];
		$this->view->rendertwig($this->route,$vars);	
		
	}
	public function logoutAction(){
		unset($_SESSION['authorize']);
		$this->view->redirect('');
	}

}