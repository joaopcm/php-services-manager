<?php

namespace Sourcess\Middleware;

class AuthenticateForRole extends \Slim\Middleware {

  public function call()
  {
    return function () {
      if ($_SESSION['User']['is_admin'] === false)
      {
        $app = \Slim\Slim::getInstance();
        $app->redirect('/cliente/' . $_SESSION['User']['id']);
      }
    };
  }

}

?>