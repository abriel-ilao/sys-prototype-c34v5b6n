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

//get user's ID
$userID = $accountData->getData('Id');

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
                <li><a href="pos" class="active-sub-item"><i class="fa fa-cart-arrow-down"></i> Add Item</a></li>
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
                    <div class="h6-responsive h-inventory" id="add"><i class="fa fa-cart-arrow-down"></i> Add Inventory Item <span class="m-sub-menu-link float-right"><a href="inventory" class="text-info"><i class="fa fa-tag"></i> View</a></span></div>
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
                            <p class="p-s-1 text-right">Total profit:</p>
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
                        $('#p-purchased-stock').text(__numberWithCommas(purchased_stock));
                        $('#p-available-stock').text(__numberWithCommas(purchased_stock));
                        $('#p-buying-price').text('₱' + __numberWithCommas(buying_price));
                        $('#p-trucking-fee').text('₱' + __numberWithCommas(trucking_fee));
                        $('#p-monthly-expenses').text('₱' + __numberWithCommas(monthly_expenses));
                        $('#p-selling-price').text('₱' + __numberWithCommas(selling_price));

                        //compute total sales
                        var total_sales = purchased_stock * selling_price;

                        var computeProfit = (selling_price - buying_price - trucking_fee - monthly_expenses);
                        var computeOverallProfit = (computeProfit * purchased_stock);

                        //show total and balance sales
                        $('#p-total-sales').text('₱' + __numberWithCommas(Number(total_sales).toFixed(1)));
                        $('#p-balance-sales').text('₱' + __numberWithCommas(Number(total_sales).toFixed(1)));

                        //show total capital and profit
                        $('#p-profit').text('₱' + __numberWithCommas(Number(computeProfit).toFixed(1)));
                        $('#p-overall-profit').text('₱' + __numberWithCommas(Number(computeOverallProfit).toFixed(1)));

                        //clear inputs
                        $("input").val('');

                        console.log("AJAX request was successful - action=INSERT");
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
    //get the active value
    print '
    <script type="text/javascript">
         var active;
         active = "'.$active.'";
    </script>';
    ?>
    <script type="text/javascript">
        $(document).ready(function()
        {
            function loadSearchData(query)
            {
                var level = <?php echo $level; ?>

                $.ajax({
                    url:"server-ajax/inventorysearchajax",
                    method:"post",
                    data:{query:query, level:level, active:active},
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
    <!--<script type="text/javascript" src="./js/mycart.js"></script>-->
    <script type="text/javascript">
      $(document).ready(function()
       {
        $(".input-quantity").focus(function()
        {
          $(this).removeClass('is-invalid');
          //text elements
          $('.transact-error').fadeOut();
          $('.transactCompute').text('').hide();
          //buttons
          $('.btn-checkout').show();
          $('.btn-transact-items').hide();
        });

        var cart = new Cart();

        _objElement.btnDel.click(function(e)
        {
          var itemId = $(this).attr("data-id");
          e.preventDefault();
          cart.delProduct(itemId);

          $.notify("Item removed", {position:"bottom left", autoHideDelay:"4000", className:"error"});

        });

        _objElement.btnCheckout.click(function(e) {
          e.preventDefault();
          cart.checkoutProduct();
        });

        //account user's ID
        var userID = <?php echo $userID; ?>

        _objElement.btnTransact.click(function(e) {
          e.preventDefault();
          cart.transactItems(userID);
        });

      });

      var _objElement = {
       btnAdd : $('.btn-add-item'),
       btnDel : $('.btn-del-item'),
       btnCheckout : $('.btn-checkout'),
       btnTransact : $('.btn-transact-items')
      };

      function Cart()
      {
        var objCookie = {
          getCookie : function() {
            return Cookies.get('product-item');
          },
          setCookie : function(cookieValue) {
            Cookies.set('product-item', cookieValue, { expires: 1 });
          },
          removeCookie : function() {
            Cookies.remove('product-item');
          },
          strSplit : '∎'
        };

        this.addProduct = function(itemId)
        {
          if(objCookie.getCookie() == null)
          {
            const addCookie = (function() {
              //create a new cookie
              objCookie.setCookie(objCookie.strSplit + itemId);
              console.log('a new cookie has been added! ' + objCookie.getCookie());
            });

            //init - addCookie
            return addCookie();

          } else {

            var updatedCookie = objCookie.getCookie();
            const splitCookie = objCookie.getCookie().split(objCookie.strSplit);

            var cookie = (function() {
              //find the existing item in a cookie array values
              for (var i = 1; i < splitCookie.length; i++) {
                if(splitCookie[i] == itemId) {
                  console.log(splitCookie[i] + ' exists!');
                  return false;
                }
              }
              return true;
            })();

            //if item value doesn't match
            if(cookie) {
              //update cookie value
              updatedCookie += objCookie.strSplit + itemId;
              Cookies.set('product-item', updatedCookie, { expires: 1 });
              console.log('updated cookie: ' + objCookie.getCookie());
            }
          }
        }

        this.delProduct = function(itemId)
        {
          if(objCookie.getCookie() != null)
          {
            var delCookie = (function()
            {
              var cookie = {
                cookieArr : [],
                cookieCounter : '',
                cookieNewValue : ''
              }

              //split a cookie array values
              var indexCookie = objCookie.getCookie().split(objCookie.strSplit);

              //find the existing item in a cookie array values
              for (var i = 0; i < indexCookie.length; i++) {
              //store item value to cookie.cookieArr
              cookie.cookieArr.push(indexCookie[i]);
                //if split item value matches with selected item
                if(indexCookie[i] == itemId) {
                  //delete specific array value if string matches
                  cookie.cookieArr.splice(cookie.cookieArr.indexOf(indexCookie[i]), 1);
                }
              }

              //iterate the updated array values
              for(var j = 0; j < cookie.cookieArr.length; j++) {
                //add each cookie item
                cookie.cookieCounter += cookie.cookieArr[j] + objCookie.strSplit;
              }

              //store item values and remove the last string (∎)
              cookie.cookieNewValue = cookie.cookieCounter.slice(0, -1);

              //update cookie values
              objCookie.setCookie(cookie.cookieNewValue);

              //if item cookie value is equal to one
              if(cookie.cookieNewValue.split(objCookie.strSplit).length == 1) {
                  //remove cookie
                  objCookie.removeCookie();
              }

              /*
              * dom manipulation
              */

              //remove TR's element
              $('#tr-id-' + itemId).remove();
              //remove td's element
              $('.transactCompute').text('').hide();
              //hide and show buttons
              $('.btn-checkout').show();
              $('.btn-transact-items').hide();

              //subtract total items
              $('#transactTotalItems').text(Number($('#transactTotalItems').text() - 1));

              console.log('updated cookie: ' + objCookie.getCookie());
              /*
              * end dom manipulation
              */
            });

            //init - delCookie
            return delCookie();
          }
        }

        this.checkoutProduct = function()
        {
          if(objCookie.getCookie() != null)
          {
            //alert(objCookie.getCookie())
            var checkout = (function() {
              var cookie = {
                cookieArr : [],
                cookieCounter : '',
                cookieNewValue : ''
              }

              var calc = {
                //description
                desc : '',
                //available stock
                qAvailableStock : '',
                //quantity item
                qItem : '',
                //quantity item [indexOf (.)]
                qItemIndexDot : '',
                //text - transact total items
                totalItems : '',
                totalPrice : 0,
                total : 0,
                //input - error quantity
                errorQuantity : 0,
                //input - error stock
                errorStock : 0
              }

              //split a cookie array values
              var indexCookie = objCookie.getCookie().split(objCookie.strSplit);

              /*
              * dom manipulation
              */

              //input validation for item quantity and item stock
              //find the existing item in a cookie array values
              for (var i = 1; i < indexCookie.length; i++)
              {
                //input - available stock
                calc.qAvailableStock = Number($('#q-available-stock-'+indexCookie[i]).val());
                //input - quantity
                calc.qItem = Number($('#q-item-'+indexCookie[i]).val());
                //find [.] in input quantity
                calc.qItemIndexDot = Number($('#q-item-'+indexCookie[i]).val().indexOf('.'));

                //validate
                if(calc.qItem == '' || calc.qItem == 0 || calc.qItem < 0 || calc.qItemIndexDot != -1)
                {
                  calc.errorQuantity++;
                  $('#q-item-'+indexCookie[i]).addClass('is-invalid');
                  $('.transact-error').fadeIn().text('Invalid input... please review the items.');
                }

                if(calc.qItem > calc.qAvailableStock)
                {
                  calc.errorStock++;
                  $('#q-item-'+indexCookie[i]).addClass('is-invalid');
                  $('.transact-error').fadeIn().text('Input > stock... please review the items.');
                }
              }

              //if input validations are successful
              //if there are no errors in checking #q-item id - [q!=(n.n..., 0,'','a-z,A-Z', '!@#$%^&*()~ and so on...')]
              //if input quantity is greater than a. stock
              if(calc.errorQuantity == 0 && calc.errorStock == 0)
              {
                //input validation for item quantity and item stock
                for (var i = 1; i < indexCookie.length; i++)
                {
                  //input - description
                  calc.desc = __ucwords(__strtolower($('#description-'+indexCookie[i]).val()));
                  //input - quantity item
                  calc.qItem = Number($('#q-item-'+indexCookie[i]).val());
                  //input - selling price
                  calc.sPrice = Number($('#selling-price-'+indexCookie[i]).val());
                  //input - total items
                  calc.totalItems = Number($('#transactTotalItems').text());

                  //compute total price
                  calc.totalPrice = calc.qItem * calc.sPrice;
                  //compute total
                  calc.total += calc.totalPrice;

                  $('.transactCompute').fadeIn().append(
                    '<p><strong>'+calc.desc+'</strong><br>Quantity: <strong>'+__numberWithCommas(calc.qItem)+'</strong><br>Selling price: <strong>₱'+__numberWithCommas(calc.sPrice)+'</strong><br>Total Price: <strong>₱'+__numberWithCommas(calc.totalPrice.toFixed(1))+'</strong><hr></p>');
                }

                $('.transactCompute').append('<strong><span style="color:#3742fa;">'+'Total: ₱'+__numberWithCommas(calc.total.toFixed(1))+'</span></strong><hr>');

                $('.transactCompute').append('<div class="mt-2 mb-2"><strong>OR Number:</strong><input type="number" id="transact-or-num" class="form-control" placeholder="OR Number..." style="width:140px;"></div>');

                //hide checkout button
                $('.btn-checkout').hide();
                //show transact button
                $('.btn-transact-items').fadeIn();
              }

              /*
              * end dom manipulation
              */

            });

            return checkout();
          }
        }

        this.transactItems = function(userID)
        {
          if(objCookie.getCookie() != null)
          {
            //alert(objCookie.getCookie())
            var transact = (function()
            {

              var cookie = {
                cookieArr : [],
                cookieCounter : '',
                cookieNewValue : ''
              };

              var salesReport = {
                //item_code
                itmCode : '',
                //description
                desc : '',
                //material type
                mType : '',
                //quantity item
                qItem : '',
                //buying price
                bPrice : '',
                //trukcing fee
                tFee : '',
                //monthly expenses
                mExpenses : '',
                //profit
                profit : '',
                //total profit
                tProfit : 0,
                //text - transact total items, total price, total
                totalItems : '',
                totalPrice : 0,
                total : 0
              };

              var insert = {
                cookieId : '',
                or_number : '',
                userId : '',
                item_code : '',
                description : '',
                material_type : '',
                quantity : '',
                selling_price : '',
                total_price : '',
                profit : '',
                total_profit : '',
                total : '',
                strSplit : '∎'
              }

              //split a cookie array values
              var indexCookie = objCookie.getCookie().split(objCookie.strSplit);

              /*
              * dom manipulation
              */

              var transactOrNum = Number($('#transact-or-num').val()),
              //find [.] in input or number
              transactOrNumIndexDot = Number($('#transact-or-num').val().indexOf('.'));

              //validate
              if(transactOrNum == '' || transactOrNum == 0 || transactOrNum < 0 || transactOrNumIndexDot != -1)
              {
                $('.transact-error').fadeIn().text('Invalid input...');
                //show input warning
                $('#transact-or-num').addClass('is-invalid');
                setTimeout(function()
                {
                  $('.transact-error').fadeOut();
                  //remove input warning
                  $('#transact-or-num').removeClass('is-invalid');
                }, 2500);
              }
              else
              {
                //disable the transact button
                $('.btn-transact-items').attr('disabled', 'disabled');
                $('.btn-transact-items').removeClass('btn-primary').addClass('btn-default');

                //input validation for item quantity and item stock
                for (var i = 1; i < indexCookie.length; i++)
                {
                  //input item_code
                  salesReport.itmCode = $('#item-code-'+indexCookie[i]).val();
                  //input description
                  salesReport.desc = __ucwords(__strtolower($('#description-'+indexCookie[i]).val()));
                  //input material Type
                  salesReport.mType = __ucwords(__strtolower($('#material-type-'+indexCookie[i]).val()));
                  //input - item quantity
                  salesReport.qItem = Number($('#q-item-'+indexCookie[i]).val());
                  //input - item selling price
                  salesReport.sPrice = Number($('#selling-price-'+indexCookie[i]).val());
                  //input - buying price
                  salesReport.bPrice = Number($('#buying-price-'+indexCookie[i]).val());
                  //input - trucking fee
                  salesReport.tFee = Number($('#trucking-fee-'+indexCookie[i]).val());
                  //input - monthly expenses
                  salesReport.mExpenses = Number($('#monthly-expenses-'+indexCookie[i]).val());
                  //compute profit
                  salesReport.profit = Number($('#profit-'+indexCookie[i]).val());

                  //compute total price
                  salesReport.totalPrice = salesReport.qItem * salesReport.sPrice;
                  //compute total profit
                  salesReport.tProfit = salesReport.qItem * salesReport.profit;
                  //compute total
                  salesReport.total += salesReport.totalPrice;

                  /*console.log('Description: ' + salesReport.desc);
                  console.log('Quantity: ' + salesReport.qItem);
                  console.log('Selling Price: ' + salesReport.sPrice.toFixed(1));
                  console.log('Total Price: ' + salesReport.totalPrice.toFixed(1));
                  console.log('Profit: ' + salesReport.profit);
                  console.log('Total Profit: ' + salesReport.tProfit.toFixed(1));
                  console.log('---------------------');*/

                  insert.item_code      += insert.strSplit + salesReport.itmCode;
                  insert.description    += insert.strSplit + salesReport.desc;
                  insert.material_type  += insert.strSplit + salesReport.mType;
                  insert.quantity       += insert.strSplit + salesReport.qItem;
                  insert.selling_price  += insert.strSplit + salesReport.sPrice.toFixed(1);
                  insert.total_price    += insert.strSplit + salesReport.totalPrice.toFixed(1);
                  insert.profit         += insert.strSplit + salesReport.profit;
                  insert.total_profit   += insert.strSplit + salesReport.tProfit.toFixed(1);

                }
                //console.log('Total: ' + salesReport.total.toFixed(1));

                insert.total = salesReport.total.toFixed(1);
                insert.userId = userID;
                insert.or_number = transactOrNum;
                insert.cookieId = objCookie.getCookie();

                //please wait
                $('.wrapper-please-wait').show();
                $('.please-wait').show();

                $.ajax({
                    url: "server-ajax/transactajax",
                    type: "POST",
                    data: {cookie_id: insert.cookieId, item_code: insert.item_code, or_number: insert.or_number, description: insert.description, material_type: insert.material_type, quantity: insert.quantity, selling_price: insert.selling_price, total_price: insert.total_price, profit: insert.profit, total_profit: insert.total_profit, total: insert.total, userId: insert.userId},
                    success: function() {
                        //hide please wait
                        $('.wrapper-please-wait').hide();
                        $('.please-wait').hide();
                        //show successful message
                        $('.transact-success').fadeIn().html('<span style="color:#16a085;"><strong>Transaction was successful</strong></span>');
                        //disable or number
                        $('#transact-or-num').attr('disabled', 'disabled');
                        //disable input quantity
                        $('.input-quantity').attr('disabled', 'disabled');
                        //disable del item
                        $('.btn-del-item').removeClass('btn-danger').addClass('btn-default').attr('disabled', 'disabled');
                        //notify
                        $.notify("Transaction was successful!", {position:"bottom left", autoHideDelay:"4000", className:"success"});

                        //remove cookie
                        Cookies.remove('product-item');

                        console.log("AJAX request was successful - action=INSERT");
                    },
                    complete: function(data) {
                        console.log("AJAX request was completed - action=INSERT");
                    },
                    error:function(){
                        console.log("AJAX request was a failure - action=INSERT");
                    }
                });

              }
              /*
              * end dom manipulation
              */
            });

            return transact();
          }
        }
      }
    </script>

<?php
        else:
            require_once 'login-form.php';
        endif;
?>

</body>
</html>
