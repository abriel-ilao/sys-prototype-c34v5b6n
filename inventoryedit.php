<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\inventory\InventoryEditInfo;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//get user's level
$level = $accountData->getData('level');

//active navigation
$active = '1';

//init inventory item's info
$inventoryData = InventoryEditInfo::Create();

//init header with one parameter
Header::Create($active);

//get inventory item's ID
$itemId = $_GET['id'];

?> 
    
    <div class="search-pos mb-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6">
                    <div class="pos-sub-item">
                        <ul>                          
                            <li><a href="pos#add" class="show-please-wait"><i class="fa fa-cart-arrow-down"></i> Add Item</a></li>
                            <li><a href="inventory#view" class="show-please-wait"><i class="fa fa-tag"></i> View Items</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-md-6">
                    <!--<form class="form-inline">-->
                    <div class="col-auto">
                      <label class="sr-only" for="inlineFormInputGroup">Search Item (Inventory)</label>
                      <div class="input-group">                         
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Search Items (Inventory)">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                      </div>
                    </div>
                      <!--<span class="m-search-pos-logo"><i class="fa fa-search"></i></span>-->
                      <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>

    <div class="container panel-x">
        <?php if($level == 1 || $level == 2) : ?>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="h6-responsive h-inventory" id="add"><i class="fa fa-edit"></i> Edit Inventory Item</div>
                    <form action="" method="POST" id="inventoryEdit" role="form">
                        <!--<form action="pos" method="POST">-->
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Item code:</label>
                            <div class="col-sm-8">
                              <input type="hidden" name="item_id" id="item_id" value="<?=$itemId;?>">
                              <input type="text" name="item_code" id="item_code" value="<?= $inventoryData->readData('item_code', $itemId); ?>" class="form-control form-control-sm" autocomplete="off" placeholder="Item code" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Description:</label>
                            <div class="col-sm-8">
                              <input type="text" name="description" id="description" value="<?= $inventoryData->readData('description', $itemId); ?>" class="form-control form-control-sm" autocomplete="off" placeholder="Description" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Purchased stock:</label>
                            <div class="col-sm-4">
                              <input type="number" name="purchased_stock" id="purchased_stock" value="<?= $inventoryData->readData('purchased_stock', $itemId); ?>" class="form-control form-control-sm" placeholder="Purchased stock" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Available stock:</label>
                            <div class="col-sm-4">
                              <input type="number" name="available_stock" id="available_stock" value="<?= $inventoryData->readData('available_stock', $itemId); ?>" class="form-control form-control-sm" placeholder="Purchased stock" required>
                              <div class="inventory-purchased-available-stock">P < A</div>
                            </div>
                        </div>
                        <!--<div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Available stock:</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Available stock">
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Buying price:</label>
                            <div class="col-sm-4">
                              <input type="number" step="0.01" name="buying_price" id="buying_price" value="<?= $inventoryData->readData('buying_price', $itemId); ?>" class="form-control form-control-sm" placeholder="Buying price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Selling price:</label>
                            <div class="col-sm-4">
                              <input type="number" step="0.01" name="selling_price" id="selling_price" value="<?= $inventoryData->readData('selling_price', $itemId); ?>" class="form-control form-control-sm" placeholder="Selling price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">&nbsp;</label>
                            <div class="col-sm-8">
                              <button type="submit" id="submit-save" class="btn btn-primary float-right"><i class="fa fa-edit"></i> Save Item</button>
                            </div>
                        </div>

                      <!--<div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Total Capital:</label>
                        <div class="col-sm-8 col-sm-8 col-md-4">
                          <span style="font-size:13px;">P123</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Total profit:</label>
                        <div class="col-sm-8 col-sm-8 col-md-4">
                          <span style="font-size:13px;">P234</span>
                        </div>
                      </div>-->
                    </form>
                </div>
                <div class="item-info col-12 col-lg-6">
                    <p class="alert alert-info"><i class="fa fa-info-circle"></i> Item information goes here!</p>
                </div>
                <div class="p-item-success col-12 col-lg-6">                  
                    <p class="alert alert-success"><i class="fa fa-check"></i> Item has been updated!</p>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Item code:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-item-code" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Description:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-description" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Purchased stock:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-purchased-stock" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Available stock:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-available-stock" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Buying price:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-buying-price" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Selling price:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-selling-price" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Total capital:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-total-capital" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Total profit:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-total-profit" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?> 
        
        <?php if($level == 3) : ?>   
            <p>POS FOR LEVEL 3</p>
        <?php endif; ?>
    </div>

