<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\transaction\TransactionAddItem;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//init transaction - adding an item
$transacAddItem = TransactionAddItem::Create();

//get user's level
$level = $accountData->getData('level');

//active navigation
$active = '2';

//init header with one parameter
Header::Create($active);

function subMenuItem($level, $elementPos) {
?>
<div class="col-sm-8 col-md-6">
    <div class="pos-sub-item <?= $elementPos; ?>">
        <ul>
            <?php if($level == 1 || $level == 2) : ?>
                <li><a href="pos#add" class="active-sub-item"><i class="fa fa-cart-arrow-down"></i> Add Item</a></li>
            <?php endif; ?>
            <?php if($level == 3) : ?>
                <li><a href="pos" class="active-sub-item"><i class="fa fa-shopping-bag"></i> Point of Sale</a></li>
            <?php endif; ?>
                <li><a href="inventory" class="show-please-wait"><i class="fa fa-tag"></i> View Items</a></li>
        </ul>
    </div>
</div>
<?php
}

function searchItems() {
?>
<div class="col-sm-8 col-md-6">
    <!--<form class="form-inline">-->
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">Search Items (Item Code, Desc..., Type, Selling Price)</label>
      <div class="input-group">
        <input type="text" class="form-control" id="searchText" placeholder="Search Items (Item Code, Desc..., Type, Selling Price)">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-search"></i></div>
        </div>
      </div>
    </div>
</div>
<?php
}
?>
    <div class="header-sub mb-2">
        <div class="container">
            <div class="row">
              <?php
                if($level == 1 || $level == 2):
                  subMenuItem($level, 'text-left');
                  searchItems();
                endif;
                if($level == 3):
                  searchItems();
                  subMenuItem($level, 'text-right');
                endif;
              ?>
            </div>
        </div>
    </div>

    <div class="m-search pt-5 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--<form class="form-inline">-->
                    <div class="col-auto">
                      <label class="sr-only" for="inlineFormInputGroup">Search Items (Item Code, Desc..., Type, Selling Price)</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="m-searchText" placeholder="Search Items (Item Code, Desc..., Type, Selling Price)">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container panel-x container-search mb-2">
        <div class="row">
            <div class="col-12">
                <div id="searchResult"></div>
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
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Material Type:</label>
                            <div class="col-sm-8">
                              <select name="material_type" id="material_type" class="form-control form-control-sm">
                                <option value="Major Items">Major Items</option>
                                <option value="Hardware">Hardware</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Plumbing">Plumbing</option>
                                <option value="Tools">Tools</option>
                                <option value="Paint">Paint</option>
                                <option value="Screw, Bolts & Nuts, Washers">Screw, Bolts & Nuts, Washers</option>
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
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8 smooth-scroll">
                              <button type="submit" id="submit-save" class="btn btn-info float-right"><i class="fa fa-cart-arrow-down"></i> Add Item</button>
                              <a href="#scroll-view-log" id="btn-view-log" class="btn alert-success float-right mr-2"><i class="fa fa-check"></i> Saved!</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="item-info col-12 col-lg-6">
                    <p class="alert alert-info"><i class="fa fa-info-circle"></i> Item information goes here!</p>
                </div>
                <div class="p-item-success col-12 col-lg-6">
                    <p class="alert alert-success" id="scroll-view-log"><i class="fa fa-check"></i> Item has been added!</p>
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
                            <p class="p-s-1 text-right">Material Type:</p>
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
                            <p class="p-s-1 text-right">Total Sales:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-total-sales" class="p-s-2 text-left"></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <p class="p-s-1 text-right">Balance Sales:</p>
                        </div>
                        <div class="col-6">
                            <p id="p-balance-sales" class="p-s-2 text-left"></p>
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
        <?php
          @$cookie = $_COOKIE["product-item"];
        ?>
          <div class="row">
              <div class="col-12">
                <div class="h6-responsive h-inventory" id="add"><i class="fa fa-shopping-cart"></i> Product Transaction</div>
                <?php if($cookie == null) : ?>
                <h4 class="h-class h4-responsive mt-5 mb-5" style="color:silver;">Product item goes here...</h4>
                <?php endif; ?>
                <div class="transaction-add-item">
                <!-- /* I stopped here */ -->
                <?php $transacAddItem->readData(); ?>
                </div>
              </div>
          </div>
        <?php endif; ?>
    </div>

<?php

Footer::Create();

?>

    <script type="text/javascript">
        $(document).ready(function()
        {
            $('.p-item-success').hide();
            $('#btn-view-log').hide();
            inventoryAdd();
            inputFocus();
        });

        $(document).keypress(function(e) {
            if(e.which == 13) {
                $('#submit-save').removeAttr('disabled');
            }
        });

        function inputFocus() {
            $("input#item_code, input#description, input#purchased_stock, input#buying_price, input#trucking_fee, input#monthly_expenses, input#selling_price").focus(function() {
                $('.item-info').show();
                $('.p-item-success').hide();
                $('#btn-view-log').hide();
                $('#submit-save').removeAttr('disabled');
            });
        }

        function inventoryAdd() {

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
                        //show btn saved
                        $('#btn-view-log').fadeIn();
                        //hide item-info
                        $('.item-info').hide();
                        //hide please wait
                        $('.wrapper-please-wait').hide();
                        $('.please-wait').hide();

                        //show item details
                        $('#p-item-code').text(item_code);
                        $('#p-description').text(__ucwords(__strtolower(description)));
                        $('#p-material-type').text(__ucwords(__strtolower(material_type)));
                        $('#p-purchased-stock').text(purchased_stock);
                        $('#p-available-stock').text(purchased_stock);
                        $('#p-buying-price').text('₱' + buying_price);
                        $('#p-trucking-fee').text('₱' + trucking_fee);
                        $('#p-monthly-expenses').text('₱' + monthly_expenses);
                        $('#p-selling-price').text('₱' + selling_price);

                        //compute total sales
                        var total_sales = purchased_stock * selling_price;

                        var computeProfit = (selling_price - buying_price - trucking_fee - monthly_expenses);
                        var computeOverallProfit = (computeProfit * purchased_stock);

                        //show total and balance sales
                        $('#p-total-sales').text('₱' + Number(total_sales).toFixed(1));
                        $('#p-balance-sales').text('₱' + Number(total_sales).toFixed(1));

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
    <script type="text/javascript">
        $(document).ready(function()
        {
            function loadSearchData(query)
            {
                var level = <?php echo $level; ?>

                $.ajax({
                    url:"server-ajax/inventorysearchajax",
                    method:"post",
                    data:{query:query, level:level},
                    success:function(data)
                    {
                        $('#searchResult').html(data);
                    }
                });
            }

            $('#searchText, #m-searchText').keyup(function() {
                var search = $(this).val();
                if(search != '')
                {
                    loadSearchData(search);
                    $('.container-search').show();
                }
                else
                {
                    $('.container-search').hide();
                }
            });
        });
    </script>
    <script type="text/javascript" src="./js/mycart.js"></script>
    <script type="text/javascript">
      $(document).ready(function()
       {
        var cart = new Cart();

        _objElement.btnDel.click(function()
        {
          var itemId = $(this).attr("data-id");
          cart.delProduct(itemId);
        });

        _objElement.btnCheckout.click(function() {
          cart.checkoutProduct();
        });

      });
    </script>

<?php
        else:
            require_once 'login-form.php';
        endif;
?>

</body>
</html>
