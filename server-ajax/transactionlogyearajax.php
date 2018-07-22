<?php

require_once './auth.php';

use app\data\transaction\TransactionLog;
use app\lib\validation\factory\Input;

if($auth) :

  $level = Input::Post('level');

  if($level == 1 || $level == 2) :
    echo TransactionLog::Create()->setYearly();
  endif;

else:
    require_once 'login-form.php';
endif;

?>
