<?php
	include 'classes/Session.php';

	class Login {

		private $conn;
		private $config;

		public function __construct($db){
			$this->conn = $db;
			$this->config = new Session();
		}

		public function getLogin($lname,$lpass) {

			if($this->usernameExists("users", $lname)) {
				if($this->getPassword("users", $lname, $lpass)) {
					//return 'got the login';
					session_start();

					$_SESSION[$this->config->getSessionName()] = $lname;

					if(isset($_SESSION[$this->config->getSessionName()])) {
						header("Location: http://localhost:8080/BlogApp/home.php");
					}
				} else {
					return 'did not get the login[p]';
				}
			} else {
				return 'did not get the login[u]';
			}
		}

		private function usernameExists($table, $username) {
			$user = $this->conn->query("SELECT `username` FROM $table WHERE username = '$username'");
			return $user->num_rows > 0 ? true : false;
		}

		private function getPassword($table, $username, $lpass) {
			$password = $this->conn->query("SELECT `password` FROM $table WHERE username = '$username'");
			$pass = $password->fetch_assoc();
			if($pass['password'] == $lpass){
				return true;
			}
		}

	}