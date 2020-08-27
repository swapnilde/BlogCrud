<?php


	class Database{
		private $host = 'localhost';
		private $user = 'blog-app';
		private $pass = 'blog-app';
		private $database = 'blog-app';

		private $_conn;

		private static $_instance;

		public static function getInstance(){
			if(!self::$_instance){
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function __construct(){
			$this->_conn = new mysqli($this->host,$this->user,$this->pass,$this->database);
			if(mysqli_connect_error()){
				trigger_error('Database connection failed: ' . mysqli_connect_error(),E_USER_ERROR);
			}
		}

		private function __clone(){

		}

		public function getConnection(){
			return $this->_conn;
		}
	}