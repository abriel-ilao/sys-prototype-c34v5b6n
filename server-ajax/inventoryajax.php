<?php 

require_once './auth.php';

use app\data\inventory\InventoryAdd;

if($auth) :	

$inventory = InventoryAdd::Create();
$inventory->createData();

else: 
    require_once 'login-form.php';
endif; 

?> 

