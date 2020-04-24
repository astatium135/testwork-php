<?php
	require_once "apps/admin/models.php";
	use Models\User;
	require_once "apps/tasks/models.php";
	use Models\Task;
	function auth(){
		$errors = [];
		if($_REQUEST['user'] && $_REQUEST['password']){
			if ($user=User::where('user', $_REQUEST['user'])->first()){
				if(password_verify($_REQUEST['password'], $user->password)){
					$_SESSION['user']=['id'=>$user->id, 'name'=>$user->user];
					header('Location: /');
					return;
				} else $errors[]="Пара логин/пароль не обнаружена";
			} else $errors[]="Пара логин/пароль не обнаружена";
		} else {
			if(!$_REQUEST['user']) {
				$errors[]="Имя пользователя обязательно для ввода";
			}
			if(!$_REQUEST['password']) {
				$errors[]="Пароль обязателен для ввода";
			}
		}
		include "apps/admin/templates/auth.php";
	}
	function edit(){
		$errors = [];
		$id = (int)$_REQUEST['id'];
		if(!$id) {
			$errors[]="Ошибка: не передан id задачи";
			$_SESSION['errors']=$errors;
			header('Location: /');
			return;
		} else {
			$task = Task::where("id", $id)->first(); 
			if(!$task) {
				$errors[]="Ошибка: задача не найдена";
			}
		}
		if($errors){
			$_SESSION['errors']=$errors;
			header('Location: /');
		} else if(isset($_REQUEST["completed"])){
			Task::where("id", $id)->update(["completed"=>(int)$_REQUEST["completed"]]);
			header('Location: /');
		} else if(!($_SERVER['REQUEST_METHOD']=="POST")){
			include "apps/admin/templates/edit.php";
		} else {
			$text = trim($_REQUEST['text']);
			if(!$text ) $errors["text"] = "Текст не должен быть пустым";		
			if($errors){
				$_SESSION["errors"] = $errors;
			} else if($text!=$task->text){
				Task::where("id", $id)->update(["text"=>$text, "modified"=>True]);
			}	
			header('Location: /');
		}
	}