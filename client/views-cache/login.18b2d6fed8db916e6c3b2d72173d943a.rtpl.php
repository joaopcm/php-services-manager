<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="en">
<head>
	<title>CVA Clientes</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="\res\img/icon.png"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link href="\assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="\res\css/util.css">
	<link rel="stylesheet" type="text/css" href="\res\css/login.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
					<span class="login100-form-title-1">
						Cva Clientes
					</span>
				</div>
				<form action="/login" method="post" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Usuário é obrigatório">
						<span class="label-input100">Usuário</span>
						<input class="input100" type="text" name="login" placeholder="Digite seu usuário">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Senha é obrigatória">
						<span class="label-input100">Senha</span>
						<input class="input100" type="password" name="password" placeholder="Digite sua senha">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="\assets/js/core/jquery.min.js" type="text/javascript"></script>
	<script src="\assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="\assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
	<script src="\res\js/login.js"></script>

</body>
</html>