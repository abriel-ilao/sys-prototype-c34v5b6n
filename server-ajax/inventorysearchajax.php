<?php 

require_once './auth.php';

use app\data\inventory\InventorySearch;	

if($auth) :

$inventory = InventorySearch::Create();
$inventory->readData();

else: 
    require_once 'login-form.php';
endif; 

?> 