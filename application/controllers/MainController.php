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
		];
		$this->view->render('Home', $vars);	
	}
	
	public function contactAction(){ //контакты

		if (!empty($_POST)) {
			if (!$this->model->contactValidate($_POST)) {
				$this->view->message('Error' ,$this->model->error);
			}
			mail('test@utoo.email', 'Сообщение из блога', $_POST['name'].'|'.$_POST['email'].'|'.$_POST['text']);
			$this->view->message('Success' ,'Ваше сообщение успешно отправлено');
		}

		$this->view->render('Contact');
	

	}

	public function aboutAction(){ //о нас

		$this->view->render('About');
	}

	public function postAction() {
		$adminModel = new Admin;
		if (!$adminModel->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $adminModel->postData($this->route['id'])[0],
		];
		$this->view->render('Пост', $vars);
	}


}