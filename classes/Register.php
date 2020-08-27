<?php



	class Register {

		private $conn;

		public function __construct($db){
			$this->conn = $db;
		}

		public function getRegister($sname, $spass){

			if($this->valueExists("users", "username", $sname)) {
				if($this->valueExists("users", "password", $spass)) {
					$this->conn->query("INSERT INTO `users` (`username`, `password`) VALUES ('$sname','$spass')");
					return 'account created successfully';
				} else {
					return 'password already exist';
				}
			} else {
				return 'username already exist';
			}
		}

		private function valueExists($table, $row, $value) {
			$query = $this->conn->query("SELECT $row FROM $table WHERE $row = '$value'");
			return $query->num_rows == 0 ? true : false;
		}

	}