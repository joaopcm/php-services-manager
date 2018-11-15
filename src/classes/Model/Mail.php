<?php

namespace Sourcess\Model;

use PHPMailer\PHPMailer\PHPMailer;
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
    // Configurações estáticas
    $this->mail = new PHPMailer(true);
    $this->mail = new PHPMailer(true);
    $this->mail->SMTPDebug = 2;
    $this->mail->CharSet = 'UTF-8';
    $this->mail->isSMTP();
    $this->mail->isHTML(true);
    $this->mail->Host = 'smtp.gmail.com';
    $this->mail->SMTPAuth = true;
    $this->mail->Username = MAIL_USERNAME;
    $this->mail->Password = MAIL_PASSWORD;
    $this->mail->SMTPSecure = 'tls';
    $this->mail->Port = MAIL_PORT;
    $this->mail->setFrom(MAIL_USERNAME, APP_NAME);
    $this->mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . "/assets/img/admin/icons/logo-fundo-transparente-com-slogan.png", "logo");
    // Configurações dinâmicas
    switch ($type) {
      case 100: // 100 - Envia os dados de acesso para o cliente
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/dados-de-acesso.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%usuario%', $data['username'], $body);
        $body = str_replace('%senha%', $data['password'], $body);
        $body = str_replace('%app_name%', APP_NAME, $body);
        try {
          $this->mail->addAddress($data['to'], $data['name']);
          $this->mail->Subject = "Aqui está sua conta de acesso, " . $data['name']. "!";
          $this->mail->MsgHTML($body);
          $this->mail->AltBody = 'Você agora faz parte dos nossos clientes!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-mail não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 200: // 200 - Envia o aviso de criação de protocolo para o cliente
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/novo-protocolo.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%protocolo%', $data['protocol'], $body); 
        $body = str_replace('%servico%', $data['service'], $body);
        $body = str_replace('%app_name%', APP_NAME, $body);
        try {
          $this->mail->addAddress($data['to'], $data['name']);
          $this->mail->Subject = "Protocolo de acompanhamento do serviço de " . $data['service'] . ".";
          $this->mail->MsgHTML($body);
          $this->mail->AltBody = 'Você fechou um serviço com ' . APP_NAME . '!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-mail não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 300: // 300 - Envia o aviso de atualização de um protocolo para o cliente
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/protocolo-atualizado.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%protocolo%', $data['protocol'], $body); 
        $body = str_replace('%servico%', $data['service'], $body);
        $body = str_replace('%app_name%', APP_NAME, $body);
        try {
          $this->mail->addAddress($data['to'], $data['name']);
          $this->mail->Subject = "Protocolo referente ao serviço de " . $data['service'] . " foi atualizado.";
          $this->mail->MsgHTML($body);
          $this->mail->AltBody = 'O serviço que você contratou está em andamento!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-mail não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 400: // 400 - Envia o aviso de finalização de um protocolo para o cliente
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/protocolo-finalizado.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%protocolo%', $data['protocol'], $body); 
        $body = str_replace('%idcliente%', $data['id'], $body);
        $body = str_replace('%servico%', $data['service'], $body);
        $body = str_replace('%app_name%', APP_NAME, $body);
        try {
          $this->mail->addAddress($data['to'], $data['name']);
          $this->mail->Subject = "Protocolo " . $data['protocol'] . " foi finalizado!";
          $this->mail->MsgHTML($body);
          $this->mail->AltBody = 'Tudo feito! Que tal responder uma pesquisa de satisfação?';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-mail não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 500: // 500 - Envia o aviso de geração de um pagamento para o cliente
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/novo-pagamento.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%protocolo%', $data['protocol'], $body);
        $body = str_replace('%servico%', $data['service'], $body);
        $body = str_replace('%app_name%', APP_NAME, $body);
        try {
          $this->mail->addAddress($data['to'], $data['name']);
          $this->mail->Subject = "Pagamento referente ao protocolo " . $data['protocol'] . " de serviço de " . $data['service'] . ".";
          $this->mail->MsgHTML($body);
          $this->mail->AltBody = 'Estamos na última etapa! O pagamento já foi criado.';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-mail não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 600: // 600 - Envia o aviso de exclusão de conta para o cliente
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/dados-de-acesso-deletados.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%app_name%', APP_NAME, $body);
        try {
          $this->mail->addAddress($data['to'], $data['name']);
          $this->mail->Subject = "Sua conta foi deletada, " . $data['name']. "!";
          $this->mail->MsgHTML($body);
          $this->mail->AltBody = 'Você não faz parte mais dos nossos clientes. Mas esperamos um dia voltar a trabalhar com você!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-mail não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 700: // 700 - Envia e-mails para todos os clientes
        $sql = new Sql();
        $emails = $sql->select("SELECT email, nomeCliente AS nome FROM tb_clientes WHERE email != ''");
        foreach ($emails as $indice => $array) { // Percorre o array de e-mails
          $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/emails/padrao.html");
          $body = str_replace('%nome%', $emails[$indice]['nome'], $body);
          $body = str_replace('%body%', $data['html'], $body);
          $body = str_replace('%app_name%', APP_NAME, $body);
          try {
            $this->mail->addAddress($emails[$indice]['email'], $emails[$indice]['nome']);
            $this->mail->Subject = $data['subject'];
            $this->mail->MsgHTML($body);
            $this->mail->AltBody = 'Temos uma mensagem especialmente para você!';
            $this->mail->send();
          } catch (Exception $e) {
            throw new Exception("O e-mail não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
          }  
         }
        break;
    }
  }

}

?>