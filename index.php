<?php
	require_once "settings.php";
	require_once 'vendor/autoload.php';
	require_once 'database.php';
	
	use Models\Database;
	$db = new Database();
	
	//$db = new PDO("mysql:host=".DATABASE["host"].";dbname=".DATABASE["NAME"], DATABASE['user'], DATABASE['pass'], null);
	require_once "urls.php";
	
	session_start();
	
	$request_path = $_SERVER['REQUEST_URI'];
	if(($pos = strpos($request_path, '?')) !== false){
        $request_path = substr($request_path, 0, $pos);
    }
	foreach($urlpatterns as $path){
		if($path[0] == $request_path){
			$path[1]();
		}
	}
?>