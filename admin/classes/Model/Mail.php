<?php

/*
* Classe responsável por todas as ações
* relacionadas a envio de e-mails
*/

namespace CVA\Model;

define('MAIL_USERNAME', getenv('MAIL_USERNAME'));
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD'));
define('MAIL_PORT', getenv('MAIL_PORT'));

use PHPMailer\PHPMailer\PHPMailer;

class Mail {

  private $mail;

  /* Configura a conexão do e-mail e trata o tipo de envio */
  public function __construct($data, $kind, $to)
  {
    $this->mail = new PHPMailer(true);
    $this->mail = new PHPMailer(true);
    $this->mail->SMTPDebug = 2;
    $this->mail->CharSet = 'UTF-8';
    $this->mail->isSMTP();
    $this->mail->Host = 'smtp.gmail.com';
    $this->mail->SMTPAuth = true;
    $this->mail->Username = MAIL_USERNAME;
    $this->mail->Password = MAIL_PASSWORD;
    $this->mail->SMTPSecure = 'tls';
    $this->mail->Port = MAIL_PORT;
    $this->mail->setFrom(MAIL_USERNAME, 'CVA Climatização');
    switch ($kind) {
      case 'first_login':
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/views/emails/login.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%usuario%', $data['username'], $body);
        $body = str_replace('%senha%', $data['password'], $body);
        try {
          $this->mail->addAddress($to, $data['name']);
          $this->mail->isHTML(true);
          $this->mail->Subject = "Aqui está sua conta de acesso, " . $data['name']. "!";
          $this->mail->MsgHTML($body);
          $this->mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . "/assets/img/icons/logo-completa-transparente.png", "logo");
          $this->mail->AltBody = 'Você agora faz parte dos nossos clientes!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-maill não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 'login_deleted':
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/views/emails/account-deleted.html");
        $body = str_replace('%nome%', $data['name'], $body);
        try {
          $this->mail->addAddress($to, $data['name']);
          $this->mail->isHTML(true);
          $this->mail->Subject = "Sua conta foi deletada, " . $data['name']. "!";
          $this->mail->MsgHTML($body);
          $this->mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . "/assets/img/icons/logo-completa-transparente.png", "logo");
          $this->mail->AltBody = 'Você não faz parte mais dos nossos clientes. Mas esperamos um dia voltar a trabalhar com você!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-maill não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 'new_protocol':
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/views/emails/protocolo.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%protocolo%', $data['protocol'], $body); 
        $body = str_replace('%servico%', $data['service'], $body);
        try {
          $this->mail->addAddress($to, $data['name']);
          $this->mail->isHTML(true);
          $this->mail->Subject = "Protocolo de acompanhamento do serviço de " . $data['service'] . ".";
          $this->mail->MsgHTML($body);
          $this->mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . "/assets/img/icons/logo-completa-transparente.png", "logo");
          $this->mail->AltBody = 'Você fechou um serviço com a CVA Climatização!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-maill não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 'update_protocol':
        $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/views/emails/update-protocol.html");
        $body = str_replace('%nome%', $data['name'], $body);
        $body = str_replace('%protocolo%', $data['protocol'], $body); 
        $body = str_replace('%servico%', $data['service'], $body);
        try {
          $this->mail->addAddress($to, $data['name']);
          $this->mail->isHTML(true);
          $this->mail->Subject = "Protocolo referente ao serviço de " . $data['service'] . " foi atualizado.";
          $this->mail->MsgHTML($body);
          $this->mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . "/assets/img/icons/logo-completa-transparente.png", "logo");
          $this->mail->AltBody = 'O serviço que você contratou está em andamento!';
          $this->mail->send();
        } catch (Exception $e) {
          throw new Exception("O e-maill não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
        }
        break;
      case 'new_payment':
      $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/views/emails/pagamento.html");
      $body = str_replace('%nome%', $data['name'], $body);
      $body = str_replace('%protocolo%', $data['protocol'], $body);
      $body = str_replace('%servico%', $data['service'], $body);
      try {
        $this->mail->addAddress($to, $data['name']);
        $this->mail->isHTML(true);
        $this->mail->Subject = "Pagamento referente ao protocolo " . $data['protocol'] . " de serviço de " . $data['service'] . ".";
        $this->mail->MsgHTML($body);
        $this->mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . "/assets/img/icons/logo-completa-transparente.png", "logo");
        $this->mail->AltBody = 'Estamos na última etapa! O pagamento já foi criado.';
        $this->mail->send();
      } catch (Exception $e) {
        throw new Exception("O e-maill não pode ser enviado. Erro: " . $this->mail->ErrorInfo);
      }
        break;
      default:
        return false;
        break;
    }
  }

}

?>