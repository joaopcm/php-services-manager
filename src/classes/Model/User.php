<?php

namespace Sourcess\Model;

use \Sourcess\DB\Sql;
use \Sourcess\Model\Model;

class User extends Model {

    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios");
    }

    public function login($login,  $password)
    {
        $sql = new Sql();
        $query_admins = "SELECT usuario, senha, nome FROM tb_usuarios WHERE usuario = :login AND senha = :password LIMIT 1";
        $admins = $sql->select($query_admins, array(
            ':login' => $login,
            ':password' => md5($password)
        ));
        $query_clients = "SELECT c.nomeCliente AS nome, cu.usuario AS usuario, cu.senha AS senha, c.id AS id FROM tb_clientes_usuarios AS cu JOIN tb_clientes AS c ON cu.idcliente = c.id WHERE usuario = :login AND senha = :password LIMIT 1";
        $clients = $sql->select($query_clients, array(
            ':login' => $login,
            ':password' => $password
        ));
        if ($admins[0] != null)
        {
            $_SESSION['User'] = $admins[0];
            $_SESSION['User']['is_admin'] = true;
            return true;
        } elseif ($clients[0] != null) {
            $_SESSION['User'] = $clients[0];
            $_SESSION['User']['is_admin'] = false;
            return true;
        } else {
            return false;
        }
    }

    public static function verifyLogin()
    {
        if (!isset($_SESSION['User']) || !$_SESSION['User'])
        {
            header("Location: /login");
            exit;
        }
    }

    public static function logout()
    {
        $_SESSION['User'] = NULL;
        $_SESSION['login_err'] = NULL;
    }

}

?>