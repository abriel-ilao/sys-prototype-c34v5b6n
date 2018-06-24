<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//get user's level
$level = $accountData->getData('level');

//active navigation
$active = '1';

//init header with one parameter
Header::Create($active);

?> 
    
    <div class="search-pos mb-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6">
                    <div class="pos-sub-item">
                        <ul> 
                            <?php if($level == 1 || $level == 2) : ?>                         
                                <li><a href="pos#add" class="active-sub-item"><i class="fa fa-cart-arrow-down"></i> Add Item</a></li>
                            <?php endif; ?>
                            <?php if($level == 3) : ?> 
                                <li><a href="pos#" class="active-sub-item"><i class="fa fa-shopping-bag"></i> Point of Sale</a></li>
                            <?php endif; ?>   
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
                    <div class="h6-responsive h-inventory" id="add"><i class="fa fa-cart-arrow-down"></i> Add Inventory Item</div>
                    <form action="" method="POST" id="inventoryAdd" role="form">
                        <!--<form action="pos" method="POST">-->
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Item code:</label>
                            <div class="col-sm-8">
                              <input type="text" name="item_code" id="item_code" class="form-control form-control-sm" autocomplete="off" placeholder="Item code" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Description:</label>
                            <div class="col-sm-8">
                              <input type="text" name="description" id="description" class="form-control form-control-sm" autocomplete="off" placeholder="Description" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Type:</label>
                            <div class="col-sm-8">
                              <select name="material_type" id="material_type" class="form-control form-control-sm">
                                <option value="aaa">AAA</option>
                                <option value="bbb">BBB</option>
                                <option value="ccc">CCC</option>
                                <option value="ddd">DDD</option>
                                <option value="eee">EEE</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Purchased stock:</label>
                            <div class="col-sm-4">
                              <input type="number" name="purchased_stock" id="purchased_stock" class="form-control form-control-sm" placeholder="Purchased stock" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Buying price:</label>
                            <div class="col-sm-4">
                              <input type="number" step="0.01" name="buying_price" id="buying_price" class="form-control form-control-sm" placeholder="Buying price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Trucking fee:</label>
                            <div class="col-sm-4">
                              <input type="number" step="0.01" name="trucking_fee" id="trucking_fee" class="form-control form-control-sm" placeholder="Trucking fee" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Monthly expenses:</label>
                            <div class="col-sm-4">
                              <input type="number" step="0.01" name="monthly_expenses" id="monthly_expenses" class="form-control form-control-sm" placeholder="Monthly expenses" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Selling price:</label>
                            <div class="col-sm-4">
                              <input type="number" step="0.01" name="selling_price" id="selling_price" class="form-control form-control-sm" placeholder="Selling price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">&nbsp;</label>
                            <div class="col-sm-8">
                              <button type="submit" id="submit-save" class="btn btn-info float-right"><i class="fa fa-cart-arrow-down"></i> Add Item</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="item-info col-12 col-lg-6">
                    <p class="alert alert-info"><i class="fa fa-info-circle"></i> Item information goes here!</p>
                </div>
                <div class="p-item-success col-12 col-lg-6">                  
                    <p class="alert alert-success"><i class="fa fa-check"></i> Item has been added!</p>
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
                            <p class="p-s-1 text-right">Type:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-material-type" class="p-s-2 text-left"></p>
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
                            <p class="p-s-1 text-right">Trucking fee:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-trucking-fee" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Monthly expenses:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-monthly-expenses" class="p-s-2 text-left"></p>
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
                            <p class="p-s-1 text-right">Profit:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-profit" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Overall profit:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-overall-profit" class="p-s-2 text-left"></p>
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
            inventoryAdd();
            inputFocus();
        });

        $(document).keypress(function(e) {
            if(e.which == 13) {
                $('#submit-save').removeAttr('disabled');
            }
        });

        function inputFocus() {
            $("input").focus(function() {
                $('.item-info').show();
                $('.p-item-success').hide();
                $('#submit-save').removeAttr('disabled');          
            });
        }

        function inventoryAdd() {

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

            $('#inventoryAdd').submit(function(e) {  

                var item_code = $('#item_code').val(),
                    description = $('#description').val(),
                    material_type = $('#material_type').val(),
                    purchased_stock = $('#purchased_stock').val(),
                    buying_price = $('#buying_price').val(),
                    trucking_fee = $('#trucking_fee').val(),
                    monthly_expenses = $('#monthly_expenses').val(),
                    selling_price = $('#selling_price').val(); 

                //preventing a page refresh
                e.preventDefault();
                
                //disable submit button
                $('#submit-save').attr('disabled', 'disabled');

                //please wait
                $('.wrapper-please-wait').show();
                $('.please-wait').show();

                //adding inventory item using ajax
                $.ajax({
                    url: "server-ajax/inventoryajax", 
                    type: "POST",
                    data: $('#item_code, #description, #material_type, #purchased_stock, #buying_price, #trucking_fee, #monthly_expenses, #selling_price').serialize(), 
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
                        $('#p-material-type').text(material_type);
                        $('#p-purchased-stock').text(purchased_stock);
                        $('#p-available-stock').text(purchased_stock);
                        $('#p-buying-price').text('₱' + buying_price);
                        $('#p-trucking-fee').text('₱' + trucking_fee);
                        $('#p-monthly-expenses').text('₱' + monthly_expenses);
                        $('#p-selling-price').text('₱' + selling_price);

                        var computeProfit = (selling_price - buying_price - trucking_fee - monthly_expenses);
                        var computeOverallProfit = (computeProfit * purchased_stock);

                        //show total capital and profit
                        $('#p-profit').text('₱' + Number(computeProfit).toFixed(1));
                        $('#p-overall-profit').text('₱' + Number(computeOverallProfit).toFixed(1));

                        //clear inputs
                        $("input").val('');
                        
                        console.log("AJAX request was successfull - action=INSERT");  
                    },
                    complete: function(data) {      
                        console.log("AJAX request was completed - action=INSERT");
                    },
                    error:function(){
                        console.log("AJAX request was a failure - action=INSERT");
                    } 
                });           
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
    
