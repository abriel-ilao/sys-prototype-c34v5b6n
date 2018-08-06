<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\accounts\Accounts;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//account
$accounts = Accounts::Create();

//get user's level
$level = $accountData->getData('level');

//active navigation
$active = '5';

//init header with one parameter
Header::Create($active);

?>
	<div class="header-pad">
		<div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="h6 mt-2"><i class="fa fa-user"></i> Accounts</h1>
            </div>
        </div>
    </div>
	</div>

    <div class="header-sub mb-2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="h6 mt-2"><i class="fa fa-user"></i> Accounts</h1>
                </div>
                <div class="col-12 col-md-6">
                </div>
            </div>
        </div>
    </div>

    <div class="container panel-x">
			<?php if($level == 1 || $level == 2) : ?>
	  		<div class="row">
	        <div class="col-12">
	          <div id="accordion-1" class="accordion m-2">
	            <div class="card">
	              <div class="card-header" id="reg">
	                <h5 class="mb-0">
	                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#reg_account" aria-expanded="false" aria-controls="reg_account">
	                    <strong><span class="text-info">Registered Accounts</span></strong>
	                  </button>
	                </h5>
	              </div>
	              <div id="reg_account" class="collapse" aria-labelledby="reg" data-parent="#accordionExample">
	                <div class="card-body">
										<?= $accounts->accounts(); ?>
	                </div>
	              </div>
	            </div>
	          </div>

	          <div id="accordion-1" class="accordion m-2">
	            <div class="card">
	              <div class="card-header" id="last_login">
	                <h5 class="mb-0">
	                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#acc_last_login" aria-expanded="false" aria-controls="acc_last_login">
	                    <strong><span class="text-info">Account's Last Login</span></strong>
	                  </button>
	                </h5>
	              </div>
	              <div id="acc_last_login" class="collapse" aria-labelledby="last_login" data-parent="#accordionExample">
	                <div class="card-body">
	                  <?= $accounts->lastLogin(); ?>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	  		</div>
			<?php endif; ?>
    </div>
<?php

Footer::Create();

?>

<?php

else:
    require_once 'login-form.php';
endif;

?>

</body>
</html>
