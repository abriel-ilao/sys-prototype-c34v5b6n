<?php 

namespace app\model\accounts 
{
	use \PDO;
	use app\db\connection\DB;
	use app\lib\session\Session;
	use app\model\accounts\AccountsAdminModel;

	class AccountsAdminLoginModel {

		private $_model;

		private $_session_id, 
				$_username, 
				$_password;

		public static function Create() {
			return new AccountsAdminLoginModel;
		}

		private function __construct() {
			$this->_model = AccountsAdminModel::Create();
		}
		private function __clone() {}

		/**
		* Create, Read(retrieve), Update, Delete
		*/
		public function createData() {
			throw new \Exception('Not supported yet.'); 
		}

		public function readData($uname, $pword, $sid) {

			$id = $this->_session_id = $sid;
			$username = $this->_username = $this->_model->setUsername($uname)->getUsername();
			$password = $this->_password = $this->_model->setPassword($pword)->getPassword();

			$sql = "SELECT `id` FROM `tbl_admin_accounts` WHERE `username`=:username AND `password`=:password";
			$stmt = DB::Create()->getPDO()->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->bindValue(':password', $password, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() == null) {
				echo '<div class="p-1 mt-3 mb-3 bg-danger text-white">Incorrect Username Or Password</div>';			
				return null;
			}  

			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    $session_id = $row['id'];
				Session::CreateSession($id, $session_id);
				//header('Location: pos.php');
				echo '<div class="p-1 mt-3 mb-3 bg-success text-white">Please wait...</div>';
				echo '<style>*{pointer-events:none;}</style>';
				return '<meta http-equiv="refresh" content="2">';
			}
		}

		public function updateData() {
			throw new \Exception('Not supported yet.'); 
		}

		public function deleteData() {
			throw new \Exception('Not supported yet.'); 
		}
	}
}
