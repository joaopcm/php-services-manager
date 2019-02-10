<?php

namespace Sourcess\Model;

use \Sourcess\DB\Sql;
use \Sourcess\Model\Model;
use \Sourcess\Model\Mail;

class Cliente extends Model {

    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT c.*, cu.usuario AS usuario, cu.senha AS senha FROM tb_clientes AS c JOIN tb_clientes_usuarios AS cu ON cu.idcliente = c.id ORDER BY nomeCliente");
    }

    public function getLocale($cep)
    {
        $ch = curl_init("https://viacep.com.br/ws/$cep/json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $data = json_decode($response, true);
        return $data;
    }

    public function save()
    {
        $sql = new Sql();
        if ($this->getcnpj() != "")
        {
            $checkCnpj = $sql->select("SELECT * FROM tb_clientes WHERE cnpj = :cpf", array(":cpf" => $this->getcnpj()));
        }
        if ($this->getcpf() != "")
        {
            $checkCpf = $sql->select("SELECT * FROM tb_clientes WHERE cpf = :cpf", array(":cpf" => $this->getcpf()));
        }
        if (isset($checkCpf[0]) || isset($checkCnpj[0]))
        {
            echo '<script language="javascript">alert("Este CPF/CNPJ já está cadastrado na lista de clientes."); window.location = "/adicionar/cliente"</script>';
            die();
        } else {
            $results = $sql->select("CALL sp_clientes_save(:nomeCliente, :contatoLocal, :cpf, :cnpj, :inscricaoEstadual, :telefone, :celular, :cep, :endereco, :bairro, :cidade, :estado, :email, :emails, :observacao, :tipo, :alteradoPor, :alteradoEm)", array(
                ":nomeCliente" => $this->getnomeCliente(),
                ":contatoLocal" => $this->getcontatoLocal(),
                ":cpf" => $this->getcpf(),
                ":cnpj" => $this->getcnpj(),
                ":inscricaoEstadual" => $this->getinscricaoEstadual(),
                ":telefone" => $this->gettelefone(),
                ":celular" => $this->getcelular(),
                ":cep" => $this->getcep(),
                ":endereco" => $this->getendereco(),
                ":bairro" => $this->getbairro(),
                ":cidade" => $this->getcidade(),
                ":estado" => $this->getestado(),
                ":email" => $this->getemail(),
                ":emails" => $this->getemails(),
                ":observacao" => $this->getobservacao(),
                ":tipo" => $this->gettipo(),
                ":alteradoPor" => $_SESSION["User"]["nome"],
                ":alteradoEm" => date("Y-m-d H:i")
            ));
            var_dump($results[0]);
            die();
            $this->setData($results[0]);
            $this->userGenerator();
        }
    }

    private function userGenerator()
    {
        $sql = new Sql();
        /* Trata a string para gerar o usuário */
        function removeAcento($string) {
            return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $string);
        };
        $temp = explode(" ",$this->getnomeCliente());
        $usuario = strtolower($temp[0]) . '.' . strtolower($temp[count($temp)-1]);
        $usuario = removeAcento($usuario);
        $senha = substr(md5($usuario . date('d/m/Y-m-i')), 24);
        $sql->select("INSERT INTO tb_clientes_usuarios (idcliente, nome, usuario, senha) VALUES (:idcliente, :nome, :usuario, :senha)", array(
            ":idcliente" => $this->getid(),
            ":nome" => $this->getnomeCliente(),
            ":usuario" => $usuario,
            ":senha" => $senha
        ));
        if ($this->getemail() != '')
        {
            $data = array(
                "name" => $this->getnomeCliente(),
                "username" => $usuario,
                "password" => $senha,
                "to" => $this->getemail()
            );
            $mail = new Mail(100, $data);
        }
    }

    public function get($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_clientes WHERE id = :id",
        array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    public function update()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_clientes_update(:id, :nomeCliente, :contatoLocal, :cpf, :cnpj, :inscricaoEstadual, :telefone, :celular, :cep, :endereco, :bairro, :cidade, :estado, :email, :emails, :observacao, :tipo, :alteradoPor, :alteradoEm)", array(
            ":id" => $this->getid(),
            ":nomeCliente" => $this->getnomeCliente(),
            ":contatoLocal" => $this->getcontatoLocal(),
            ":cpf" => $this->getcpf(),
            ":cnpj" => $this->getcnpj(),
            ":inscricaoEstadual" => $this->getinscricaoEstadual(),
            ":telefone" => $this->gettelefone(),
            ":celular" => $this->getcelular(),
            ":cep" => $this->getcep(),
            ":endereco" => $this->getendereco(),
            ":bairro" => $this->getbairro(),
            ":cidade" => $this->getcidade(),
            ":estado" => $this->getestado(),
            ":email" => $this->getemail(),
            ":emails" => $this->getemails(),
            ":observacao" => $this->getobservacao(),
            ":tipo" => $this->gettipo(),
            ":alteradoPor" => $_SESSION["User"]["nome"],
            ":alteradoEm" => date("Y-m-d H:i")
        ));
        $this->setData($results[0]);
    }

    public function delete()
    {
        $sql = new Sql();
        $query = "SELECT e.anexo FROM tb_protocolos_estado AS e JOIN tb_protocolos AS p ON e.idprotocolo = p.id JOIN tb_clientes AS c ON p.idcliente = c.id WHERE c.id = :id AND e.anexo != ''";
        $anexos = $sql->select($query, array(":id" => $this->getid()));
        if ($anexos != NULL && $anexos != '')
        {
            foreach ($anexos as $key => $value) {
                $anexo = $value['anexo'];
                unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $anexo);
            }
        }
        if ($this->getemail() != '')
        {
            $data = array(
                "name" => $this->getnomeCliente(),
                "to" => $this->getemail()
            );
            $mail = new Mail(600, $data);
        }
        $sql->select("CALL sp_clientes_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

    public function getProtocols()
    {
        $sql = new Sql();
        $query = "SELECT p.id AS id, p.numero AS protocolo, s.titulo AS servico FROM tb_protocolos AS p JOIN tb_clientes AS c ON p.idcliente = c.id JOIN tb_servicos AS s ON p.idservico = s.id WHERE c.id = :id";
        $response = $sql->select($query, array(
            ":id" => $this->getid()
        ));
        return $response;
    }

}

?>