<?php

/*
* REST API que gerencia todas as rotas da
* aplicação e suas funções via GET ou POST
*/

# Inicia uma sessão
session_start();

# Desabilita os warnings reports
# error_reporting(E_CORE_WARNING);

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
use \Root\Model\Cliente;

# Slim instance
$app = new Slim();
$app->config("debug", true);

# Página principal
$app->get("/", function() {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("index", array(
        "clientes" => Cliente::listAll()
    ));

});

# Lista de clientes
$app->get("/clientes", function(){

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("clientes", array(
        "clientes" => Cliente::listAll()
    ));

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
$app->get("/adicionar/cliente", function() {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("adicionar-cliente");

});

# Página de edição de clientes
$app->get("/editar/cliente/:id", function($id) {

    User::verifyLogin();

    $page = new PageAdmin();

    $cliente = new Cliente();

    $cliente->get((int)$id);

    $page->setTpl("editar-cliente", array(
        "cliente" => $cliente->getValues()
    ));

});

# Método POST de adicionar cliente
$app->post("/adicionar/cliente", function() {

    User::verifyLogin();

    $cliente = new Cliente();

    $cliente->setData($_POST);

    $cliente->save();

    header("Location: /clientes");

    exit;

});

# Método POST de editar clientes
$app->post("/editar/cliente/:id", function($id) {

    User::verifyLogin();

    $cliente = new Cliente();

    $cliente->get((int)$id);

    $cliente->setData($_POST);

    $cliente->update();

    header("Location: /clientes");

    exit;

});

# Método GET de excluir cliente
$app->get("/excluir/cliente/:id", function($id) {

    User::verifyLogin();

    $cliente = new Cliente();

    $cliente->get((int)$id);

    $cliente->delete();

    header("Location: /clientes");

    exit;

});

# Localização de acordo com o CEP
$app->post("/localizacao/:cep", function($cep) {

    $cliente = new Cliente();

    $result = $cliente->getLocale($cep);

    echo json_encode($result);

});

# Inicia a API
$app->run();

?>