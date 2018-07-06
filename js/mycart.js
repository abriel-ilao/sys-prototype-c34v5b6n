$(document).ready(function()
 {
  var cart = new Cart();

  _objElement.btnAdd.click(function()
  {
    var itemId = $(this).attr("data-id");
    cart.addProduct(itemId);
  });

  _objElement.btnDel.click(function()
  {
    //cart.delProduct();
  });
});

var _objElement = {
  btnAdd : $('.btn-add-item'),
  btnDel : $('#btn-del-143')
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
        objCookie.setCookie(objCookie.strSplit + __strtolower(itemId));
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
          if(splitCookie[i] == __strtolower(itemId)) {
            console.log(splitCookie[i] + ' exists!');
            return false;
          }
        }
        return true;
      })();

      //if item value doesn't match
      if(cookie) {
        //update cookie value
        updatedCookie += objCookie.strSplit + __strtolower(itemId);
        Cookies.set('product-item', updatedCookie, { expires: 1 });
        console.log('updated cookie: ' + objCookie.getCookie());
      }
    }
  }

  this.delProduct = function()
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
          if(indexCookie[i] == __strtolower(_objElement.id)) {
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

        console.log('updated cookie: ' + objCookie.getCookie());

      });

      //init - delCookie
      return delCookie();
    }
  }
}
