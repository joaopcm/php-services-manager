<?php

namespace Sourcess\Model;

use \Sourcess\DB\Sql;

class Mail {

  private $mail;

  // Código dos processos
  // 100 - Envia os dados de acesso para o cliente
  // 200 - Envia o aviso de criação de protocolo para o cliente
  // 300 - Envia o aviso de atualização de um protocolo para o cliente
  // 400 - Envia o aviso de finalização de um protocolo para o cliente
  // 500 - Envia o aviso de geração de um pagamento para o cliente
  // 600 - Envia o aviso de exclusão de conta para o cliente
  // 700 - Envia e-mails para todos os clientes

  public function __construct($type, $data)
  {
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom(APP_MAIL, APP_NAME);
    $email->addTo($data['to'], $data['name']);
    switch ($type) {
        case 100:
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/dados-de-acesso.html");
            $body = str_replace('%app_name%', APP_NAME, $body);
            $body = str_replace('%nome%', $data['name'], $body);
            $body = str_replace('%usuario%', $data['username'], $body);
            $body = str_replace('%senha%', $data['password'], $body);
            $email->setSubject("Aqui está sua conta de acesso, " . $data['name']. "!");
            break;
        case 200:
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/novo-protocolo.html");
            $body = str_replace('%nome%', $data['name'], $body);
            $body = str_replace('%protocolo%', $data['protocol'], $body); 
            $body = str_replace('%servico%', $data['service'], $body);
            $body = str_replace('%app_name%', APP_NAME, $body);
            $email->setSubject("Protocolo de acompanhamento do serviço de " . $data['service'] . ".");
            break;
        case 300:
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/protocolo-atualizado.html");
            $body = str_replace('%nome%', $data['name'], $body);
            $body = str_replace('%protocolo%', $data['protocol'], $body); 
            $body = str_replace('%servico%', $data['service'], $body);
            $body = str_replace('%app_name%', APP_NAME, $body);
            $email->setSubject("Protocolo referente ao serviço de " . $data['service'] . " foi atualizado.");
            break;
        case 400:
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/protocolo-finalizado.html");
            $body = str_replace('%nome%', $data['name'], $body);
            $body = str_replace('%protocolo%', $data['protocol'], $body); 
            $body = str_replace('%idcliente%', $data['id'], $body);
            $body = str_replace('%servico%', $data['service'], $body);
            $body = str_replace('%app_name%', APP_NAME, $body);
            $email->setSubject("Protocolo " . $data['protocol'] . " foi finalizado!");
            break;
        case 500:
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/novo-pagamento.html");
            $body = str_replace('%nome%', $data['name'], $body);
            $body = str_replace('%protocolo%', $data['protocol'], $body);
            $body = str_replace('%servico%', $data['service'], $body);
            $body = str_replace('%app_name%', APP_NAME, $body);
            $email->setSubject("Pagamento referente ao protocolo " . $data['protocol'] . " de serviço de " . $data['service'] . ".");
            break;
        case 600:
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/dados-de-acesso-deletados.html");
            $body = str_replace('%nome%', $data['name'], $body);
            $body = str_replace('%app_name%', APP_NAME, $body);
            $email->setSubject("Sua conta foi deletada, " . $data['name']. "!");
            break;
        case 700;
            $sql = new Sql();
            $emails = $sql->select("SELECT email, nomeCliente AS nome FROM tb_clientes WHERE email != ''");
            foreach ($emails as $indice => $array) {
                $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/padrao.html");
                $body = str_replace('%nome%', $emails[$indice]['nome'], $body);
                $body = str_replace('%body%', $data['html'], $body);
                $body = str_replace('%app_name%', APP_NAME, $body);
                $email->setSubject($data['subject']);
                $email->addTo($emails[$indice]['email'], $emails[$indice]['nome']);
                $email->addContent(
                    "text/html", $body
                );
                $sendgrid = new \SendGrid(SENDGRID_API_KEY);
                try {
                    $response = $sendgrid->send($email);
                    print $response->statusCode() . "\n";
                    print_r($response->headers());
                    print $response->body() . "\n";
                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }
            exit;
            break;
    }
    $email->addContent(
        "text/html", $body
    );
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  }

  /**
   * Realiza o envio de e-mails como mala direta
   */
  public static function malaDireta($data)
  {
    $sql = new Sql();
    $destinos = $sql->select("SELECT email, nomeCliente AS nome FROM tb_clientes WHERE email != ''");
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom(APP_MAIL, APP_NAME);
    foreach ($destinos as $indice => $array) { // Percorre o array de e-mails
        $email->addTo($destinos[$indice]['email'], $destinos[$indice]['nome']);
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/padrao.html");
        $body = str_replace('%nome%', $destinos[$indice]['nome'], $body);
        $body = str_replace('%body%', $data['html'], $body);
        $body = str_replace('%app_name%', APP_NAME, $body);
        $email->setSubject($data['subject']);
        $email->addContent(
            "text/html", $body
        );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
  }

}