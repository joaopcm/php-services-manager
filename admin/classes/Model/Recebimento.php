<?php

/*
* Classe responsável por todas as ações
* relacionadas aos recebimentos da CVA
*/

namespace CVA\Model;

use \CVA\DB\Sql;
use \CVA\Model;

class Recebimento extends Model {

    /* Lsita todos os recebimentos cadastrados do mês*/
    public static function listAll($mes, $ano)
    {
        $sql = new Sql();
        $query = "SELECT
                    c.nomeCliente AS cliente,
                    c.id AS idcliente,
                    p.numero AS codigo,
                    p.id AS idprotocolo,
                    s.titulo AS servico,
                    r.*
                FROM tb_recebimentos AS r
                    LEFT JOIN tb_protocolos AS p ON r.idprotocolo = p.id
                    LEFT JOIN tb_clientes AS c ON p.idcliente = c.id
                    LEFT JOIN tb_servicos AS s ON p.idservico = s.id
                WHERE r.mes = :mesAtual
                    AND r.ano = :anoAtual
                ORDER BY r.dataRecebimento DESC;";
        return $sql->select($query, array(
            ":mesAtual" => $mes,
            ":anoAtual" => $ano
        ));
    }

    /* Salva o cadastro de um recebimento */
    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_recebimentos_save(:dataRecebimento, :idprotocolo, :valorBoleto, :dataVencimento, :dataCompensacao, :nBoleto, :formaPagamento, :parcelas, :referencia, :formaEnvio, :enviadoPor, :mes, :ano, :alteradoPor, :alteradoEm)", array(
            ":dataRecebimento" => $this->getdataRecebimento(),
            ":idprotocolo" => (int)$this->getprotocolo(),
            ":valorBoleto" => (float)$this->getvalorBoleto(),
            ":dataVencimento" => $this->getdataVencimento(),
            ":dataCompensacao" => $this->getdataCompensacao(),
            ":nBoleto" => $this->getnBoleto(),
            ":formaPagamento" => $this->getformaPagamento(),
            ":parcelas" => $this->getparcelas(),
            ":referencia" => $this->getreferencia(),
            ":formaEnvio" => $this->getformaEnvio(),
            ":enviadoPor" => $this->getenviadoPor(),
            ":mes" => date('m'),
            ":ano" => date('Y'),
            ":alteradoPor" => $_SESSION["User"]["nome"],
            ":alteradoEm" => date('Y-m-d H:i')
        ));
        $this->setData($results[0]);
    }

    /* Recupera todos os dados de um recebimento pelo ID */
    public function get($id)
    {
        $sql = new Sql();
        $query = "SELECT
                    r.*, p.numero AS codigo,
                    c.nomeCliente AS cliente,
                    c.id AS idcliente,
                    p.id AS idprotocolo,
                    s.titulo AS servico
                FROM tb_recebimentos AS r
                    LEFT JOIN tb_protocolos AS p ON r.idprotocolo = p.id
                    LEFT JOIN tb_servicos AS s ON p.idservico = s.id
                    LEFT JOIN tb_clientes AS c ON p.idcliente = c.id
                WHERE r.id = :id";
        $results = $sql->select($query,
        array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    /* Recupera todos os recebimentos de um cliente */
    public function getByClient($id)
    {
        $sql = new Sql();
        $query = "SELECT
                    r.*,
                    p.numero AS codigo,
                    p.id AS idprotocolo,
                    s.titulo AS servico
                FROM tb_recebimentos AS r
                    JOIN tb_protocolos AS p ON r.idprotocolo = p.id
                    JOIN tb_clientes AS c ON p.idcliente = c.id
                    JOIN tb_servicos AS s ON p.idservico = s.id
                WHERE c.id = :id
                ORDER BY r.dataRecebimento DESC";
        return $sql->select($query, array(
            ":id" => $id
        ));
    }

    /* Atualiza o cadastro de um recebimento */
    public function update()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_recebimentos_update(:id, :dataRecebimento, :idprotocolo, :valorBoleto, :dataVencimento, :dataCompensacao, :nBoleto, :formaPagamento, :parcelas, :referencia, :formaEnvio, :enviadoPor, :alteradoPor, :alteradoEm)", array(
            ":id" => $this->getid(),
            ":dataRecebimento" => $this->getdataRecebimento(),
            ":idprotocolo" => $this->getprotocolo(),
            ":valorBoleto" => $this->getvalorBoleto(),
            ":dataVencimento" => $this->getdataVencimento(),
            ":dataCompensacao" => $this->getdataCompensacao(),
            ":nBoleto" => $this->getnBoleto(),
            ":formaPagamento" => $this->getformaPagamento(),
            ":parcelas" => $this->getparcelas(),
            ":referencia" => $this->getreferencia(),
            ":formaEnvio" => $this->getformaEnvio(),
            ":enviadoPor" => $this->getenviadoPor(),
            ":alteradoPor" => $_SESSION["User"]["nome"],
            ":alteradoEm" => date('Y-m-d H:i')
        ));
        $this->setData($results[0]);
    }

    /* Deleta o cadastro de um recebimento */
    public function delete()
    {
        $sql = new Sql();
        $sql->select("CALL sp_recebimentos_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

}

?>