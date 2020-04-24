<?php
	namespace Models;
	use Illuminate\Database\Capsule\Manager as Capsule;
	class Database {
		function __construct() {
			$capsule = new Capsule;
			$capsule->addConnection([
				"driver" => DATABASE["ENGINE"],
				"host" => DATABASE["HOST"],
				"database" => DATABASE["NAME"],
				"username" => DATABASE["USER"],
				"password" => DATABASE["PASSWORD"],
				"charset" => "utf8mb4",
				"collation" => "utf8mb4_unicode_ci",
				"prefix" => "",
			]);
		 
			$capsule->bootEloquent();
		}
	}