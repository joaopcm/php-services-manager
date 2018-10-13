<?php

/*
* Classe responsável por todas as ações
* relacionadas aos serviços da CVA
*/

namespace CVA\Model;

use \CVA\DB\Sql;
use \CVA\Model;

class Servico extends Model {

    /* Lista todos os serviços cadastrados */
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_servicos ORDER BY titulo");
    }

    /* Salva o cadastro de um serviço */
    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_servicos_save(:titulo)", array(
            ":titulo" => $this->gettitulo(),
        ));
        $this->setData($results[0]);
    }

    /* Recupera todos os dados de um cliente pelo ID */
    public function get($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_servicos WHERE id = :id",
        array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    /* Atualiza o cadastro de um cliente */
    public function update()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_servicos_update(:id, :titulo)", array(
            ":id" => $this->getid(),
            ":titulo" => $this->gettitulo(),
        ));
        $this->setData($results[0]);
    }

    /* Deleta o cadastro de um cliente */
    public function delete()
    {
        $sql = new Sql();
        $sql->select("CALL sp_servicos_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

}

?>