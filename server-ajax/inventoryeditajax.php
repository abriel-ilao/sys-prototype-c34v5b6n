<?php 

require_once './auth.php';

use app\data\inventory\InventoryEdit;	

if($auth) :

$inventory = InventoryEdit::Create();
$inventory->updateData();

else: 
    require_once 'login-form.php';
endif; 

?> 