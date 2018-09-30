<?php

/*
* Classe responsável por todas as ações
* relacionadas aos clientes da CVA
*/

namespace Root\Model;

use \Root\DB\Sql;
use \Root\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Cliente extends Model {

    /* Lsita todos os militantes cadastrados */
    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_clientes ORDER BY nomeCliente");

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

            $results = $sql->select("CALL sp_clientes_save(:nomeCliente, :contatoLocal, :cpf, :cnpj, :inscricaoEstadual, :telefone, :celular, :cep, :endereco, :bairro, :cidade, :estado, :email, :observacao, :tipo, :alteradoPor, :alteradoEm)", array(
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
                ":observacao" => $this->getobservacao(),
                ":tipo" => $this->gettipo(),
                ":alteradoPor" => $_SESSION["User"]["nome"],
                ":alteradoEm" => date("Y-m-d H:i")
            ));

            $this->setData($results[0]);

            /* Gera um novo usuário de acesso para o cliente */
            function removeAcento($string) {

                return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $string);

            };

            $temp = explode(" ",$this->getnomeCliente());

            $usuario = strtolower($temp[0]) . '.' . strtolower($temp[count($temp)-1]);

            $usuario = removeAcento($usuario);

            $sql->select("INSERT INTO tb_clientes_usuarios (idcliente, nome, usuario, senha) VALUES (:idcliente, :nome, :usuario, :senha)", array(
                ":idcliente" => $this->getid(),
                ":nome" => $this->getnomeCliente(),
                ":usuario" => $usuario,
                ":senha" => md5($usuario . date('dmY'))
            ));

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

        $results = $sql->select("CALL sp_clientes_update(:id, :nomeCliente, :contatoLocal, :cpf, :cnpj, :inscricaoEstadual, :telefone, :celular, :cep, :endereco, :bairro, :cidade, :estado, :email, :observacao, :tipo, :alteradoPor, :alteradoEm)", array(
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

        $sql->select("CALL sp_clientes_delete(:id)", array(
            ":id" => $this->getid()
        ));

    }

}

?>