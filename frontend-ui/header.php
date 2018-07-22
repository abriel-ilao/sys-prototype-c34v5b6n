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

    //logo
    $logoName = 'Logo';

    //menu focus
    $main_menu = 'active active-highlight';
    $m_main_menu = 'm-menu-li-selected';

    if ($active == 1) {
        $item1 = $main_menu;
        $m_item1 = $m_main_menu;
    }
    if ($active == 2) {
        $item2 = $main_menu;
        $m_item2 = $m_main_menu;
    }
    if ($active == 3) {
        $item3 = $main_menu;
        $m_item3 = $m_main_menu;
    }
    if ($active == 4) {
        $item4 = $main_menu;
        $m_item4 = $m_main_menu;
    }
    //!active
    if($active == 0) {
        $item1 = '';
        $item2 = '';
        $item3 = '';
        $item4 = '';
        $m_item1 = '';
        $m_item2 = '';
        $m_item3 = '';
        $m_item4 = '';
    }
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <title>System Name</title>
  </head>
  <body style="background-color:#f5f5f5;">
    <div id="scroll-top" style="display:none;"></div>
    <div class="wrapper-please-wait">
        <div class="please-wait">
            <span style="float:left;"><img src="./img/34.gif" width="32" height="32"></span>
            <span style="float:right;"> Please wait...</span>
        </div>
    </div>

    <header class="header-main">
        <div class="container-fluid header-bg">
            <div class="row pt-2 pb-2">
                <div class="col-12 col-md-2">
                    <div class="logo-brand">
                        <a class="navbar-brand" href="pos" style="color:#006266;"><strong><?= $logoName; ?></strong></a>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <?php if($level == 1 || $level == 2): ?>
                    <div class="inventory-item-notificaton-num float-left"></div><div class="inventory-item-notification-text float-left"><a href="notify" class="show-please-wait">Item(s)</a></div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-8">
                    <div class="account-menu text-right">
                        <ul>
                            <li class="m-user-admin"><span class="user-admin"><i class="fa fa-user-shield"></i></span> <a href="#" data-toggle="modal" data-target="#modalAccountInfo"><?=$fname.' '.$sname;?></a> </li>
                            <li><a href="changepass" class="show-please-wait"><i class="fa fa-edit"></i> Change Password</a> </li>
                            <li><a href="logout.php" class="show-please-wait"><i class="fa fa-sign-out-alt"></i> Log Out</a></li>
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

                <?php if($level == 1 || $level == 2) : ?>
                <li class="nav-item <?=@$item1;?>">
                    <a class="nav-link show-please-wait" href="#"><i class="fa fa-calculator"></i> SALES REPORT</a>
                </li>
                <?php endif; ?>
                <li class="nav-item <?=@$item2;?>">
                    <a class="nav-link show-please-wait" href="pos"><i class="fa fa-shopping-bag"></i>
                        <?php if($level == 1 || $level == 2) : ?>
                            INVENTORY
                        <?php endif; ?>
                        <?php if($level == 3) : ?>
                            POINT OF SALE <!--<span class="sr-only">(current)</span>-->
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item <?=@$item3;?>">
                    <a class="nav-link show-please-wait" href="transactionlog"><i class="fa fa-desktop"></i> TRANSACTION LOG</a>
                </li>
                <?php if($level == 1) : ?>
                <li class="nav-item <?=@$item4;?>">
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
        <div class="modal-dialog modal-dialog-user-account" role="document">
            <div class="modal-content modal-content-user-account">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Account Information</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body admin-modal-body">
                    <div class="row no-gutters">
                        <div class="col-6 text-right">
                            <div class="modal-txt">First name:</div>
                            <div class="modal-txt">Last name:</div>
                            <div class="modal-txt">Email:</div>
                            <div class="modal-txt">Level:</div>
                        </div>
                        <div class="col-6 text-left">
                            <div class="modal-txt m-txt"><?= $fname; ?></div>
                            <div class="modal-txt m-txt"><?= $sname; ?></div>
                            <div class="modal-txt m-txt"><?= $email; ?></div>
                            <div class="modal-txt m-txt"><?= $levelType; ?></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>

    <header class="m-header-main">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="m-logo-wrapper text-left">
                         <a href="pos"><strong><?= $logoName; ?></strong></a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="m-navicon-wrapper text-right">
                        <a href="#!" class="navicon-icon"><i class="fa fa-bars" style="font-size:25px;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <header class="m-nav">
        <div class="container m-header-account">
            <div class="row">
                <div class="col-12">
                    <div class="m-header-account-circle m-header-account-circle-bg-<?= rand(1, 10); ?>"><?= substr($fname, 0, 1); ?></div>
                    <ul class="m-header-account-info">
                        <li><strong><?=$fname.' '.$sname.' </strong> ('.$levelType.')';?></li>
                        <li><?=$email;?></li>
                        <li><a href="changepass">Change Password</a> &nbsp; <span style="color:#636e72;">|</span> &nbsp; <a href="logout.php">Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if($level == 1 || $level == 2): ?>
        <div class="container m-header-item">
            <div class="row">
                <div class="col-12">
                    <div class="inventory-item-notificaton-num float-left"></div><div class="inventory-item-notification-text float-left"><a href="notify" class="show-please-wait"><strong>Item(s)</strong></a></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="container m-header-main-menu">
            <div class="row">
                <div class="col-12">
                    <ul class="m-header-main-menu-list">
                        <?php if($level == 1 || $level == 2): ?>
                        <li class="m-header-main-menu-li"><i class="fa fa-calculator text-info"></i><span style="padding-left:26px;">SALES REPORT</span></li>
                        <?php endif; ?>
                        <?php if($level == 1 || $level == 2) : ?>
                        <li class="m-header-main-menu-li m-header-main-menu-li-inventory">
                            <i class="fa fa-shopping-bag text-primary"></i><span style="padding-left:26px;">INVENTORY &nbsp;<i class="fa fa-caret-right fa-inventory-toggle"></i></span>
                            <ul class="m-header-main-menu-list-sub m-header-main-menu-list-sub-inventory">
                                <li class="m-header-main-menu-li-sub"><span style="padding-left:24px;"><i class="fa fa-cart-arrow-down text-info" style="font-size:12px;"></i>&nbsp; Add Item</span></li>
                                <li class="m-header-main-menu-li-sub"><span style="padding-left:24px;"><i class="fa fa-tag text-secondary" style="font-size:12px;"></i>&nbsp; View Items</span></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($level == 3) : ?>
                        <li class="m-header-main-menu-li m-header-main-menu-li-point-of-sale">
                            <i class="fa fa-shopping-bag text-primary"></i><span style="padding-left:26px;">POINT OF SALE &nbsp;<i class="fa fa-caret-right fa-inventory-toggle"></i></span>
                            <ul class="m-header-main-menu-list-sub m-header-main-menu-list-sub-point-of-sale">
                                <li class="m-header-main-menu-li-sub"><span style="padding-left:16px;"><i class="fa fa-cart-arrow-down text-info" style="font-size:12px;"></i>&nbsp; Product Transaction</span></li>
                                <li class="m-header-main-menu-li-sub"><span style="padding-left:16px;"><i class="fa fa-tag text-secondary" style="font-size:12px;"></i>&nbsp; View Items</span></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li class="m-header-main-menu-li m-header-main-menu-li-transaction-log"><i class="fa fa-desktop text-danger"></i><span style="padding-left:21px;">TRANSACTION LOG</span></li>
                        <?php if($level == 1): ?>
                        <li class="m-header-main-menu-li">&nbsp;<i class="fa fa-user text-warning"></i><span style="padding-left:21px;">ACCOUNTS</span></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-outline-light btn-sm m-btn-close mt-3"><i class="fa fa-window-close"></i> Close</button>
                </div>
            </div>
        </div>
    </header>

    <div class="m-transparent-panel">&nbsp;</div>

<?php }

} ?>
