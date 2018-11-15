<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt_br">

<head>
  <title><?php echo getenv('APP_SYSTEM_NAME'); ?> | Entrar</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="\assets/img/icons/favicon.png" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="\assets/css/admin/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="\assets/css/login/util.css">
  <link rel="stylesheet" type="text/css" href="\assets/css/login/login.css">
</head>

<body style="background-color: #666666;">
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" action="/login" method="post"><span class="login100-form-title p-b-43">Entre
            no <?php echo getenv('APP_SYSTEM_NAME'); ?></span>
          <div class="form-group"><label class="bmd-label-floating">Usuário</label><input type="text" class="form-control" name="login" required></div>
          <div class="form-group"><label class="bmd-label-floating">Senha</label><input type="password" class="form-control" name="password" required></div>
          <?php if( $_SESSION['login_err'] ){ ?>
          <p class="text-center text-danger"><?php echo htmlspecialchars( $_SESSION['login_err'], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          <?php } ?>
          <div class="container-login100-form-btn"><button class="btn btn-primary btn-lg">Entrar</button></div>
        </form>
        <div class="login100-more" style="background-image: url('\\assets/img/login/bg-01.jpg');"></div>
      </div>
    </div>
  </div>
  <script src="\assets/js/admin/core/jquery.min.js" type="text/javascript"></script>
  <script src="\assets/js/admin/core/popper.min.js" type="text/javascript"></script>
  <script src="\assets/js/login/login.js"></script>
</body>

</html>