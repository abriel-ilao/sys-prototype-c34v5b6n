<?php 

require_once './auth.php';

use app\data\inventory\InventoryDel;

if($auth) :	

$inventory = InventoryDel::Create();
$inventory->deleteData();

else: 
    require_once 'login-form.php';
endif; 

?> 