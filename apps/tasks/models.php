<?php
	namespace Models;
	use \Illuminate\Database\Eloquent\Model;
	class Task extends Model {
		protected $table = "task";
		protected $fillable = ["user", "email", "text", "completed", "modified"];
		public $timestamps = false;
	}