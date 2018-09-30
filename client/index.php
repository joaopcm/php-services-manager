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
use \Root\Model\Usuario;
use \Root\Model\Cliente;
use \Root\Model\Recebimento;

# Slim instance
$app = new Slim();
$app->config("debug", true);

# Página principal
$app->get("/", function() {
    User::verifyLogin();
    header("Location: /visualizar/cliente/" . $_SESSION['User']['idcliente']);
    exit;
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

# Págine de visualização de clientes
$app->get("/visualizar/:opt/:id", function($opt, $id) {
    User::verifyLogin();
    $page = new PageAdmin();
    switch($opt)
    {
        case "cliente":
            if ($_SESSION['User']['acessoTotal'] == 0 && $_SESSION['User']['idcliente'] != $id)
            {
                header("Location: /visualizar/cliente/" . $_SESSION['User']['idcliente']);
                exit;
            }
            $cliente = new Cliente();
            $recebimento = new Recebimento();
            $cliente->get((int)$id);
            $page->setTpl("visualizar-cliente", array(
                "cliente" => $cliente->getValues(),
                "recebimentos" => $recebimento->getByClient($id),
                "total" => count($recebimento->getByClient($id))
            ));
            break;
        default:
            header("Location: /");
            exit;
            break;
    }
});

# Inicia a API
$app->run();

?>