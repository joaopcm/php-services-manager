<?php

namespace Sourcess\Model;

use \Sourcess\DB\Sql;
use \Sourcess\Model\Model;
use \Sourcess\Model\Mail;

class Protocolo extends Model {

    public static function listAll()
    {
        $sql = new Sql();
        $query = "SELECT c.nomeCliente AS cliente, c.id AS idcliente, p.numero AS codigo, p.id AS id, p.dataCadastro AS data, s.titulo AS servico, p.finalized AS finalized FROM tb_clientes AS c JOIN tb_protocolos AS p ON p.idcliente = c.id LEFT JOIN tb_servicos AS s ON p.idservico = s.id ORDER BY p.dataCadastro DESC, p.finalized ASC";
        return $sql->select($query);
    }

    public function save()
    {
        $sql = new Sql();
        $protocol = 'SRCPROTOCOL-' . strtoupper(substr(md5($this->getcliente() . date('dHis')), 24));
        $results = $sql->select("CALL sp_protocolos_save(:idcliente, :idservico, :numero)", array(
            ":idcliente" => $this->getcliente(),
            ":idservico" => $this->getservico(),
            ":numero" => $protocol
        ));
        $this->setData($results[0]);
        if ($this->getemail() !== '')
        {
            $data = array(
                "name" => $this->getcliente(),
                "protocol" => $protocol,
                "service" => $this->getservico(),
                "to" => $this->getemail()
            );
            $mail = new Mail(200, $data);
        }
    }

    public function saveStatus()
    {
        $sql = new Sql();
        if ($_FILES['fileUpload']['error'] !== 4)
        {
            $file = $_FILES['fileUpload'];
            $ext = strtolower(substr($file['name'], -4));
            $new_name = date("Y.m.d-H.i.s") . $ext;
            $dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads";
            if (!is_dir($dir)) mkdir($dir);
            if (!move_uploaded_file($file['tmp_name'], $dir . DIRECTORY_SEPARATOR . $new_name)) {
                throw new Exception('Erro - Não foi possível realizar o upload.');
            }
        } else {
            $new_name = null;
        }
        $sql->select("CALL sp_estados_save(:idprotocolo, :estado, :data, :anexo)", array(
            ":idprotocolo" => $this->getid(),
            ":estado" => $this->getpestado(),
            ":data" => $this->getpdata(),
            ":anexo" => $new_name
        ));
        if ($this->getemail() != ''){
            $data = array(
                "name" => $this->getcliente(),
                "protocol" => $this->getcodigo(),
                "service" => $this->getservico(),
                "to" => $this->getemail()
            );
            $mail = new Mail(300, $data);
        }
    }

