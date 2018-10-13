<?php

/*
* Classe responsável por todas as ações
* relacionadas aos protocolos da CVA
*/

namespace CVA\Model;

use \CVA\DB\Sql;
use \CVA\Model;
use \CVA\Model\Mail;

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
                ORDER BY p.dataCadastro DESC";
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

    /* Salva uma atualização de estado de um protocolo */
    public function saveStatus()
    {
        $sql = new Sql();
        if ($_FILES['fileUpload']['error'] !== 4)
        {
            $file = $_FILES['fileUpload'];
            $ext = strtolower(substr($file['name'], -4));
            $new_name = date("Y.m.d-H.i.s") . $ext;
            $dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
            if (!is_dir($dir)) mkdir($dir);
            if (!move_uploaded_file($file['tmp_name'], $dir . DIRECTORY_SEPARATOR . $new_name)) {
                throw new Exception('CVA Error - Não foi possível realizar o upload.');
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
    }

    /* Deleta um estado de um protocolo */
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

    /* Recupera todos os dados de um recebimento pelo ID */
    public function get($id)
    {
        $sql = new Sql();
        $query = "SELECT
                    c.nomeCliente AS cliente,
                    c.email AS email,
                    c.endereco AS endereco,
                    c.bairro AS bairro,
                    c.cidade AS cidade,
                    c.estado AS estado,
                    c.cep AS cep,
                    p.numero AS codigo,
                    p.id AS id,
                    p.dataCadastro AS dataCadastro,
                    s.titulo AS servico
                FROM tb_protocolos AS p
                    JOIN tb_clientes AS c ON p.idcliente = c.id
                    JOIN tb_servicos AS s ON p.idservico = s.id
                WHERE p.id = :id
                ORDER BY p.dataCadastro DESC";
        $results = $sql->select($query, array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    /* Recupera os estados de acordo com o código do protocolo */
    public function getByCode($code)
    {
        $sql = new Sql();
        $query = "SELECT
                    e.estado AS estado,
                    e.data AS data,
                    e.anexo AS anexo
                FROM tb_protocolos AS p
                    JOIN tb_protocolos_estado AS e ON e.idprotocolo = p.id
                WHERE p.numero = :codigo
                ORDER BY e.data DESC";
        $results = $sql->select($query, array(
            ":codigo" => $code
        ));
        return $results;
    }

    /* Recupera o recebimento de um protocolo */
    public function getRecebimento()
    {
        $sql = new Sql();
        $query = "SELECT
                    c.nomeCliente AS cliente,
                    r.*
                FROM tb_protocolos AS p
                    JOIN tb_clientes AS c ON p.idcliente = c.id
                    JOIN tb_recebimentos AS r ON r.idprotocolo = :id";
        $results = $sql->select($query, array(
            ":id" => $this->getid()
        ));
        return $results[0];
    }

    /* Recupera todos os estados de um protocolo */
    public function getStatus() 
    {
        $sql = new Sql();
        $query = "SELECT
                    e.id AS id,
                    e.estado AS estado,
                    e.data AS data,
                    e.anexo AS anexo
                FROM tb_protocolos AS p
                    JOIN tb_protocolos_estado AS e ON e.idprotocolo = p.id
                WHERE p.id = :id
                ORDER BY e.data DESC";
        $results = $sql->select($query, array(
            ":id" => $this->getid()
        ));
        return $results;
    }

    /* Deleta o cadastro de um protocolo */
    public function delete()
    {
        $sql = new Sql();
        $query = "SELECT
                    e.anexo
                FROM tb_protocolos_estado AS e
                    JOIN tb_protocolos AS p ON e.idprotocolo = p.id
                WHERE p.id = :id
                    AND e.anexo != ''";
        $results = $sql->select($query,
            array(
            ":id" => $this->getid()
        ));
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
        var_dump($results);
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

    /* Faz o download de um anexo */
    public function download($anexo) {
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
            $newname = 'anexo-cva-' . $anexo;
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

}

?>