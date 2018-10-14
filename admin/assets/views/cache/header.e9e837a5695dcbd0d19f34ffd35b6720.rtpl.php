<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="\assets/img/favicon.png">
  <link rel="icon" type="image/png" href="\assets/img/icons/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    CVA Admin
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="\assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet"/>
</head>
<body>
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="\\assets/img/sidebar-3.jpg">
      <div class="logo">
        <a href="javascript:;;" class="simple-text logo-normal">
          CVA Admin
        </a>
      </div>
      <div class="sidebar-wrapper">
        <?php $array = explode('/', $_SERVER['REQUEST_URI']); ?>
        <ul class="nav">
          <li class="nav-item <?php if( $_SERVER['REQUEST_URI'] === '/' ){ ?>active<?php } ?>" data-toggle="tooltip" data-placement="right" title="Painel com dados analíticos da CVA Admin">
            <a class="nav-link" href="/">
              <i class="material-icons">dashboard</i>
              <p>Painel</p>
            </a>
          </li>
          <li class="nav-item <?php if( $array["2"] === 'clientes' or $array["2"] === 'cliente' ){ ?>active<?php } ?>" data-toggle="tooltip" data-placement="right" title="Módulo de administração de clientes">
            <a class="nav-link" href="/administrar/clientes">
              <i class="material-icons">people</i>
              <p>Clientes</p>
            </a>
          </li>
          <li class="nav-item <?php if( $array["2"] === 'protocolos' or $array["2"] === 'protocolo' ){ ?>active<?php } ?>" data-toggle="tooltip" data-placement="right" title="Módulo de administração de protocolos">
            <a class="nav-link" href="/administrar/protocolos">
              <i class="material-icons">assignment</i>
              <p>Protocolos</p>
            </a>
          </li>
          <li class="nav-item dropdown <?php if( $array["2"] === 'recebimentos' or $array["2"] === 'recebimento' ){ ?>active<?php } ?>" data-toggle="tooltip" data-placement="right" title="Módulo de administração de recebimentos">
            <a class="nav-link" href="/administrar/recebimentos" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">attach_money</i>
              <p>Recebimentos</p>
            </a>
            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="Recebimentos">
              <a class="dropdown-item" href="/administrar/recebimentos/<?php echo date('m'); ?>/<?php echo date('Y'); ?>">Deste mês</a>
              <div class="dropdown-divider"></div>
              <div class="container">
                <input type="text" id="search-recebimentos" class="form-control" placeholder="mm/aaaa">
              </div>
            </div>
          </li>
          <li class="nav-item <?php if( $array["2"] === 'campanhas' or $array["2"] === 'campanha' ){ ?>active<?php } ?>" data-toggle="tooltip" data-placement="right" title="INDISPONÍVEL - Módulo de administração de campanhas de e-mail">
            <a class="nav-link" href="/administrar/campanhas">
              <i class="material-icons">show_chart</i>
              <p>Campanhas</p>
            </a>
          </li>
          <li class="nav-item <?php if( $array["2"] === 'servicos' or $array["2"] === 'servico' ){ ?>active<?php } ?>" data-toggle="tooltip" data-placement="right" title="Módulo de administração de serviços">
            <a class="nav-link" href="/administrar/servicos">
              <i class="material-icons">work</i>
              <p>Serviços</p>
            </a>
          </li>
          <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
          <li class="nav-item <?php if( $array["2"] === 'usuarios' or $array["2"] === 'usuario' ){ ?>active<?php } ?>" data-toggle="tooltip" data-placement="right" title="Módulo de administração de usuários que têm acesso ao CVA Admin">
            <a class="nav-link" href="/administrar/usuarios">
              <i class="material-icons">person</i>
              <p>Usuários</p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="/">Início</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Alternar visão</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <!-- <li class="nav-item dropdown">
                <a class="nav-link" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Algumas Notificações
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifications">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li> -->
              <li class="nav-item dropdown">
                <a class="nav-link" id="user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i> <?php echo htmlspecialchars( $_SESSION['User']['nome'], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                  <p class="d-lg-none d-md-block">
                    Usuário
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user">
                  <a class="dropdown-item" href="/logout">Desconectar</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>