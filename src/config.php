<?php

// Configs
session_start();
require_once("libs/autoload.php");
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utl-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

// Variáveis de ambiente
// Variáveis da aplicação
define('APP_NAME', getenv('APP_NAME'));
define('APP_SYSTEM_NAME', getenv('APP_SYSTEM_NAME'));
define('APP_URL', getenv('APP_URL'));
define('APP_VERSION', getenv('APP_VERSION'));
define('PRODUCTION_MODE', getenv('PRODUCTION_MODE'));

// Variáveis MySQL
define('MYSQL_USER', getenv('MYSQL_USER'));
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD'));
define('MYSQL_ROOT_PASSWORD', getenv('MYSQL_ROOT_PASSWORD'));
define('MYSQL_DATABASE', getenv('MYSQL_DATABASE'));
define('DBHOST', getenv('DBHOST'));

// Variáveis de e-mail
define('MAIL_USERNAME', getenv('MAIL_USERNAME'));
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD'));
define('MAIL_PORT', getenv('MAIL_PORT'));

?>