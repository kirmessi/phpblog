<?php

namespace application\controllers; 

use application\core\Controller;
use application\lib\Db;
use application\models\Admin;

class MainController extends Controller {
	public function indexAction(){ //главная
		//include PATH.'application/lib/Dev.php';
		$vars = [
			//'pagination' => $pagination->get(),
			'list' => $this->model->postsList($this->route),
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

}