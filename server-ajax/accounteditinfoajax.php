<?php

require_once './auth.php';

use app\data\accounts\AccountsEditInfo;

if($auth) :

$accounts = AccountsEditInfo::Create();
$accounts->updateData();

else:
    require_once 'login-form.php';
endif;

?>
