<?php 

namespace app\controller\accounts
{
	use app\model\accounts\AccountsAdminInfoModel;
	use app\view\accounts\AccountsAdminInfoView;

	class AccountsAdminInfoController {

		private $_view, $_model;

		public static function Create() {
			return new AccountsAdminInfoController;
		}

		public function __construct() {
			$this->_model = AccountsAdminInfoModel::Create();
			$this->_view = AccountsAdminInfoView::Create();
		}
		public function __clone() {}

		public function getData($data) 
		{
			return $this->_view->data($data);
		}

	}
}

