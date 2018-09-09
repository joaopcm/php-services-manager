<?php

/*
* Classe responsável por todas as ações
* CRUD relacionadas aos usuários da CVA
*/

namespace Root\Model;

use \Root\DB\Sql;
use \Root\Model;

class Usuario extends Model {

    /* Lsita todos os usuários*/
    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY nome");

    }

    /* Salva o cadastro de um usuário */
    public function save()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_save(:nome, :login, :senha, :acesso)", array(
            ":nome" => $this->getnome(),
            ":login" => $this->getlogin(),
            ":senha" => md5($this->getsenha()),
            ":acesso" => $this->getacesso()
        ));

        $this->setData($results[0]);

    }

    /* Recupera todos os dados de um usuário pelo ID */
    public function get($id)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE id = :id",
        array(
            ":id" => $id
        ));

        $this->setData($results[0]);

    }

    /* Atualiza o cadastro de um usuário */
    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_update(:id, :nome, :login, :senha, :acesso)", array(
            ":id" => $this->getid(),
            ":nome" => $this->getnome(),
            ":login" => $this->getlogin(),
            ":senha" => md5($this->getsenha()),
            ":acesso" => $this->getacesso()
        ));

        $this->setData($results[0]);

    }

    /* Deleta o cadastro de um usuário */
    public function delete()
    {

        $sql = new Sql();

        $sql->select("CALL sp_usuarios_delete(:id)", array(
            ":id" => $this->getid()
        ));

    }

}

?>