<?php

Footer::Create();

?>

    <script type="text/javascript">
        $(document).ready(function() 
        {
            $('.p-item-success').hide();
            inventoryEdit();
            inputFocus();
        });

        $(document).keypress(function(e) {
            if(e.which == 13) {
                //$('#submit-save').removeAttr('disabled');
            }
        });

        function inputFocus() {
            $("input").focus(function() {
                $('.item-info').show();
                $('.p-item-success').hide();
                //$('#submit-save').removeAttr('disabled');          
            });
        }

        function inventoryEdit() {
         
            var __ucwords = (function (str) {
                return function (str) {
                    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                        return $1.toUpperCase();
                    });
                }
            })();

            var __strtolower = (function (str) {
                return function (str) {
                    return (str+'').toLowerCase();
                }
            })();        

        $('#inventoryEdit').submit(function(e) { 

            //preventing a page refresh
            e.preventDefault();

            var item_code = $('#item_code').val(),
                description = $('#description').val(),
                purchased_stock = $('#purchased_stock').val(),
                available_stock = $('#available_stock').val(),
                buying_price = $('#buying_price').val(),
                selling_price = $('#selling_price').val();

                if(Number(purchased_stock) < Number(available_stock)) 
                {    
                    $('.inventory-purchased-available-stock').fadeIn();
                    setTimeout(function() {
                        //display error log
                        $('.inventory-purchased-available-stock').fadeOut();
                    }, 4000);      
                } else {

                    //display error log
                    $('.inventory-purchased-available-stock').hide();

                    //please wait
                    $('.wrapper-please-wait').show();
                    $('.please-wait').show();

                    //updating inventory item using ajax
                    $.ajax({
                        url: "server-ajax/inventoryeditajax", 
                        type: "POST",
                        data: $('#item_id, #item_code, #description, #purchased_stock, #available_stock, #buying_price, #selling_price').serialize(), 
                        success: function() {
                            //show item log
                            $('.p-item-success').fadeIn();
                            
                            //hide item-info
                            $('.item-info').hide();

                            //hide please wait
                            $('.wrapper-please-wait').hide();
                            $('.please-wait').hide();    

                            //show item details
                            $('#p-item-code').text(item_code);
                            $('#p-description').text(__ucwords(__strtolower(description)));
                            $('#p-purchased-stock').text(purchased_stock);
                            $('#p-available-stock').text(available_stock);
                            $('#p-buying-price').text('₱' + buying_price);
                            $('#p-selling-price').text('₱' + selling_price);

                            //total capital = (buying price * quantity)
                            var t_capital = (buying_price * purchased_stock);

                            //total profit = (selling price * quantity)
                            var t_profit = (selling_price * purchased_stock);

                            //show total capital and profit
                            $('#p-total-capital').text('₱' + Number(t_capital).toFixed(1));
                            $('#p-total-profit').text('₱' + Number(t_profit).toFixed(1));

                            /*if(purchased_stock <= 20) {
                                $('#availableStockNum').text(purchased_stock).css({'color' : 'red'});
                            } else {
                                $('#availableStockNum').text(purchased_stock).css({'color' : '#0c5460'});
                            }*/
                            
                            console.log("AJAX request was successfull - action=UPDATE");  
                        },
                        complete: function(data) {      
                            console.log("AJAX request was completed - action=UPDATE");
                        },
                        error:function(){
                            console.log("AJAX request was a failure - action=UPDATE");
                        }                     
                    });
                }           
            });         
        }
    </script>

<?php 
        else: 
            require_once 'login-form.php';
        endif; 
?> 

</body>
</html>
    
