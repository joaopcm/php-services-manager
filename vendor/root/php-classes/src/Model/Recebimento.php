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

        return $sql->select("SELECT * FROM tb_recebimentos WHERE mes = :mesAtual AND ano = :anoAtual ORDER BY dataVencimento", array(
            ":mesAtual" => $mes,
            ":anoAtual" => $ano
        ));

    }

    /* Salva o cadastro de um recebimento */
    public function save()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_recebimentos_save(:dataRecebimento, :fornecedor, :valorBoleto, :dataVencimento, :dataCompensacao, :nBoleto, :formaPagamento, :quantidade, :referente, :formaEnvio, :enviadoPor, :mes, :ano, :alteradoPor, :alteradoEm)", array(
            ":dataRecebimento" => $this->getdataRecebimento(),
            ":fornecedor" => $this->getfornecedor(),
            ":valorBoleto" => $this->getvalorBoleto(),
            ":dataVencimento" => $this->getdataVencimento(),
            ":dataCompensacao" => $this->getdataCompensacao(),
            ":nBoleto" => $this->getnBoleto(),
            ":formaPagamento" => $this->getformaPagamento(),
            ":quantidade" => $this->getquantidade(),
            ":referente" => $this->getreferente(),
            ":formaEnvio" => $this->getformaEnvio(),
            ":enviadoPor" => $this->getenviadoPor(),
            ":mes" => date('m'),
            ":ano" => date('Y'),
            ":alteradoPor" => $_SESSION["User"]["nome"],
            ":alteradoEm" => date('d/m/Y H:i')
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

    /* Atualiza o cadastro de um recebimento */
    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_recebimentos_update(:id, :dataRecebimento, :fornecedor, :valorBoleto, :dataVencimento, :dataCompensacao, :nBoleto, :formaPagamento, :quantidade, :referente, :formaEnvio, :enviadoPor, :alteradoPor, :alteradoEm)", array(
            ":id" => $this->getid(),
            ":dataRecebimento" => $this->getdataRecebimento(),
            ":fornecedor" => $this->getfornecedor(),
            ":valorBoleto" => $this->getvalorBoleto(),
            ":dataVencimento" => $this->getdataVencimento(),
            ":dataCompensacao" => $this->getdataCompensacao(),
            ":nBoleto" => $this->getnBoleto(),
            ":formaPagamento" => $this->getformaPagamento(),
            ":quantidade" => $this->getquantidade(),
            ":referente" => $this->getreferente(),
            ":formaEnvio" => $this->getformaEnvio(),
            ":enviadoPor" => $this->getenviadoPor(),
            ":alteradoPor" => $_SESSION["User"]["nome"],
            ":alteradoEm" => date('d/m/Y H:i')
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