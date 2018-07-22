<?php

require_once './auth.php';

use app\data\transaction\TransactionLog;
use app\lib\validation\factory\Input;

if($auth) :

$tLog = TransactionLog::Create();
$month = Input::Post('month');

  switch ($month)
  {
    case 1:
      $tLog->setMonth(1);
    break;

    case 2:
      $tLog->setMonth(2);
    break;

    case 3:
      $tLog->setMonth(3);
    break;

    case 4:
      $tLog->setMonth(4);
    break;

    case 5:
      $tLog->setMonth(5);
    break;

    case 6:
      $tLog->setMonth(6);
    break;

    case 7:
      $tLog->setMonth(7);
    break;

    case 8:
      $tLog->setMonth(8);
    break;

    case 9:
      $tLog->setMonth(9);
    break;

    case 10:
      $tLog->setMonth(10);
    break;

    case 11:
      $tLog->setMonth(11);
    break;

    case 12:
      $tLog->setMonth(12);
    break;
  }

else:
    require_once 'login-form.php';
endif;

?>
