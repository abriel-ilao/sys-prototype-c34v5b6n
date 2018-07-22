<?php

require_once './auth.php';

use app\data\transaction\TransactItems;

if($auth) :

$transact = TransactItems::Create();
$transact->createData();

else:
    require_once 'login-form.php';
endif;

?>
