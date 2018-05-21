<?php

namespace app\view\accounts 
{
	use app\model\accounts\AccountsAdminInfoModel;

	class AccountsAdminInfoView {

		private $_model;

		private $_session_id = 'session_admin', 
				$_username, 
				$_password;

		public static function Create() {
			return new AccountsAdminInfoView;
		}

		private function __construct() {
			$this->_model = AccountsAdminInfoModel::Create();
		}
		private function __clone() {}

		public function data($data) 
		{
			return $this->_model->readData($data);
		}
	}
}



