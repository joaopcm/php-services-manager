<?php

/**
*
* Sourcess Admin - Sistema de gerenciamento empresarial.
*
* @author João Pedro da Cruz Melo <joao.pedro6532@gmail.com>
* @license Uso exclusivo para funcionários, terceirizados ou outras pessoas previamente autorizadas
* @copyright 2018 | Sourcess
*
* Este arquivo possui a funcionalidade CRUD (Create, Read, Update & Delete) do sistema e rotas de paginação
*
**/

// Configurações
require_once("config.php");

use \Slim\Slim;
use \Sourcess\Model\Page;
use \Sourcess\Model\PageAdmin;
use \Sourcess\Model\User;
use \Sourcess\Model\Usuario;
use \Sourcess\Model\Cliente;
use \Sourcess\Model\Recebimento;
use \Sourcess\Model\Servico;
use \Sourcess\Model\Protocolo;
use \Sourcess\Model\Grafico;
use \Sourcess\Model\Mail;
Use \Sourcess\Middleware\AuthenticateForRole;
Use \Sourcess\Middleware\RedirectToOwnClientPage;

PRODUCTION_MODE === 'false' ? $app = new Slim(array('mode' => 'development', 'debug' => true)) : $app = new Slim(array('debug' => false));

// Middleware
$authenticateForRole = new AuthenticateForRole();
$redirectToOwnClientPage = new RedirectToOwnClientPage();

$app->notFound(function () use ($app) {
  $page = new PageAdmin();
  $page->setTpl("404");
});

// Site
$app->get('/', function() {
  $page = new Page([
    'header' => false,
    'footer' => false
  ]);
  $page->setTpl('index', [
    'clientes' => count(Cliente::listAll()),
    'servicos' => count(Protocolo::listAll())
  ]);
});

