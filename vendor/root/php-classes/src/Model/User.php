<?php

/*
* Classe responsável por todas as ações
* de acesso relacionadas aos usuários
* do sistema
*/

namespace Root\Model;

use \Root\DB\Sql;
use \Root\Model;

define('SESSION', 'User');

class User extends Model {

    /* Lista todos os usuários */
    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios");

    }

    /* Efetua o login de um usuário */
    public function login($login,  $password)
    {

        $sql = new Sql();

        $users = $sql->select("SELECT * FROM tb_usuarios WHERE usuario = :login", array(
            ":login" => $login
        ));

        if (isset($users[0]))
        {

            $verifyPass = $sql->select("SELECT * FROM tb_usuarios WHERE usuario = :login AND senha = :password", array(
                ":login" => $login,
                ":password" => md5($password)
            ));

            if (isset($verifyPass[0]))
            {

                $_SESSION[SESSION] = $verifyPass[0];
                
                return "OK";

            } else {

                return 1;

            }

        } else {

            return 1;

        }

    }

    /* Verifica se um usuário está logado */
    public static function verifyLogin()
    {

        if (
            !isset($_SESSION[SESSION])
            ||
            !$_SESSION[SESSION]
        )
        {

            header("Location: /login");

            exit;

        }

    }

    /* Verifica o nível de acesso do usuário */
    public static function verifyAccess()
    {

        if ($_SESSION[SESSION]['acessoTotal'] != 1)
        {

            header("Location: /");

            exit;

        }

    }

    /* Faz o logout de um usuário */
    public static function logout()
    {

        $_SESSION[SESSION] = NULL;

    }

}

?>