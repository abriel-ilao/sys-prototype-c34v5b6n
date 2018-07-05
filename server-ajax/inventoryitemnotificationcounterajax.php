<?php

require_once './auth.php';

use app\data\inventory\InventoryItemNotification;

if($auth) :

$inventory = InventoryItemNotification::Create();
$rows = $inventory->readData();

$counter = 0;

foreach ($rows as $row)
{
	$id = $row['Id'];

	$available_stock = $row['available_stock'];

	if($available_stock <= 20) {
		$counter++;
	}
}

if($counter == 0) {
?>
<style type="text/css">
	.inventory-item-notificaton-num {
		background-color:#ffffff;
		color:black;
		border:1px solid lightgray;
	}
</style>
<?php
echo 0;
} else {
?>
<style type="text/css">
	.inventory-item-notificaton-num {
		background-color:red;
	}
</style>
<?php
echo $counter;
}

else:
    require_once 'login-form.php';
endif;

?>