// Grupo de rotas administrativas
$app->group('/admin', $authenticateForRole->call(), function () use ($app) {

  // Painel - GET
  $app->get("/painel", function() {
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("painel", array(
      "clientes" => count(Cliente::listAll()),
      "qtdRecebimentos" => count(Recebimento::listAll(date('m'), date('Y'))),
      "recebimentos" => Recebimento::listAll(date('m'), date('Y'))
    ));
  });

  // Página de envio de e-mails
  $app->get('/e-mails', function() {
    $page = new PageAdmin();
    $page->setTpl('enviar-emails');
  });

  // Envio de e-mails - POST
  $app->post('/e-mails', function() {
    echo '<script>alert("Enviando e-mail para todos os clientes...")</script>';
    $mail = new Mail(700, $_POST);
  });

  // Listar Cadastros - GET
  $app->get("/:opcao", function($opcao){
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
        $page->setTpl("usuarios", array(
            "usuarios" => Usuario::listAll(),
            "total" => count(Usuario::listAll())
        ));
        break;
      case 'servicos':
        $page->setTpl("servicos", array(
            "servicos" => Servico::listAll(),
            "total" => count(Servico::listAll())
        ));
        break;
      case 'protocolos':
        $page->setTpl("protocolos", array(
            "protocolos" => Protocolo::listAll(),
            "total" => count(Protocolo::listAll())
        ));
        break;
      default:
        header('Location: /admin/painel');
        exit;
        break;
    }
  });

  // Listar Recebimentos - GET
  $app->get("/recebimentos/:mes/:ano", function($mes, $ano){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("recebimentos", array(
      "recebimentos" => Recebimento::listAll($mes, $ano),
      "mes" => $mes,
      "ano" => $ano,
      "total" => count(Recebimento::listAll($mes, $ano))
    ));
  });

  // Adicionar - GET
  $app->get("/adicionar/:opcao", function($opcao) {
    User::verifyLogin();
    $page = new PageAdmin();
    switch ($opcao)
    {
      case 'cliente':
        $page->setTpl("adicionar-cliente");
        break;
      case 'recebimento':
        $page->setTpl("adicionar-recebimento", array(
            "usuarios" => Usuario::listAll(),
            'clientes' => Cliente::listAll()
        ));
        break;
      case 'usuario':
        $page->setTpl("adicionar-usuario");
        break;
      case 'servico':
        $page->setTpl("adicionar-servico");
        break;
      case 'protocolo':
        $page->setTpl("adicionar-protocolo", array(
            "clientes" => Cliente::listAll(),
            "servicos" => Servico::listAll()
        ));
        break;
    }
  });

  // Visualizar - GET
  $app->get("/visualizar/:opt/:id", function($opt, $id) {
    User::verifyLogin();
    $page = new PageAdmin();
    switch($opt)
    {
      case "cliente":
        $cliente = new Cliente();
        $protocolo = new Protocolo();
        $cliente->get((int)$id);
        $page->setTpl("visualizar-cliente", array(
            "cliente" => $cliente->getValues(),
            "protocolos" => $protocolo->getByClient($id),
            "total" => count($protocolo->getByClient($id))
        ));
        break;
      case "protocolo":
        $protocolo = new Protocolo();
        $protocolo->get((int)$id);
        $page->setTpl("visualizar-protocolo", array(
            "protocolo" => $protocolo->getValues(),
            "recebimento" => $protocolo->getRecebimento(),
            "estados" => $protocolo->getStatus(),
            "total" => count($protocolo->getStatus())
        ));
        break;
    }
  });

  // Editar - GET
  $app->get("/editar/:opcao/:id", function($opcao, $id) {
    User::verifyLogin();
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
            "clientes" => Cliente::listAll(),
            "usuarios" => User::listAll()
        ));
        break;
      case 'usuario':
        $usuario = new Usuario();
        $usuario->get((int)$id);
        $page->setTpl("editar-usuario", array(
            "usuario" => $usuario->getValues()
        ));
        break;
      case 'servico':
        $servico = new Servico();
        $servico->get((int)$id);
        $page->setTpl("editar-servico", array(
            "servico" => $servico->getValues()
        ));
        break;
    }
  });

  // Adicionar - POST
  $app->post("/adicionar/:opcao", function($opcao) {
    User::verifyLogin();
    switch ($opcao)
    {
      case 'cliente':
        $cliente = new Cliente();
        $cliente->setData($_POST);
        $cliente->save();
        header("Location: /admin/clientes");
        exit;
        break;
      case 'recebimento':
        $recebimento = new Recebimento();
        $_POST['valorBoleto'] = str_replace('.', '', $_POST['valorBoleto']);
        $_POST['valorBoleto'] = str_replace(',', '.', $_POST['valorBoleto']);
        if ($_POST['dataCompensacao'] === '')
        {
            $_POST['dataCompensacao'] = NULL;
        }
        if (!isset($_POST['nBoleto']))
        {
          $_POST['nBoleto'] = NULL;
        }
        $recebimento->setData($_POST);
        $recebimento->save();
        header("Location: /admin/recebimentos/" . date('m') . "/" . date('Y'));
        exit;
        break;
      case 'usuario':
        $usuario = new Usuario();
        $usuario->setData($_POST);
        $usuario->save();
        header("Location: /admin/usuarios");
        exit;
        break;
      case 'servico':
        $servico = new Servico();
        $servico->setData($_POST);
        $servico->save();
        header("Location: /admin/servicos");
        exit;
        break;
      case 'protocolo':
        $protocolo = new Protocolo();
        $protocolo->setData($_POST);
        $protocolo->save();
        header("Location: /admin/protocolos");
        exit;
        break;
    }
  });

  // Atualizar Protocolo - POST
  $app->post("/atualizar/protocolo/:id", function($id) {
    User::verifyLogin();
    $protocolo = new Protocolo();
    $protocolo->get((int)$id);
    $protocolo->setData($_POST);
    $protocolo->saveStatus();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
  });

  // Editar - PUT
  $app->put("/editar/:opcao/:id", function($opcao, $id) {
    User::verifyLogin();
    switch ($opcao)
    {
      case 'cliente':
        $cliente = new Cliente();
        $cliente->get((int)$id);
        $cliente->setData($_POST);
        $cliente->update();
        header("Location: /admin/clientes");
        exit;
        break;
      case 'recebimento':
        $recebimento = new Recebimento();
        $recebimento->get((int)$id);
        $_POST['valorBoleto'] = str_replace('.', '', $_POST['valorBoleto']);
        $_POST['valorBoleto'] = str_replace(',', '.', $_POST['valorBoleto']);
        if ($_POST['dataCompensacao'] === '')
        {
          $_POST['dataCompensacao'] = NULL;
        }
        if (!isset($_POST['nBoleto']))
        {
          $_POST['nBoleto'] = NULL;
        }
        $recebimento->setData($_POST);
        $recebimento->update();
        header("Location: /admin/recebimentos/" . date('m') . "/" . date('Y'));
        exit;
        break;
      case 'usuario':
        $usuario = new Usuario();
        $usuario->get((int)$id);
        $usuario->setData($_POST);
        $usuario->update();
        header("Location: /admin/usuarios");
        exit;
        break;
      case 'servico':
        $servico = new Servico();
        $servico->get((int)$id);
        $servico->setData($_POST);
        $servico->update();
        header("Location: /admin/servicos");
        exit;
        break;
    }
  });

  // Excluir - DELETE
  $app->delete("/excluir/:opcao/:id", function($opcao, $id) {
    User::verifyLogin();
    switch ($opcao)
    {
      case 'cliente':
        $cliente = new Cliente();
        $cliente->get((int)$id);
        $cliente->delete();
        header("Location: /admin/clientes");
        exit;
        break;
      case 'recebimento':
        $recebimento = new Recebimento();
        $recebimento->get((int)$id);
        $recebimento->delete();
        header("Location: /admin/recebimentos/" . date('m') . "/" . date('Y'));
        exit;
        break;
      case 'usuario':
        $usuario = new Usuario();
        $usuario->get((int)$id);
        $usuario->delete();
        header("Location: /admin/usuarios");
        exit;
        break;
      case 'servico':
        $servico = new Servico();
        $servico->get((int)$id);
        $servico->delete();
        header("Location: /admin/servicos");
        exit;
        break;
      case 'protocolo':
        $protocolo = new Protocolo();
        $protocolo->get((int)$id);
        $protocolo->delete();
        header("Location: /admin/protocolos");
        exit;
        break;
      case 'estado':
        $protocolo = new Protocolo();
        $protocolo->deleteStatus((int)$id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
  });

  // Protocolos vinculados a um cliente - POST
  $app->post("/recuperar/protocolos/:id", function($id) {
    User::verifyLogin();
    $cliente = new Cliente();
    $cliente->get((int)$id);
    $results = $cliente->getProtocols();
    echo json_encode($results);
  });

  // Dados de localização via CEP - POST
  $app->post("/localizacao/:cep", function($cep) {
    User::verifyLogin();
    $cliente = new Cliente();
    $result = $cliente->getLocale($cep);
    echo json_encode($result);
  });

  // Dados que preenchem os gráficos no painel - POST
  $app->post("/preencher/:grafico", function($grafico){
    User::verifyLogin();
    switch ($grafico) {
      case 'clientes-mes-chart':
        $results = Grafico::clientesMesChart();
        echo json_encode($results);
        break;
      case 'recebimentos-mes-chart':
        $results = Grafico::recebimentosMesChart();
        echo json_encode($results);
        break;
    }
  });

  // Finaliza um protocolo
  $app->put("/finalizar/protocolo/:id", function($id){
    User::verifyLogin();
    $protocolo = new Protocolo();
    $protocolo->get((int)$id);
    $protocolo->finalize();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
  });

  // Retorna os clientes que responderam a pesquisa de satisfação de tal serviço
  $app->post("/pesquisas/resultados", function () {
    $servico = new Servico();
    $results = $servico->listAllAnswersById((int)$_POST['id']);
    echo json_encode($results);
  });

});

