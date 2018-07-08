<?php

require_once './auth.php';

use app\data\transaction\TransactionAddItem;

if($auth) :

$transac = TransactionAddItem::Create();
$rows = $transac->readData();

echo $rows;

else:
    require_once 'login-form.php';
endif;

?>
<script type="text/javascript">
  $(document).ready(function()
   {
     

    //init tooltip
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    });

    var cart = new Cart();

    _objElement.btnDel.click(function()
    {
      var itemId = $(this).attr("data-id");
      cart.delProduct(itemId);
    });

    _objElement.btnCheckout.click(function() {
      cart.checkoutProduct();
    });

    if(Cookies.get('product-item') == null)
    {
      $('.h-class').fadeIn();
    }
    else
    {
      $('.h-class').hide();
    }

  });

  var _objElement = {
    btnDel : $('.btn-del-item'),
    btnCheckout : $('.btn-checkout')
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

          //remove TR's element
          $('#tr-id-' + itemId).remove();

          console.log('updated cookie: ' + objCookie.getCookie());

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

          //split a cookie array values
          var indexCookie = objCookie.getCookie().split(objCookie.strSplit);

          var qItemcounter = 0;
          //find the existing item in a cookie array values
          for (var i = 1; i < indexCookie.length; i++)
          {

            /* I stopped here */
            //alert($('#q-item-'+indexCookie[i]).val());
            alert('Check out!')

            //console.log(indexCookie[i]);
          //store item value to cookie.cookieArr
          //cookie.cookieArr.push(indexCookie[i]);
            //if split item value matches with selected item
            //if(indexCookie[i] == itemId) {
              //delete specific array value if string matches
              //cookie.cookieArr.splice(cookie.cookieArr.indexOf(indexCookie[i]), 1);
            //}
          }
        });

        return checkout();
      }
    }
  }


</script>
