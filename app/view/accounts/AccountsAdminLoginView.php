<?php

namespace app\view\accounts
{
	use app\model\accounts\AccountsAdminLoginModel;
	use app\lib\session\Session;
	use app\lib\validation\factory\Input;
	use app\lib\validation\factory\Required;

	class AccountsAdminLoginView {

		private $_model;

		private $_session_id = 'session_admin',
				$_username,
				$_password;

		public static function Create() {
			return new AccountsAdminLoginView;
		}

		private function __construct() {
			$this->_model = AccountsAdminLoginModel::Create();
		}
		private function __clone() {}

		public function auth() {
			if(Session::IsSetSession($this->_session_id) && !Session::IsEmptySession($this->_session_id)) {
				return true;
			}
		}

		public function login($uname, $pword, $csrf) {

			if(Input::IsIssetPost($uname) && Input::IsIssetPost($pword)) {
				// token from login form must be the same as in the cookie
        if (isset($_POST[$csrf], $_COOKIE[$csrf]))
				{
          if ($_POST[$csrf] == $_COOKIE[$csrf])
					{
						$this->_username = Input::Post($uname);
						$this->_password = md5(Input::Post($pword));

						$userFieldRequired = Required::setRequired($this->_username, true);

						if(!$userFieldRequired->isPassed()) {
							return 'Incorrect Username Or Password';
						}
						//login
						return $this->_model->readData($this->_username, $this->_password, $this->_session_id);
				  }
   			}
			}
		}

		public function logout() {
			return $this->_session_id;
		}
	}
}