// Grupo de rotas responsável pela parte do cliente
$app->group('/cliente', $redirectToOwnClientPage->call(), function () use ($app) {

  // Visualizar cliente - GET
  $app->get('/:id', function($id) {
    User::verifyLogin();
    $page = new PageAdmin();
    $cliente = new Cliente();
    $protocolo = new Protocolo();
    $cliente->get((int)$id);
    $page->setTpl("visualizar-cliente", array(
        "cliente" => $cliente->getValues(),
        "protocolos" => $protocolo->getByClient($id),
        "total" => count($protocolo->getByClient($id))
    ));
  });

  // Pesquisa de satisfação - GET
  $app->get('/:id_cliente/pesquisa/:codigo', function($idc, $codigo) {
    User::verifyLogin();
    $protocolo = new Protocolo();
    $page = new PageAdmin();
    $result = $protocolo->getByCode($codigo, true);
    if ($idc != $result[0]['idcliente'])
    {
      header('Location: /cliente/' . $idc);
      exit;
    }
    $page->setTpl('pesquisa-satisfacao', array(
      'detalhes' => $result[0]
    ));
  });

});

// Pesquisa de satisfação - POST
$app->post('/responder/pesquisa-satisfacao', function() {
  User::verifyLogin();
  $protocolo = new Protocolo();
  $protocolo->setData($_POST);
  $protocolo->avaliar();
  if ($_SESSION['User']['is_admin'] == false)
  {
    header("Location: /cliente/" . $_SESSION['User']['id']);
  } else {
    header("Location: /admin/protocolos");
  }
  exit;
});

// Login - GET
$app->get("/login", function() {
  if (isset($_SESSION['User']) && $_SESSION['User']['is_admin'] == true)
  {
    header("Location: /admin/painel");
    exit;
  } elseif (isset($_SESSION['User']) && $_SESSION['User']['is_admin'] == false) {
    header("Location: /cliente/" . $_SESSION['User']['id']);
    exit;
  }
  $page = new PageAdmin([
    "header" => false,
    "footer" => false
  ]);
  $page->setTpl("login");
});

// Login - POST
$app->post("/login", function() {
  $user = new User();
  if ($user->login($_POST["login"], $_POST["password"]))
  {
    $_SESSION['login_err'] = null;
    header("Location: /admin/painel");
    exit;
  } else {
    $page = new PageAdmin([
        "header" => false,
        "footer" => false
    ]);
    $_SESSION['login_err'] = 'Dados de acesso inválidos.';
    $page->setTpl("login");
  }
});

// Logout - GET
$app->get("/logout", function() {
  User::logout();
  header("Location: /login");
  exit;
});

// Download de anexos - GET
$app->get("/baixar/anexo/:anexo", function($anexo) {
  $protocolo = new Protocolo();
  $protocolo->download($anexo);
});

// Consultar atualizações de protocolos - POST
$app->post("/consultar/protocolo/:protocolo", function($codigo) {
  User::verifyLogin();
  $protocolo = new Protocolo();
  $results = $protocolo->getByCode($codigo);
  echo json_encode($results);
});

$app->run();

?>