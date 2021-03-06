<?php
/*
* a copy of product transaction's source code - cart
* Return items / Refundables - cartReturn
*/

require_once './auth.php';

use app\data\returnitems\ReturnItemsAddItem;
use app\controller\accounts\AccountsAdminInfoController;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();
//get user's ID
$userID = $accountData->getData('Id');

$returnItems = ReturnItemsAddItem::Create();
$returnItems->readData();

?>
<script type="text/javascript">
  $(document).ready(function()
   {
    $("#schedDate").focus(function()
    {
      $(this).removeClass('is-invalid');
    });

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
   btnAdd : $('.btn-return-item'),
   btnDel : $('.btn-del-item'),
   btnCheckout : $('.btn-checkout'),
   btnTransact : $('.btn-transact-items')
  };

  function Cart()
  {
    var objCookie = {
      getCookie : function() {
        return Cookies.get('return-product-item');
      },
      setCookie : function(cookieValue) {
        Cookies.set('return-product-item', cookieValue, { expires: 1 });
      },
      removeCookie : function() {
        Cookies.remove('return-product-item');
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
          Cookies.set('return-product-item', updatedCookie, { expires: 1 });
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

          console.log('Return items');
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

          //check if date is empty
          if($('#schedDate').val() == '' || $('#schedDate').val().includes('/') == false)
          {
            $('#schedDate').addClass('is-invalid');
            $('.transact-error').fadeIn().text('Date field is empty!');
          } else {
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

            /*
            if(calc.qItem > calc.qAvailableStock)
            {
              calc.errorStock++;
              $('#q-item-'+indexCookie[i]).addClass('is-invalid');
              $('.transact-error').fadeIn().text('Input > stock... please review the items.');
            }
            */
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
            sched_date : $('#schedDate').val(),
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
                url: "server-ajax/returnitemsajax",
                type: "POST",
                data: {cookie_id: insert.cookieId, item_code: insert.item_code, or_number: insert.or_number, description: insert.description, material_type: insert.material_type, quantity: insert.quantity, selling_price: insert.selling_price, total_price: insert.total_price, profit: insert.profit, total_profit: insert.total_profit, total: insert.total, userId: insert.userId, sched_date: insert.sched_date},
                success: function() {
                    //hide please wait
                    $('.wrapper-please-wait').hide();
                    $('.please-wait').hide();
                    //show successful message
                    $('.transact-success').fadeIn().html('<span style="color:#16a085;"><strong>Return items was successful</strong></span>');
                    //disable date
                    $('#schedDate').attr('disabled', 'disabled');
                    //disable or number
                    $('#transact-or-num').attr('disabled', 'disabled');
                    //disable input quantity
                    $('.input-quantity').attr('disabled', 'disabled');
                    //disable del item
                    $('.btn-del-item').removeClass('btn-danger').addClass('btn-default').attr('disabled', 'disabled');
                    //notify
                    $.notify("Return items was successful!", {position:"bottom left", autoHideDelay:"4000", className:"success"});

                    //remove cookie
                    Cookies.remove('return-product-item');

                    console.log('Return items');
                    console.log("AJAX request was successful - action=INSERT");
                },
                complete: function(data) {

                    console.log('Return items');
                    console.log("AJAX request was completed - action=INSERT");
                },
                error:function(){

                    console.log('Return items');
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

  function datePicker() {
    $('#schedDate').datepicker({
      //prevText: "Earlier"
    });

  }
  datePicker();
</script>

<?php

else:
    require_once 'login-form.php';
endif;

?>
