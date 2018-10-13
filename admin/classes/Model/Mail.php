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

  /* Configura a conexão do e-mail */
  public function __construct()
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
  }

  /* Realiza o envio de e-mails relacionsados à usuários e senhas */
  public function sendLogin($name, $username, $password, $to)
  {
    $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/views/emails/login.html");
    $body = str_replace('%nome%', $name, $body);
    $body = str_replace('%usuario%', $username, $body); 
    $body = str_replace('%senha%', $password, $body);
    try {
      $this->mail->addAddress($to, $name);
      $this->mail->isHTML(true);
      $this->mail->Subject = "Aqui está sua conta de acesso, $name!";
      $this->mail->MsgHTML($body);
      $this->mail->AltBody = 'Você agora faz parte dos nossos clientes!';
      $this->mail->send();
    } catch (Exception $e) {
      throw new Exception("A mensagem não pode ser enviada. Erro: " . $this->mail->ErrorInfo, 1);
    }
  }

  /* Realiza o envio de e-mails relacionados à protocolos */
  public function sendProtocol($name, $service, $protocol, $to)
  {
    $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/views/emails/protocolo.html");
    $body = str_replace('%nome%', $name, $body);
    $body = str_replace('%protocolo%', $protocol, $body); 
    $body = str_replace('%servico%', $service, $body);
    try {
      $this->mail->addAddress($to, $name);
      $this->mail->isHTML(true);
      $this->mail->Subject = "Protocolo de acompanhamento do serviço de $service.";
      $this->mail->MsgHTML($body);
      $this->mail->AltBody = 'Você fechou um serviço com a CVA Climatização!';
      $this->mail->send();
    } catch (Exception $e) {
      throw new Exception("A mensagem não pode ser enviada. Erro: " . $this->mail->ErrorInfo, 1);
    }
  }

}

?>