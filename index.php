<?php

/*
* REST API que gerencia todas as rotas da
* aplicação e suas funções via GET ou POST
*/

# Inicia uma sessão
session_start();

# Desabilita os warnings reports
error_reporting(E_CORE_WARNING);

# Autoload
require_once("vendor/autoload.php");

# Set locale
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utl-8', 'portuguese');

# Timezone
date_default_timezone_set('America/Sao_Paulo');

# Namespaces
use \Slim\Slim;
use \Root\Page;
use \Root\PageAdmin;
use \Root\Model\User;
use \Root\Model\Clientes;

# Slim instance
$app = new Slim();
$app->config("debug", true);

# Página principal
$app->get("/", function() {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("index");

});

# Lista de clientes
$app->get("/clientes", function(){

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("clientes");

});

# Página de login
$app->get("/login", function() {

    if (isset($_SESSION["User"]))
    {

        header("Location: /");

        exit;

    }

    $page = new PageAdmin([
        "header" => false,
        "footer" => false
    ]);

    $page->setTpl("login");

});

# Método POST de login
$app->post("/login", function() {

    $user = new User();

    if ($user->login($_POST["login"], $_POST["password"]) === "OK")
    {

        header("Location: /");

        exit;
    
    } elseif ($user->login($_POST["login"], $_POST["password"]) === 1) {

        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);

        $page->setTpl("login");

        echo '<script language="javascript">';
        echo '$("#error-message").append("Dados de acesso inválidos")';
        echo '</script>';

    }

});

# Método GET de logout
$app->get("/logout", function() {

    User::logout();

    header("Location: /");

    exit;

});

# Página de criação de clientes
$app->get("/adicionar/clientes", function() {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("adicionar-cliente");

});

# Página de edição de clientes
$app->get("/editar/cliente/:id", function($id) {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("editar-militante");

});

# Método POST de adicionar cliente
$app->post("/adicionar/cliente", function() {

    User::verifyLogin();

    header("Location: /militantes");

    exit;

});

# Método POST de editar clientes
$app->post("/editar/cliente/:id", function($id) {

    User::verifyLogin();

    header("Location: /militantes");

    exit;

});

# Método GET de excluir cliente
$app->get("/excluir/cliente/:id", function($id) {

    User::verifyLogin();

    header("Location: /militantes");

    exit;

});

# Inicia a API
$app->run();

?>