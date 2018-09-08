<?php

/*
* Classe responsável por todas as ações
* relacionadas aos usuários do sistema
*/

namespace Root\Model;

use \Root\DB\Sql;
use \Root\Model;

/* Constantes Docker*/
define('SESSION', 'User');

class User extends Model {

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

                $_SESSION[SESSION] = $verifyPass[0]["nome"];
                return "OK";

            } else {

                return 1;

            }

        } else {

            return 1;

        }

    }

    /* verifica se um usuário está logado */
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

    /* Faz o logout de um usuário */
    public static function logout()
    {

        $_SESSION[SESSION] = NULL;

    }

}

?>