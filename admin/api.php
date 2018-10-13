<?php

/**
*
* CVA Admin - Sistema de gerenciamento de dados internos da CVA Climatização
*
* @author João Pedro da Cruz Melo <joao.pedro6532@gmail.com>
* @license Uso exclusivo para funcionários, terceirizados ou outras pessoas previamente autorizadas
* @copyright 2018 | CVA Climatização
*
* Este arquivo possui a funcionalidade CRUD (Create, Read, Update & Delete) do sistema e rotas de paginação
*
**/

/* Inicia uma sessão */
session_start();

/* Importa o autoload do Composer */
require_once("libs/autoload.php");

/* Define um local */
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utl-8', 'portuguese');

/* Define um horárío */
date_default_timezone_set('America/Sao_Paulo');

/* Define configurações de desenvolvimento e de produção */
define('ON_PRODUCTION', getenv('ON_PRODUCTION'));

/* Namespaces */
use \Slim\Slim;
use \CVA\Page;
use \CVA\PageAdmin;
use \CVA\Model\User;
use \CVA\Model\Usuario;
use \CVA\Model\Cliente;
use \CVA\Model\Recebimento;
use \CVA\Model\Servico;
use \CVA\Model\Protocolo;

/* Instancia o Slim Framework */
$app = new Slim();
ON_PRODUCTION === 'false' ? $app->config("debug", true) : $app->config("debug", false);;

/* Rota da página principal */
$app->get("/", function() {
  User::verifyLogin();
  $page = new PageAdmin();
  $page->setTpl("painel", array(
    "clientes" => count(Cliente::listAll()),
    "qtdRecebimentos" => count(Recebimento::listAll(date('m'), date('Y'))),
    "recebimentos" => Recebimento::listAll(date('m'), date('Y'))
  ));
});

/* Listar cadastros */
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
      $page->setTpl("404");
      break;
  }
});

/* Listar recebimentos */
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

/* Rota da página de login */
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

/* Realiza o logout */
$app->get("/logout", function() {
  User::logout();
  header("Location: /");
  exit;
});

/* Rota da página de criação */
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
    default:
      $page->setTpl("404");
      break;
  }
});

/* Rota da página de visualização */
$app->get("/visualizar/:opt/:id", function($opt, $id) {
  User::verifyLogin();
  $page = new PageAdmin();
  switch($opt)
  {
    case "cliente":
      $cliente = new Cliente();
      $recebimento = new Recebimento();
      $cliente->get((int)$id);
      $page->setTpl("visualizar-cliente", array(
          "cliente" => $cliente->getValues(),
          "recebimentos" => $recebimento->getByClient($id),
          "total" => count($recebimento->getByClient($id))
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
    default:
      $page->setTpl("404");
      break;
  }
});

/* Roda da página de edição */
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
    default:
      $page->setTpl("404");
      break;
  }
});

/* Método POST para adicionar um cadastro */
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
      $_POST['valorBoleto'] = str_replace('.', '', $_POST['valorBoleto']);
      $_POST['valorBoleto'] = str_replace(',', '.', $_POST['valorBoleto']);
      if ($_POST['dataCompensacao'] === '')
      {
          $_POST['dataCompensacao'] = NULL;
      }
      $recebimento->setData($_POST);
      $recebimento->save();
      header("Location: /administrar/recebimentos/" . date('m') . "/" . date('Y'));
      exit;
      break;
    case 'usuario':
      $usuario = new Usuario();
      $usuario->setData($_POST);
      $usuario->save();
      header("Location: /administrar/usuarios");
      exit;
      break;
    case 'servico':
      $servico = new Servico();
      $servico->setData($_POST);
      $servico->save();
      header("Location: /administrar/servicos");
      exit;
      break;
    case 'protocolo':
      $protocolo = new Protocolo();
      $protocolo->setData($_POST);
      $protocolo->save();
      header("Location: /administrar/protocolos");
      exit;
      break;
    default:
      header('Location: /');
      exit;
      break;
  }
});

/* Método POST para atualizar um protocolo */
$app->post("/atualizar/protocolo/:id", function($id) {
  $protocolo = new Protocolo();
  $protocolo->get((int)$id);
  $protocolo->setData($_POST);
  $protocolo->saveStatus();
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit;
});

/* Método POST para editar um cadastro */
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
      $_POST['valorBoleto'] = str_replace('.', '', $_POST['valorBoleto']);
      $_POST['valorBoleto'] = str_replace(',', '.', $_POST['valorBoleto']);
      if ($_POST['dataCompensacao'] === '')
      {
        $_POST['dataCompensacao'] = NULL;
      }
      $recebimento->setData($_POST);
      $recebimento->update();
      header("Location: /administrar/recebimentos/" . date('m') . "/" . date('Y'));
      exit;
      break;
    case 'usuario':
      $usuario = new Usuario();
      $usuario->get((int)$id);
      $usuario->setData($_POST);
      $usuario->update();
      header("Location: /administrar/usuarios");
      exit;
      break;
    case 'servico':
      $servico = new Servico();
      $servico->get((int)$id);
      $servico->setData($_POST);
      $servico->update();
      header("Location: /administrar/servicos");
      exit;
      break;
    default:
      header('Location: /');
      exit;
      break;
  }
});

/* Método GET para excluir um cadastro */
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
    case 'servico':
      $servico = new Servico();
      $servico->get((int)$id);
      $servico->delete();
      header("Location: /administrar/servicos");
      exit;
      break;
    case 'protocolo':
      $protocolo = new Protocolo();
      $protocolo->get((int)$id);
      $protocolo->delete();
      header("Location: /administrar/protocolos");
      exit;
      break;
    case 'estado':
      $protocolo = new Protocolo();
      $protocolo->deleteStatus((int)$id);
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit;
    default:
      $page->setTpl("404");
      break;
  }
});

/* Retorna protocolos vinculados a um cliente */
$app->post("/recuperar/protocolos/:id", function($id) {
  $cliente = new Cliente();
  $cliente->get((int)$id);
  $results = $cliente->getProtocols();
  echo json_encode($results);
});

/* Retorna dados de localização de acordo com o CEP */
$app->post("/localizacao/:cep", function($cep) {
  $cliente = new Cliente();
  $result = $cliente->getLocale($cep);
  echo json_encode($result);
});

/* Retorna atualizações de um protocolo */
$app->post("/consultar/protocolo/:protocolo", function($codigo) {
  $protocolo = new Protocolo();
  $results = $protocolo->getByCode($codigo);
  echo json_encode($results);
});

/* Método POST para iniciar o download de um anexo */
$app->get("/baixar/anexo/:anexo", function($anexo) {
  $protocolo = new Protocolo();
  $protocolo->download($anexo);
});

/* Inicia a API */
$app->run();

?>