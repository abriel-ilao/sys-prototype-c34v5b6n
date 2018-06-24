<?php 

require_once 'load-classes.php';

use app\controller\accounts\AccountsAdminLoginController;
use app\lib\session\Session;

Session::SessionStart();

$controller = AccountsAdminLoginController::Create();
$session_id = $controller->logout();

Session::UnsetSession($session_id);

header('Location: pos');

?>


