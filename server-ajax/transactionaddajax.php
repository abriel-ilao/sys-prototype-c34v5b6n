<?php

require_once './auth.php';

use app\data\transaction\TransactionAddItem;

if($auth) :

$transac = TransactionAddItem::Create();
$rows = $transac->readData();

echo $rows;

else:
    require_once 'login-form.php';
endif;

?>
