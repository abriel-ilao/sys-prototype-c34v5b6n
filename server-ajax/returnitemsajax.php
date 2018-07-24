<?php
/*
* a copy of product transaction's source code - cart
* Return items / Refundables - cartReturn
*/

require_once './auth.php';

use app\data\returnitems\ReturnItems;

if($auth) :

$returnItems = ReturnItems::Create();
$returnItems->createData();

else:
    require_once 'login-form.php';
endif;

?>
