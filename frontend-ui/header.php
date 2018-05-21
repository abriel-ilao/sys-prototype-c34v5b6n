<?php 

use app\controller\accounts\AccountsAdminInfoController;

class Header {
    public static function Create($active) { return new Header($active); }   
    public function __clone() {}
    public function __construct($active) {

    //init user's info controller
    $accountData = AccountsAdminInfoController::Create();

    //init anti XSS HTMLPurifier
    $purifier = new HTMLPurifier();

    //user's firstname and surname
    $fname = ucwords(strtolower($purifier->purify($accountData->getData('firstname'))));
    $sname = ucwords(strtolower($purifier->purify($accountData->getData('surname'))));
    $email = $accountData->getData('email');

    //get user's level
    $level = $accountData->getData('level');

    ($level == 1) ? $levelType = 'Super Admin' : null;
    ($level == 2) ? $levelType = 'User Admin' : null;
    ($level == 3) ? $levelType = 'Cashier' : null;
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    
    <!-- Style Media Queries CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style-media-queries.css">

    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.css">

    <!-- Google Font -->
    <!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">--> 

    <title>System Name</title>
  </head>
  <body style="background-color:#f5f5f5;">
    <div class="wrapper-please-wait">
        <div class="please-wait">
            <span style="float:left;"><img src="./img/34.gif" width="32" height="32"></span>
            <span style="float:right;"> Please wait...</span>
        </div>
    </div>

    <header> 
        <div class="container-fluid header-bg">
            <div class="row pt-2 pb-2">
                <div class="col-12 col-md-2">
                    <div class="logo-brand">
                        <a class="navbar-brand" href="#" style="color:#006266;">Logo</a>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="logo-brand">
                        <div class="inventory-item-notificaton-num float-left"></div><div class="inventory-item-notification-text float-left"><a href="notify" class="show-please-wait">Item(s)</a></div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="account-menu text-right">
                        <ul>
                            <li class="m-user-admin"><span class="user-admin"><i class="fa fa-user"></i></span> <a href="#" data-toggle="modal" data-target="#modalAccountInfo"><?=$fname.' '.$sname;?></a> </li>
                            <li><a href="changepass" class="show-please-wait"><i class="fa fa-edit"></i> Change Password</a> </li>
                            <li><a href="logout.php" class="show-please-wait"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>  
        </div>
        <nav class="navbar navbar-expand-md navbar-dark mb-4 nav-main-menu">      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">

                <?php 
                    $a = 'active active-highlight';
                    
                    ($active == 1) ? $item1 = $a : null;
                    ($active == 2) ? $item2 = $a : null;
                    ($active == 3) ? $item3 = $a : null;
                    ($active == 4) ? $item4 = $a : null;
                    
                    if($active == 0) {
                        $item1 = '';
                        $item2 = '';
                        $item3 = '';
                        $item4 = '';
                    }
                ?>

                <li class="nav-item <?=$item1;?>">
                    <a class="nav-link show-please-wait" href="pos"><i class="fa fa-shopping-bag"></i> 
                        <?php if($level == 1 || $level == 2) : ?>
                            INVENTORY
                        <?php endif; ?>   
                        <?php if($level == 3) : ?>
                            POINT OF SALE <!--<span class="sr-only">(current)</span>-->
                        <?php endif; ?> 
                    </a>
                </li>
                <?php if($level == 1 || $level == 2) : ?>
                <li class="nav-item">
                    <a class="nav-link show-please-wait" href="#"><i class="fa fa-calculator"></i> SALES REPORT</a>
                </li>
                <?php endif; ?>

                <?php if($level == 1) : ?>
                <li class="nav-item">
                    <a class="nav-link show-please-wait" href="#"><i class="fa fa-desktop"></i> ACCT. ACTIVITY LOG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link show-please-wait" href="#"><i class="fa fa-user"></i> ACCOUNTS</a>
                </li>
                <?php endif; ?>
                <!--<li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
                </li>-->
            </ul>           
          </div>
        </nav>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="modalAccountInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Account Information</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-6 text-right">
                            <div class="modal-txt">First name:</div> 
                            <div class="modal-txt">Last name:</div> 
                            <div class="modal-txt">Email:</div> 
                            <div class="modal-txt">Level:</div> 
                        </div>
                        <div class="col-6 text-left">
                            <div class="modal-txt"><?= $fname; ?></div> 
                            <div class="modal-txt"><?= $sname; ?></div> 
                            <div class="modal-txt"><?= $email; ?></div> 
                            <div class="modal-txt"><?= $levelType; ?></div> 
                        </div>
                    </div>                     
                </div>
                <!--<div class="modal-footer">                
                    <button type="button" data-id="modalAccountInfo" class="btn-delete-item btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal"></button>
                </div>-->
            </div>
        </div>
    </div>

<?php }

} ?>

