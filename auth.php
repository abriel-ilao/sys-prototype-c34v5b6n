<?php 

require_once 'load-classes.php';

use app\controller\accounts\AccountsAdminLoginController;
use app\lib\session\Session;

Session::ObStart();
Session::SessionStart();

$controller = AccountsAdminLoginController::Create();
$auth = $controller->auth(); 
