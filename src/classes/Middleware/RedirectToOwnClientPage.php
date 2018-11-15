<?php

namespace Sourcess\Middleware;

class RedirectToOwnClientPage extends \Slim\Middleware {

  public function call()
  {
    return function () {
      $array = explode('/', $_SERVER['REQUEST_URI']);
      if ($array[2] != $_SESSION['User']['id'] && $_SESSION['User']['is_admin'] === false)
      {
        header('Location: /cliente/' . $_SESSION['User']['id']);
        exit;
      }
    };
  }

}

?>