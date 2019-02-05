<?php

if(!isset($_COOKIE['e1ee8d72a7a553f68c2ce3beb7ad19c9'])) :
    require_once './frontend-ui/password.php';
    //init pin lock
    Password::Create();
    //prevent displaying the main page
    die();
endif;

$token = bin2hex(openssl_random_pseudo_bytes(16));
setcookie("CSRFtoken", $token, time() + 60 * 60 * 24);

use app\controller\accounts\AccountsAdminLoginController;

$login = AccountsAdminLoginController::Create();

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
    <link rel="stylesheet" type="text/css" href="./css/sign-in.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Google Font -->
    <!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">-->

    <title>System Name 8c7v45b6n7m8d12a2nh16hfsw12l0da1</title>
  </head>
  <body class="text-center">
    <form class="form-signin" action="" method="POST">
        <h2 class="pt-4 pb-4"><img src="img/logo1.png" class="img-fluid" alt="Logo"></h2>
        <div class="checkbox mb-3">
            <!--<label class="forgot-account">-->
              <!--<a href="#">Forgot Account?</a>-->
              <div class="text-center">
                  <?= $login->login('username', 'password', 'CSRFtoken'); ?>
              </div>
            <!--</label>-->
        </div>
        <label for="inputUsername" class="sr-only">Username address</label>
        <input type="text" id="inputUsername" class="form-control mb-3 active" name="username" placeholder="Username" autocomplete="off" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <input name="CSRFtoken" type="hidden" value="<?=$token;?>">

        <button class="btn btn-lg btn-info btn-block" type="submit" name="sub"><i class="fa fa-sign-in-alt"></i> Log In</button>

        <p class="mt-5 mb-3 text-muted">&copy; 2018 </p>
    </form>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
  </body>
</html>
