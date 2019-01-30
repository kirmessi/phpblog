<?php 

return [
//MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'about' => [
		'controller' => 'main',
		'action' => 'about',

	],

	'contact' => [
		'controller' => 'main',
		'action' => 'contact',
	],

	'login' => [
		'controller' => 'main',
		'action' => 'login',
	],
	'logout' => [
		'controller' => 'main',
		'action' => 'logout',
	],
	'dashboard' => [
		'controller' => 'main',
		'action' => 'dashboard',
	],
	'register' => [
		'controller' => 'main',
		'action' => 'register',
	],
//{slug:[\w-]+}
	
	'post/{slug:[\w-]+}' => [
		'controller' => 'main',
		'action' => 'post',
	],
	'category/{slug:[\w-]+}' => [
		'controller' => 'main',
		'action' => 'category',
	],
//AdminContoller
	'admin' => [
		'controller' => 'admin',
		'action' => 'login',
	],

	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],

	'admin/post/add' => [
		'controller' => 'admin',
		'action' => 'postadd',
	],


	'admin/post/edit/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'postedit',
	],

	'admin/post/delete/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'postdelete',
	],

	'admin/category/add' => [
		'controller' => 'admin',
		'action' => 'categoryadd',
	],
	'admin/category/edit/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'categoryedit',
	],
	
	'admin/category/delete/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'categorydelete',
	],

	'admin/posts' => [
		'controller' => 'admin',
		'action' => 'posts',
	],
	'admin/categories' => [
		'controller' => 'admin',
		'action' => 'categories',
	],

];