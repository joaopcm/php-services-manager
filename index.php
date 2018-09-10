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
use \Root\Model\Usuario;
use \Root\Model\Cliente;
use \Root\Model\Recebimento;

# Slim instance
$app = new Slim();
$app->config("debug", false);

# Página principal
$app->get("/", function() {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("index", array(
        "clientes" => Cliente::listAll()
    ));

});

# Lista de clientes/usuários
$app->get("/administrar/:opcao", function($opcao){

    User::verifyLogin();

    $page = new PageAdmin();

    switch ($opcao)
    {

        case 'clientes':

            $page->setTpl("clientes", array(
                "clientes" => Cliente::listAll(),
                "total" => count(Cliente::listAll())
            ));

            break;

        case 'usuarios':

            User::verifyAccess();

            $page->setTpl("usuarios", array(
                "usuarios" => Usuario::listAll(),
                "total" => count(Usuario::listAll())
            ));

            break;

    }

});

# Lista de recebimentos
$app->get("/administrar/recebimentos/:mes/:ano", function($mes, $ano){

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("recebimentos", array(
        "recebimentos" => Recebimento::listAll($mes, $ano),
        "mes" => $mes,
        "ano" => $ano,
        "total" => count(Recebimento::listAll($mes, $ano))
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

# Página de criação de clientes/recebimentos
$app->get("/adicionar/:opcao", function($opcao) {

    User::verifyLogin();

    User::verifyAccess();

    $page = new PageAdmin();

    switch ($opcao)
    {

        case 'cliente':

            $page->setTpl("adicionar-cliente");

            break;

        case 'recebimento':

            $page->setTpl("adicionar-recebimento", array(
                "usuarios" => Usuario::listAll()
            ));

            break;

        case 'usuario':

            $page->setTpl("adicionar-usuario");

            break;

        default:

            header('Location: /');

            exit;

            break;

    }

});

# Página de edição de clientes/recebimentos
$app->get("/editar/:opcao/:id", function($opcao, $id) {

    User::verifyLogin();

    User::verifyAccess();

    $page = new PageAdmin();

    switch ($opcao)
    {

        case 'cliente':

            $cliente = new Cliente();

            $cliente->get((int)$id);

            $page->setTpl("editar-cliente", array(
                "cliente" => $cliente->getValues()
            ));

            break;
        
        case 'recebimento':

            $recebimento = new Recebimento();

            $recebimento->get((int)$id);

            $page->setTpl("editar-recebimento", array(
                "recebimento" => $recebimento->getValues(),
                "usuarios" => Usuario::listAll()
            ));

            break;

        case 'usuario':

            $usuario = new Usuario();

            $usuario->get((int)$id);

            $page->setTpl("editar-usuario", array(
                "usuario" => $usuario->getValues()
            ));

            break;
        
        default:

            header('Location: /');

            exit;

            break;

    }

});

# Método POST de adicionar cliente/recebimento
$app->post("/adicionar/:opcao", function($opcao) {

    User::verifyLogin();

    User::verifyAccess();

    switch ($opcao)
    {

        case 'cliente':

            $cliente = new Cliente();

            $cliente->setData($_POST);
        
            $cliente->save();
        
            header("Location: /administrar/clientes");
        
            exit;

            break;

        case 'recebimento':

            $recebimento = new Recebimento();

            $recebimento->setData($_POST);

            $recebimento->save();

            header("Location: /administrar/recebimentos/" . date('m') . "/" . date('Y'));

            exit;

            break;

        case 'usuario':

            $usuario = new Usuario();

            if (isset($_POST["acesso"]))
            {

                $_POST["acesso"] = 1;

            } else {

                $_POST["acesso"] = 0;

            }

            $usuario->setData($_POST);

            $usuario->save();

            header("Location: /administrar/usuarios");

            exit;

            break;

        default:

            header('Location: /');

            exit;

            break;

    }

});

# Método POST de editar clientes/recebimentos
$app->post("/editar/:opcao/:id", function($opcao, $id) {

    User::verifyLogin();

    User::verifyAccess();

    switch ($opcao)
    {

        case 'cliente':

            $cliente = new Cliente();

            $cliente->get((int)$id);

            $cliente->setData($_POST);

            $cliente->update();

            header("Location: /administrar/clientes");

            exit;

            break;

        case 'recebimento':

            $recebimento = new Recebimento();

            $recebimento->get((int)$id);

            $recebimento->setData($_POST);

            $recebimento->update();

            header("Location: /administrar/recebimentos/" . date('m') . "/" . date('Y'));

            exit;

            break;

        case 'usuario':

            $usuario = new Usuario();

            $usuario->get((int)$id);

            if (isset($_POST["acesso"]))
            {

                $_POST["acesso"] = 1;

            } else {

                $_POST["acesso"] = 0;

            }

            $usuario->setData($_POST);

            $usuario->update();

            header("Location: /administrar/usuarios");

            exit;

            break;

        default:

            header('Location: /');

            exit;

            break;

    }

});

# Método GET de excluir cliente/recebimento
$app->get("/excluir/:opcao/:id", function($opcao, $id) {

    User::verifyLogin();

    User::verifyAccess();

    switch ($opcao)
    {

        case 'cliente':

            $cliente = new Cliente();

            $cliente->get((int)$id);

            $cliente->delete();

            header("Location: /administrar/clientes");

            exit;

            break;

        case 'recebimento':

            $recebimento = new Recebimento();

            $recebimento->get((int)$id);

            $recebimento->delete();

            header("Location: /administrar/recebimentos/" . date('m') . "/" . date('Y'));

            exit;

            break;

        case 'usuario':

            $usuario = new Usuario();

            $usuario->get((int)$id);

            $usuario->delete();

            header("Location: /administrar/usuarios");

            exit;

            break;

        default:

            header('Location: /');

            exit;

            break;

    }

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