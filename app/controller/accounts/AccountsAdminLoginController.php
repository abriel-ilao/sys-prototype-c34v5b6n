<?php 

namespace app\controller\accounts
{
	use app\model\accounts\AccountsAdminLoginModel;
	use app\view\accounts\AccountsAdminLoginView;

	class AccountsAdminLoginController {

		private $_view, $_model;

		public static function Create() {
			return new AccountsAdminLoginController;
		}

		public function __construct() {
			$this->_model = AccountsAdminLoginModel::Create();
			$this->_view = AccountsAdminLoginView::Create();
		}
		public function __clone() {}

		public function auth()
		{
			if($this->_view->auth())
			{
				return true;
			}
			return false;
		}

		public function login($uname, $pword, $csrf)
		{
			return $this->_view->login($uname, $pword, $csrf);
		}

		public function logout() 
		{
			return $this->_view->logout();
		}
	}
}

