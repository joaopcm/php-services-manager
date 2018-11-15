<?php

namespace Sourcess\Model;

use \Sourcess\DB\Sql;
use \Sourcess\Model\Model;

class Servico extends Model {

    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT
                                s.*,
                                AVG(ps.nota) AS avaliacao
                            FROM tb_servicos AS s
                                LEFT JOIN tb_protocolos AS p ON p.idservico = s.id
                                LEFT JOIN tb_pesquisa_satisfacao AS ps ON ps.id_protocolo = p.id
                            GROUP BY s.id
                            ORDER BY s.titulo");
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_servicos_save(:titulo)", array(
            ":titulo" => $this->gettitulo(),
        ));
        $this->setData($results[0]);
    }

    public function get($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_servicos WHERE id = :id",
        array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    public function update()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_servicos_update(:id, :titulo)", array(
            ":id" => $this->getid(),
            ":titulo" => $this->gettitulo(),
        ));
        $this->setData($results[0]);
    }

    public function delete()
    {
        $sql = new Sql();
        $sql->select("CALL sp_servicos_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

}

?>