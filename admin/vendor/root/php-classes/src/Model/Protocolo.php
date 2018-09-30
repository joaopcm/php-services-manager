<?php

/*
* Classe responsável por todas as ações
* relacionadas aos protocolos da CVA
*/

namespace Root\Model;

use \Root\DB\Sql;
use \Root\Model;
use \Root\Model\Mail;

class Protocolo extends Model {

    /* Lista todos os protocolos cadastrados */
    public static function listAll()
    {
        $sql = new Sql();
        $query = "SELECT
                    c.nomeCliente AS cliente,
                    c.id AS idcliente,
                    p.numero AS codigo,
                    p.id AS id,
                    p.dataCadastro AS data,
                    s.titulo AS servico
                FROM tb_clientes AS c
                    JOIN tb_protocolos AS p ON p.idcliente = c.id
                    JOIN tb_servicos AS s ON p.idservico = s.id
                ORDER BY c.nomeCliente";
        return $sql->select($query);
    }

    /* Salva o cadastro de um protocolo */
    public function save()
    {
        $sql = new Sql();
        $protocol = 'CVAPROTOCOL-' . strtoupper(substr(md5($this->getcliente() . date('dHis')), 24));
        $results = $sql->select("CALL sp_protocolos_save(:idcliente, :idservico, :numero)", array(
            ":idcliente" => $this->getcliente(),
            ":idservico" => $this->getservico(),
            ":numero" => $protocol
        ));
        $this->setData($results[0]);
        /* Envia o protocolo para o cliente por e-mail */
        if ($this->getemail() !== '')
        {
            $mail = new Mail();
            $mail->sendProtocol($this->getcliente(), $this->getservico(), $protocol, $this->getemail());
        }
    }

    /* Recupera todos os dados de um recebimento pelo ID */
    public function get($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_protocolos WHERE id = :id",
        array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    /* Deleta o cadastro de um protocolo */
    public function delete()
    {
        $sql = new Sql();
        $sql->select("CALL sp_protocolos_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

}

?>