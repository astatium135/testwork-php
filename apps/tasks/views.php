<?php
	require_once "apps/tasks/models.php";
	use Models\Task;
	function view(){
		$page = (int)$_REQUEST["page"] or 0;
		$sort_list = ['', 'user', 'email', 'completed', 'modified'];
		$sort = $sort_list[(int)array_search((string)$_REQUEST['sort'], $sort_list)];
		$order_list = ['asc', 'desc'];
		$order = $order_list[(int)array_search($_REQUEST['order'], $order_list)];
		
		if($sort) {
			$all_tasks = Task::orderBy($sort, $order)
				->get();
		} else {
			$all_tasks = Task::all();
		}
		$pages = ceil(count($all_tasks)/TASKS_PER_PAGE);
		
		if($page>=$pages) $page=$pages-1;
		if($page<0) $page=0;
		
		$tasks = $all_tasks->splice($page*TASKS_PER_PAGE, TASKS_PER_PAGE);
		if($_SESSION["success_add_task"]) {
			$success_add_task = $_SESSION["success_add_task"];
			unset($_SESSION["success_add_task"]);
		}
		if($_SESSION["errors"]){
			$errors = $_SESSION["errors"];
			unset($_SESSION["errors"]);
		}
		$_SESSION['defaultArgs'] = [
				'page' => $page,
				'sort' => $sort,
				'order' => $order,
			];
		function create_href($args=[]){
			$args = array_merge($_SESSION['defaultArgs'], $args);
			$href = "";
			if($args['page']) $href.="page=".(string)$args['page']."&";
			if($args['sort']) $href.="sort=".(string)$args['sort']."&";
			if($args['order']) $href.="order=".(string)$args['order']."&";
			if($href) $href="/?".substr($href, 0, -1);
			else $href = "/";
			return $href;
		}
		include "apps/tasks/templates/view.php";
	}
	
	function add(){
		
		$task = [
			"user" => trim($_REQUEST['user']),
			"email" => trim($_REQUEST['email']),
			"text" => trim($_REQUEST['text'])
		];
		
		$errors = [];
		if(!$task["user"]) $errors["user"] = "Имя пользователя не должно быть пустым";
		if(!$task["email"]) $errors["email"] = "Email не должен быть пустым";
		if(!filter_var($task["email"], FILTER_VALIDATE_EMAIL)) $errors["email"] = "Email введён неверно";
		if(!$task["text"]) $errors["text"] = "Текст не должен быть пустым";
		
		if(!$errors){
			Task::create($task);
			$_SESSION["success_add_task"] = $task["text"];
		} else {
			$_SESSION["errors"] = $errors;
		}
		
		header('Location: /');
	}