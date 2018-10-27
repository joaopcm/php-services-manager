<?php

namespace Sourcess\Model;

use \Sourcess\DB\Sql;
use \Sourcess\Model\Model;

class Usuario extends Model {

    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY nome");
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_save(:nome, :login, :senha)", array(
            ":nome" => $this->getnome(),
            ":login" => $this->getlogin(),
            ":senha" => md5($this->getsenha())
        ));
        $this->setData($results[0]);
    }

    public function get($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE id = :id",
        array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    public function update()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_update(:id, :nome, :login, :senha)", array(
            ":id" => $this->getid(),
            ":nome" => $this->getnome(),
            ":login" => $this->getlogin(),
            ":senha" => md5($this->getsenha())
        ));
        $this->setData($results[0]);
    }

    public function delete()
    {
        $sql = new Sql();
        $sql->select("CALL sp_usuarios_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

}

?>