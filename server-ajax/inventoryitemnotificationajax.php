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

if($level == 1 || $level == 2) {

?>

<div class="table-responsive table-pad-bottom">
    <table class="table table-bordered table-hover" style="font-size:13px;">
        <thead>
            <tr style="background-color:#d1ecf1;">
            	<th></th>
                <th scope="col">Item code</th>
                <th scope="col">Description</th>
                <th scope="col">Available Stock</th>
                <th scope="col">Material Type</th>
                <th scope="col">Purchased Stock</th>
                <th scope="col">Buying Price</th>
                <th scope="col">Trucking Fee</th>
                <th scope="col">Monthly Expenses</th>
                <th scope="col">Selling Price</th>
                <th scope="col">Total Sales</th>
                <th scope="col">Balance Sales</th>
                <th scope="col">Profit</th>
                <th scope="col">Total Profit</th>
                <th scope="col">Date Added</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $htmlData = '';

        				foreach ($rows as $row)
        				{
        					$id = $row['Id'];
        					$item_code          = $row['item_code'];
                  $description        = $row['description'];
                  $material_type      = $row['material_type'];
                  $purchased_stock    = $row['purchased_stock'];
                  $available_stock    = $row['available_stock'];
                  $buying_price       = $row['buying_price'];
                  $trucking_fee       = $row['trucking_fee'];
                  $monthly_expenses   = $row['monthly_expenses'];
                  $selling_price      = $row['selling_price'];
                  $profit             = $row['profit'];
                  $overall_profit     = $row['overall_profit'];
                  $date_time          = $row['date_time'];

                  //compute total sales
                  $total_sales = $purchased_stock * $selling_price;
                  //compute balance sales
                  $balance_sales = $available_stock * $selling_price;

                  if($available_stock <= 20)
                      $red = 'color:red;';
                  else
                      $red = '';

                  if($material_type == 'screw, bolts & nuts, washers') {
                      $explodeType = explode(" ", $material_type);
                      $mType = $explodeType[0].' '.$explodeType[1].'...';
                  } else {
                      $mType = $material_type;
                  }

                      $explodeDateTime = explode(" ", $date_time);

            					if($available_stock <= 20) {

                        $htmlData .= '<tr>';

                        $htmlData .= '<td class="text-center"><a href="item?id='.$id.'" title="Click to edit this item..."><i class="fa fa-edit"></i></a></td>';

                        $htmlData .= '<td><a href="#" data-toggle="modal" data-target="#view_'.$id.'">'.ucwords(strtolower($item_code)).'</a></td>';

            						$htmlData .= '<td><strong>'.ucwords(strtolower($description)).'</strong></td>
                                    <td style="'.$red.'"><strong>'.$available_stock.'</strong></td>
            					              <td>'.ucwords(strtolower($mType)).'</td>
                                    <td>'.number_format($purchased_stock).'</td>
            					              <td>₱'.number_format($buying_price, 1).'</td>
                                    <td>₱'.number_format($trucking_fee, 1).'</td>
                                    <td>₱'.number_format($monthly_expenses, 1).'</td>
                                    <td>₱'.number_format($selling_price, 1).'</td>
                                    <td>₱'.number_format($total_sales, 1).'</td>
                                    <td>₱'.number_format($balance_sales, 1).'</td>
            					              <td>₱'.number_format($profit, 1).'</td>
            					              <td>₱'.number_format($overall_profit, 1).'</td>
            					              <td>'.ucwords(strtolower($explodeDateTime[0])).'</td>
            					            </tr>';
            					}
                    ?>

                        <!-- Modal -->
                        <div class="modal fade" id="view_<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="m-display-show modal-title" id="exampleModalLabel">Inventory Item</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row no-gutters">
                                            <div class="col-12 text-center">
                                                <div class="modal-txt">Item code: <strong><?= ucwords(strtolower($item_code)); ?></strong></div>
                                                <div class="modal-txt">Description: <strong><?= ucwords(strtolower($description)); ?></strong></div>
                                                <div class="modal-txt">Material Type: <strong><?= ucwords(strtolower($material_type)); ?></strong></div>

                                                <?php if($level == 1 || $level == 2): ?>
                                                <div class="modal-txt">Purchased stock: <strong><?= number_format($purchased_stock); ?></strong></div>
                                                <div class="modal-txt">Available stock: <span style="<?= $red; ?>"><strong><?= $available_stock; ?></strong></span></div>
                                                <div class="modal-txt">Buying price: <strong>₱<?= number_format($buying_price, 1); ?></strong></div>
                                                <div class="modal-txt">Trucking fee: <strong>₱<?= number_format($trucking_fee, 1); ?></strong></div>
                                                <div class="modal-txt">Monthly expenses: <strong>₱<?= number_format($monthly_expenses, 1); ?></strong></div>
                                                <?php endif; ?>

                                                <div class="modal-txt">Selling price: <strong>₱<?= number_format($selling_price, 1); ?></strong></div>

                                                <?php if($level == 1 || $level == 2): ?>
                                                <div class="modal-txt">Total Sales: <strong>₱<?= number_format($total_sales, 1); ?></strong></div>
                                                <div class="modal-txt">Balance Sales: <strong>₱<?= number_format($balance_sales, 1); ?></strong></div>
                                                <div class="modal-txt">Profit: <strong>₱<?= number_format($profit, 1); ?></strong></div>
                                                <div class="modal-txt">Total profit: <strong>₱<?= number_format($overall_profit, 1); ?></strong></div>
                                                <div class="modal-txt">Date Added: <strong><?= ucwords(strtolower($date_time)); ?></strong></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if($level == 1 || $level == 2): ?>
                                        <a href="item?id=<?=$id;?>" title="Click to edit this item..." class="m-display-show btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Item</a> &nbsp;
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
				}
                echo $htmlData;
?>
        </tbody>
    </table>
</div>

<?php
}
?>

<?php

else:
    require_once 'login-form.php';
endif;

?>
