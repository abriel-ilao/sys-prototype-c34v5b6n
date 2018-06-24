<?php
 
namespace app\model\accounts 
{
	class AccountsAdminModel {
   
		private $_id, 
				$_username, 
				$_password,
				$_firstname,
				$_surname,
				$_email,
				$_level,
				$_date;

		public static function Create() {
			return new AccountsAdminModel;
		}

		private function __construct() {}
		private function __clone() {}
		
		/**
		* Create getter and setter for the model data
		*/
		public function getID() {return $this->_id;}
		public function getUsername() {return $this->_username; }
		public function getPassword() {return $this->_password; }
		public function getFirstname() {return $this->_firstname; }
		public function getSurname() {return $this->_surname; }
		public function getEmail() {return $this->_email; }
		public function getLevel() {return $this->_level; }
		public function getDate() {return $this->_date; }

		public function setID($id) {$this->_id = $id; return $this;}
		public function setUsername($username) {$this->_username = $username; return $this;}
		public function setPassword($password) {$this->_password = $password; return $this;}
		public function setFirstname($firstname) {$this->_firstname = $firstname; return $this;}
		public function setSurname($surname) {$this->_surname = $surname; return $this;}
		public function setEmail($email) {$this->_email = $email; return $this;}
		public function setLevel($level) {$this->_level = $level; return $this;}
		public function setDate($date) {$this->_date = $date; return $this;}
	}
}


