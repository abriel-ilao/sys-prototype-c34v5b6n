<?php
class Password {
    public static function Create() { return new Password; }
    public function __clone() {}
    public function __construct() {
   // echo md5('0000027361728374');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

</head>
<body>
    <div class="container">
      <div class="row text-center mt-2">
          <div class="col-12">
              <button type="button" class="btn btn-danger btn-sm" id="nClear">Clear</button>
              <span id="msg" style="font-size:17px;"></span>
          </div>
      </div>
      <div class="row text-center">
          <div class="col-12 mb-2 p-2">
              <div id="pword" style="border:1px solid gray;margin:0px auto;width:200px;font-size:25px;">&nbsp;</div>
          </div>
      </div>
      <div class="row text-center">
          <div class="col-12 p-1">
              <button type="button" class="btn btn-info btn-lg" id="n7">7</button>
              <button type="button" class="btn btn-info btn-lg" id="n8">8</button>
              <button type="button" class="btn btn-info btn-lg" id="n9">9</button>
          </div>
          <div class="col-12 p-1">
              <button type="button" class="btn btn-info btn-lg" id="n4">4</button>
              <button type="button" class="btn btn-info btn-lg" id="n5">5</button>
              <button type="button" class="btn btn-info btn-lg" id="n6">6</button>
          </div>
          <div class="col-12 p-1">
              <button type="button" class="btn btn-info btn-lg" id="n1">1</button>
              <button type="button" class="btn btn-info btn-lg" id="n2">2</button>
              <button type="button" class="btn btn-info btn-lg" id="n3">3</button>
          </div>
          <div class="col-12 p-1">
              <button type="button" class="btn btn-info btn-lg" id="n0">0</button>
              <button type="button" class="btn btn-primary btn-lg" id="nEnter">Enter</button>
          </div>
      </div>
      <div class="row">
          <div class="col-12 text-center">
              <div id="hpword" style="visibility:hidden;"></div>
          </div>
      </div>
    </div>
</body>

<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.gesture.password.min.js"></script>
<script type="text/javascript" src="./js/gibberish-aes.min.js"></script>
<script type="text/javascript" src="./js/md5.js"></script>
<script type="text/javascript" src="./js/sha256.js"></script>
<script type="text/javascript" src="./js/js.cookie.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        var str1 = $('#pword').text().replace(/By:/g, ''),
            str2 = $('#hpword').text().replace(/By:/g, ''),
            pword = $('#pword'),
            hpword = $('#hpword'),
            msg = $('#msg');

        var nClear = $('#nClear'),
            nEnter = $('#nEnter');

        $(nEnter).click(function()
        {
            __encrypt(hpword.text(), msg, nClear, nEnter);
            pword.text(str1);
            hpword.text(str2);
            nClear.css({visibility : "hidden"});
            nEnter.attr('disabled', 'disabled');
        });

        for(i=0; i<=9; i++) {
            __btn(i, pword, hpword);
        }

        __btnClear(pword, hpword, str1, str2);
    });

    function __btn(n, pword, hpword) {
        $('#n' + n).click(function(e) {
            e.preventDefault();
            pword.append('•');
            hpword.append(n);
        });
    }

    function __btnClear(pword, hpword, str1, str2) {
        $(nClear).click(function() {
           pword.text(str1);
           hpword.text(str2);
        });
    }

    function __encrypt(password, msg, nClear, nEnter) {
        let result;
        let x = md5(password);
        let xx = sha256(x);
        let encrypt_x = GibberishAES.enc(xx, "ultra-strong-password");
        let decrypt_x = GibberishAES.dec(encrypt_x, "ultra-strong-password");
        let decrypt_y = GibberishAES.dec("U2FsdGVkX1/h6clLiy088UGEbvZWHjWMu3S6tjgT2nUer3V6QLup527FgmdSCyTGJ0YsrUWWR6NVGle/eiMqi6A3bm3b3qNL5gwQAWmp0bXHGILZB4c1XKq7R7pSDL0K", "ultra-strong-password");

        if(decrypt_x == decrypt_y)
        {
            result=true;
            __cookie(result, msg, nClear, nEnter, x);
        } else {
            result=false;
            __cookie(result, msg, nClear, nEnter, x);
        }
    }

    function __cookie(result, msg, nClear, nEnter, x)
    {
        let cookieVal = GibberishAES.enc('Q2D5BNVkX13Bo3A7+YErctSGuX3F0J0c5VsCQEcba8Y=', "ultra-strong-password");

        if(result)
        {
            msg.show();
            msg.text('Success!');
            msg.css({color: 'green'});
            setTimeout(function() {
              msg.hide();
            }, 10000);
            Cookies.set(x, cookieVal, { expires: 130 });
            window.location.replace('pos');
        } else
        {
            msg.show();
            msg.text('Incorrect Password!');
            msg.css({color: 'red'});
            setTimeout(function() {
              msg.hide();
              nClear.css({visibility: 'visible'});
              nEnter.removeAttr('disabled');
            }, 2500);
            Cookies.remove(x);
        }
    }
</script>
</html>

<?php }} ?>
