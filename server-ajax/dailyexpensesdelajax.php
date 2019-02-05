<?php

require_once './auth.php';

use app\data\dailyexpenses\DelExpenses;

if($auth) :

$delExpenses = DelExpenses::Create();
$delExpenses->deleteData();

else:
    require_once 'login-form.php';
endif;

?>
