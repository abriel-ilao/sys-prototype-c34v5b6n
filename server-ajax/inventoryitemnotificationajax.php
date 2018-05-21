<?php 

require_once './auth.php';

use app\data\inventory\InventoryItemNotification;	
use app\controller\accounts\AccountsAdminInfoController;

if($auth) :
    
$inventory = InventoryItemNotification::Create();
$rows = $inventory->readData();

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//get user's level
$level = $accountData->getData('level');

?>

<div class="table-responsive table-pad-bottom">
    <table class="table table-bordered table-hover" style="font-size:13px;">
        <thead>
            <tr style="background-color:#d1ecf1;">
                <?php 
                    if($level == 1 || $level == 2) {
                ?>
            	<th></th>
                <?php 
                    }
                ?>
                <th scope="col">Item code</th>
                <th scope="col">Description</th>
                <th scope="col">Purchased stock</th>
                <th scope="col">Available stock</th>
                <th scope="col">Buying price</th>
                <th scope="col">Selling price</th>
                <th scope="col">Total capital</th>
                <th scope="col">Total profit</th>
                <th scope="col">Date added</th>
            </tr>
        </thead>
        <tbody>
            <?php 
				foreach ($rows as $row) 
				{
					$id = $row['Id'];

					$available_stock = $row['available_stock'];

					if($available_stock <= 20) {
						echo '<tr>';
						if($level == 1 || $level == 2) {
	                        echo '<td><a href="item?id='.$id.'" class="show-please-wait" title="Click to edit this item..."><i class="fa fa-edit"></i></a></td>';
	                    }
						echo '<td>'.ucwords(strtolower($row['item_code'])).'</td>
					            <td><strong>'.ucwords(strtolower($row['description'])).'</strong></td>
					            <td>'.$row['purchased_stock'].'</td>
					            <td style="color:red;"><strong>'.$row['available_stock'].'</strong></td>
					            <td>₱'.$row['buying_price'].'</td>
					            <td>₱'.$row['selling_price'].'</td>
					            <td>₱'.$row['total_capital'].'</td>
					            <td>₱'.$row['total_profit'].'</td>
					            <td>'.ucwords(strtolower($row['date_time'])).'</td>
					        </tr>';
					} 
				}
            ?>
        </tbody>
    </table> 
</div>

<script type="text/javascript">
	function pleaseWait() {
            $('.wrapper-please-wait').hide();
            $('.please-wait').hide();
            $('.show-please-wait').on('click', function() {
                $('.wrapper-please-wait').show();
                $('.please-wait').show();
            });
        }
        
    pleaseWait();
</script>


<?php

else: 
    require_once 'login-form.php';
endif; 

?> 