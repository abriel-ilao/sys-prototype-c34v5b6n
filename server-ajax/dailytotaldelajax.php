<?php

require_once './auth.php';

use app\data\dailytotal\DelDailyTotal;

if($auth) :

$delDailyTotal = DelDailyTotal::Create();
$delDailyTotal->deleteData();

else:
    require_once 'login-form.php';
endif;

?>