    public function deleteStatus($id)
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_protocolos_estado WHERE id = :id", array(
            ":id" => $id
        ));
        $this->setData($result);
        $sql->select("CALL sp_estados_delete(:id)", array(
            ":id" => $id
        ));
        if ($result[0]['anexo'] != null) unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $result[0]['anexo']);
    }

    public function get($id)
    {
        $sql = new Sql();
        $query = "SELECT c.id AS idcliente, c.nomeCliente AS cliente, c.email AS email, c.endereco AS endereco, c.bairro AS bairro, c.cidade AS cidade, c.estado AS estado, c.cep AS cep, p.numero AS codigo, p.finalized AS finalized, p.id AS id, p.dataCadastro AS dataCadastro, s.titulo AS servico FROM tb_protocolos AS p JOIN tb_clientes AS c ON p.idcliente = c.id LEFT JOIN tb_servicos AS s ON p.idservico = s.id WHERE p.id = :id ORDER BY p.dataCadastro DESC";
        $results = $sql->select($query, array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    public function getByCode($code, $filter = false)
    {
        $sql = new Sql();
        switch ($filter) {
            case false:
                $query = "SELECT
                            e.estado AS estado,
                            e.data AS data,
                            e.anexo AS anexo,
                            c.id AS idcliente,
                            p.id AS idprotocolo,
                            s.titulo AS servico,
                            p.numero AS codigo
                        FROM tb_protocolos AS p
                            JOIN tb_protocolos_estado AS e ON e.idprotocolo = p.id
                            JOIN tb_clientes AS c ON p.idcliente = c.id
                            JOIN tb_servicos AS s ON p.idservico = s.id
                        WHERE p.numero = :codigo
                        ORDER BY e.data DESC";
                break;
            case true:
                $query = "SELECT
                            e.estado AS estado,
                            e.data AS data,
                            e.anexo AS anexo,
                            c.id AS idcliente,
                            p.id AS idprotocolo,
                            s.titulo AS servico,
                            p.numero AS codigo
                        FROM tb_protocolos AS p
                            LEFT JOIN tb_protocolos_estado AS e ON e.idprotocolo = p.id
                            JOIN tb_clientes AS c ON p.idcliente = c.id
                            JOIN tb_servicos AS s ON p.idservico = s.id
                        WHERE p.numero = :codigo
                            AND NOT EXISTS (
                                SELECT * FROM tb_pesquisa_satisfacao AS ps JOIN tb_protocolos AS p ON ps.id_protocolo = p.id WHERE p.numero = :codigo
                            )
                        ORDER BY e.data DESC";
                break;
        }
        
        $results = $sql->select($query, array(
            ":codigo" => $code
        ));
        return $results;
    }

    public function getByClient($id)
    {
        $sql = new Sql();
        $query = "SELECT p.id AS idprotocolo, p.numero AS codigo, p.dataCadastro AS dataCadastro, s.titulo AS servico, r.valorBoleto AS valorBoleto, r.dataRecebimento AS dataRecebimento, r.dataCompensacao AS dataCompensacao, r.dataVencimento AS dataVencimento, r.nBoleto AS nBoleto, r.formaPagamento AS formaPagamento, r.formaEnvio AS formaEnvio, r.parcelas AS parcelas FROM tb_protocolos AS p LEFT JOIN tb_servicos AS s ON p.idservico = s.id JOIN tb_clientes AS c ON p.idcliente = c.id LEFT JOIN tb_recebimentos AS r ON r.idprotocolo = p.id WHERE c.id = :id ORDER BY p.dataCadastro DESC";
        $results = $sql->select($query, array(
            ":id" => $id
        ));
        return $results;
    }

    public function getRecebimento()
    {
        $sql = new Sql();
        $query = "SELECT c.nomeCliente AS cliente, r.* FROM tb_protocolos AS p JOIN tb_clientes AS c ON p.idcliente = c.id JOIN tb_recebimentos AS r ON r.idprotocolo = :id";
        $results = $sql->select($query, array(
            ":id" => $this->getid()
        ));
        return $results[0];
    }

    public function getStatus() 
    {
        $sql = new Sql();
        $query = "SELECT e.id AS id, e.estado AS estado, e.data AS data, e.anexo AS anexo FROM tb_protocolos AS p JOIN tb_protocolos_estado AS e ON e.idprotocolo = p.id WHERE p.id = :id ORDER BY e.data DESC";
        $results = $sql->select($query, array(
            ":id" => $this->getid()
        ));
        return $results;
    }

    public function delete()
    {
        $sql = new Sql();
        $query = "SELECT e.anexo FROM tb_protocolos_estado AS e JOIN tb_protocolos AS p ON e.idprotocolo = p.id WHERE p.id = :id AND e.anexo != ''";
        $results = $sql->select($query,
            array(
            ":id" => $this->getid()
        ));
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
        if ($results) {
            foreach ($results as $key => $value) {
                $anexo = $value['anexo'];
                unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $anexo);
            }
        }
        $sql->select("CALL sp_protocolos_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

    public function download($anexo)
    {
        $sql = new Sql();
        set_time_limit(0);
        $exists_in_db = $sql->select("SELECT anexo FROM tb_protocolos_estado WHERE anexo = :anexo", array(
            ":anexo" => $anexo
        ));
        if ($exists_in_db > 0) {
            $filepath = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $anexo;
            if (!file_exists($filepath)) {
            echo "<script type='text/javascript'>alert('Este arquivo não está em nossos servidores.'); window.location.href = '/administrar/protocolos';</script>";
            exit;
            }
            $newname = 'anexo-' . $anexo;
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename="' . $newname . '"');
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($filepath));
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Expires: 0');
            readfile($filepath);
        } else {
            echo "<script type='text/javascript'>alert('Este arquivo não está em nossos servidores.'); window.location.href = '/administrar/protocolos';</script>";
            exit;
        }
    }

    public function finalize()
    {
        $sql = new Sql();
        $query = "CALL sp_protocolos_finalize (:id)";
        $sql->select($query, array(
            ':id' => $this->getid()
        ));
        if ($this->getemail() !== '')
        {
            $data = array(
                "id" => $this->getidcliente(),
                "name" => $this->getcliente(),
                "protocol" => $this->getcodigo(),
                "service" => $this->getservico(),
                "to" => $this->getemail()
            );
            $mail = new Mail(400, $data);
        }
    }

    public function avaliar()
    {
        $sql = new Sql();
        $sql->select("INSERT INTO tb_pesquisa_satisfacao (id_protocolo, obs, nota) VALUES (:id_protocolo, :obs, :nota)", array(
            ':id_protocolo' => $this->getidprotocolo(),
            ':nota' => $this->getavaliacao(),
            ':obs' => $this->getobs()
        ));
    }

}

?>