<?php

/*
* Classe responsável por todas as ações
* relacionadas aos clientes da CVA
*/

namespace CVA\Model;

use \CVA\DB\Sql;
use \CVA\Model;
use \CVA\Model\Mail;

class Cliente extends Model {

    /* Lsita todos os militantes cadastrados */
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT
                                c.*,
                                cu.usuario AS usuario,
                                cu.senha AS senha
                            FROM tb_clientes AS c
                            JOIN tb_clientes_usuarios AS cu ON cu.idcliente = c.id
                            ORDER BY nomeCliente");
    }

    /* Recupera dados de localização de acordo com o CEP */
    public function getLocale($cep)
    {
        $ch = curl_init("https://viacep.com.br/ws/$cep/json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $data = json_decode($response, true);
        return $data;
    }

    /* Salva o cadastro de um cliente */
    public function save()
    {
        $sql = new Sql();
        if ($this->getcnpj() != "")
        {
            $checkCnpj = $sql->select("SELECT * FROM tb_clientes WHERE cnpj = :cpf", array(
                ":cpf" => $this->getcnpj()
            ));
        }
        if ($this->getcpf() != "")
        {
            $checkCpf = $sql->select("SELECT * FROM tb_clientes WHERE cpf = :cpf", array(
                ":cpf" => $this->getcpf()
            ));
        }
        if (isset($checkCpf[0]) || isset($checkCnpj[0]))
        {
            echo '<script language="javascript">';
            echo 'alert("Este CPF/CNPJ já está cadastrado na lista de clientes.");';
            echo 'window.location = "/adicionar/cliente";';
            echo '</script>';
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
            $this->setData($results[0]);
            $this->userGenerator();
        }
    }

    /* Gera um usuário e senha para o cliente cadastrado e envia por e-mail*/
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
        /* Envia para o e-mail do cliente cadastrado seus dados de acesso para o CVA Clientes */
        if ($this->getemail() != '')
        {
            $array = array(
                "name" => $this->getnomeCliente(),
                "username" => $usuario,
                "password" => $senha
            );
            $mail = new Mail($array, "first_login", $this->getemail());
        }
    }

    /* Recupera todos os dados de um cliente pelo ID */
    public function get($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_clientes WHERE id = :id",
        array(
            ":id" => $id
        ));
        $this->setData($results[0]);
    }

    /* Atualiza o cadastro de um cliente */
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

    /* Deleta o cadastro de um cliente */
    public function delete()
    {
        $sql = new Sql();
        if ($this->getemail() != '')
        {
            $array = array(
                "name" => $this->getnomeCliente()
            );
            $mail = new Mail($array, "login_deleted", $this->getemail());
        }
        $sql->select("CALL sp_clientes_delete(:id)", array(
            ":id" => $this->getid()
        ));
    }

    /* Retorna os protocolos do cliente */
    public function getProtocols()
    {
        $sql = new Sql();
        $query = "SELECT
                    p.id AS id,
                    p.numero AS protocolo,
                    s.titulo AS servico
                FROM tb_protocolos AS p
                    JOIN tb_clientes AS c ON p.idcliente = c.id
                    JOIN tb_servicos AS s ON p.idservico = s.id
                WHERE c.id = :id";
        $response = $sql->select($query, array(
            ":id" => $this->getid()
        ));
        return $response;
    }

}

?>