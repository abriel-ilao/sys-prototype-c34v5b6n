<?php

require_once './auth.php';

use app\data\transaction\TransactionLog;
use app\lib\validation\factory\Input;

if($auth) :

$tLog = TransactionLog::Create();
$month = Input::Post('month');
$tLog->setMonth(4);

else:
    require_once 'login-form.php';
endif;

?>
