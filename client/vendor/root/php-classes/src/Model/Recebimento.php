<?php

/*
* Classe responsável por todas as ações
* relacionadas aos recebimentos da CVA
*/

namespace Root\Model;

use \Root\DB\Sql;
use \Root\Model;

class Recebimento extends Model {

    /* Lsita todos os recebimentos cadastrados do mês*/
    public static function listAll($mes, $ano)
    {

        $sql = new Sql();

        $query = "SELECT
                    tb_clientes.nomeCliente as cliente,
                    tb_recebimentos.*
                FROM tb_recebimentos
                    LEFT JOIN tb_clientes ON tb_clientes.id = tb_recebimentos.idcliente
                WHERE tb_recebimentos.mes = :mesAtual
                AND tb_recebimentos.ano = :anoAtual
                ORDER BY tb_recebimentos.dataRecebimento DESC;";

        return $sql->select($query, array(
            ":mesAtual" => $mes,
            ":anoAtual" => $ano
        ));

    }

    /* Salva o cadastro de um recebimento */
    public function save()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_recebimentos_save(:dataRecebimento, :idcliente, :valorBoleto, :dataVencimento, :dataCompensacao, :nBoleto, :formaPagamento, :parcelas, :referencia, :formaEnvio, :enviadoPor, :mes, :ano, :alteradoPor, :alteradoEm)", array(
            ":dataRecebimento" => $this->getdataRecebimento(),
            ":idcliente" => (int)$this->getcliente(),
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

        $results = $sql->select("SELECT * FROM tb_recebimentos WHERE id = :id",
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
                    tb_recebimentos.*
                FROM tb_recebimentos
                    JOIN tb_clientes ON tb_recebimentos.idcliente = :id
                ORDER BY tb_recebimentos.dataRecebimento DESC;";

        return $sql->select($query, array(
            ":id" => $id
        ));

    }

    /* Atualiza o cadastro de um recebimento */
    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_recebimentos_update(:id, :dataRecebimento, :idcliente, :valorBoleto, :dataVencimento, :dataCompensacao, :nBoleto, :formaPagamento, :parcelas, :referencia, :formaEnvio, :enviadoPor, :alteradoPor, :alteradoEm)", array(
            ":id" => $this->getid(),
            ":dataRecebimento" => $this->getdataRecebimento(),
            ":idcliente" => $this->getcliente(),
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

        var_dump($results);

        // $this->setData($results[0]);

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