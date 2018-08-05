<?php

require_once './auth.php';

use app\data\transaction\TransactionDelReturnItems;

if($auth) :

$inventory = TransactionDelReturnItems::Create();
$inventory->deleteData();

else:
    require_once 'login-form.php';
endif;

?>
