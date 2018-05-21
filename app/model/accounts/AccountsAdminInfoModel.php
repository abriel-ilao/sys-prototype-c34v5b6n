<?php 

namespace app\model\accounts 
{
	use \PDO;
	use app\db\connection\DB;
	use app\lib\session\Session;
	use app\model\accounts\AccountsAdminModel;

	class AccountsAdminInfoModel {

		private $_model;

		private $_id, 
				$_username, 
				$_password,
				$_firstname,
				$_surname,
				$_email,
				$_level,
				$_date;

		public static function Create() {
			return new AccountsAdminInfoModel;
		}

		private function __construct() {
			$this->_model = AccountsAdminModel::Create();
		}
		private function __clone() {}

		public function createData() {
			throw new \Exception('Not supported yet.'); 
		}

		//retrieving data from tbl-accounts
		public function readData($data) {

			$id = $this->_session_id = Session::GetSession('session_admin');
			$sql = "SELECT {$data} FROM `tbl_admin_accounts` WHERE `id`=:id";
			$stmt = DB::Create()->getPDO()->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();

			//fetching data 
			if($data==='username') {
				return $this->_username = $this->_model->setUsername($row[$data])->getUsername();
			}
			 
			if ($data==='firstname') {
				return $this->_firstname = $this->_model->setFirstname($row[$data])->getFirstname();
			}

			if ($data==='surname') {
				return $this->_surname = $this->_model->setSurname($row[$data])->getSurname();
			}

			if ($data==='email') {
				return $this->_email = $this->_model->setEmail($row[$data])->getEmail();
			}

			if ($data==='level') { 
				return $this->_level = $this->_model->setLevel($row[$data])->getLevel();
			}

			if ($data==='date_time') { 
				return $this->_date = $this->_model->setDate($row[$data])->getDate();
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


