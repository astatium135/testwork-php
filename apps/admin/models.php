<?php
	namespace Models;
	use \Illuminate\Database\Eloquent\Model;
	class User extends Model {
		protected $table = "user";
		protected $fillable = ["user", "password"];
		public $timestamps = false;
	}