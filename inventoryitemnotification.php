<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\accounts\AccountsChangePass;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//get user's level
$level = $accountData->getData('level');

//active navigation
$active = '0';

//init header with one parameter
Header::Create($active);

?> 

    <div class="search-pos mb-2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="h6 mt-2"><i class="fa fa-tag"></i> Item Notification</h1>
                </div>
                <div class="col-12 col-md-6">
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
        <div class="row">
           <div class="col-12">                
                <div class="inventory-item-notification">                   
                </div> 
           </div>
        </div>
    </div>
<?php

Footer::Create();

?>

<script type="text/javascript">
    $(document).ready(function() {
        itemNotification();
    });
    function itemNotification() {
        return (function worker() {
            $.ajax({
                url: 'server-ajax/inventoryitemnotificationajax',
                success: function(data) {
                  $('.inventory-item-notification').html(data);
                },
                complete: function() {
                  // Schedule the next request when the current one's complete
                  setTimeout(worker, 3000);
                }
            });
        })();  
    }
</script>

<?php

else: 
    require_once 'login-form.php';
endif; 

?> 
   
</body>
</html>