<?php

/*
* Classe responsável por todas as ações
* relacionadas a envio de e-mails
*/

namespace Root\Model;

define('MAIL_USERNAME', getenv('MAIL_USERNAME'));
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD'));
define('MAIL_PORT', getenv('MAIL_PORT'));

use PHPMailer\PHPMailer\PHPMailer;

class Mail {

  /* Realiza o envio de e-mails relacionsados à usuários e senhas */
  public function sendLogin($name, $username, $password, $to)
  {
    $body = file_get_contents('./views/emails/login.html');
    $body = str_replace('%nome%', $name, $body);
    $body = str_replace('%usuario%', $username, $body); 
    $body = str_replace('%senha%', $password, $body);
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 2;
      $mail->CharSet = 'UTF-8';
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = MAIL_USERNAME;
      $mail->Password = MAIL_PASSWORD;
      $mail->SMTPSecure = 'tls';
      $mail->Port = MAIL_PORT;
      $mail->setFrom(MAIL_USERNAME, 'CVA Climatização');
      $mail->addAddress($to, $name);
      $mail->isHTML(true);
      $mail->Subject = "Aqui está sua conta de acesso, $name!";
      $mail->MsgHTML($body);
      $mail->AltBody = 'Você agora faz parte dos nossos clientes!';
      $mail->send();
    } catch (Exception $e) {
      throw new Exception("A mensagem não pode ser enviada. Erro: " . $mail->ErrorInfo, 1);
    }
  }

  /* Realiza o envio de e-mails relacionados à protocolos */
  public function sendProtocol($name, $service, $protocol, $to)
  {
    $body = file_get_contents('./views/emails/protocolo.html');
    $body = str_replace('%nome%', $name, $body);
    $body = str_replace('%protocolo%', $protocol, $body); 
    $body = str_replace('%servico%', $service, $body);
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 2;
      $mail->CharSet = 'UTF-8';
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = MAIL_USERNAME;
      $mail->Password = MAIL_PASSWORD;
      $mail->SMTPSecure = 'tls';
      $mail->Port = MAIL_PORT;
      $mail->setFrom(MAIL_USERNAME, 'CVA Climatização');
      $mail->addAddress($to, $name);
      $mail->isHTML(true);
      $mail->Subject = "Protocolo de acompanhamento do serviço de $service.";
      $mail->MsgHTML($body);
      $mail->AltBody = 'Você fechou um serviço com a CVA Climatização!';
      $mail->send();
    } catch (Exception $e) {
      throw new Exception("A mensagem não pode ser enviada. Erro: " . $mail->ErrorInfo, 1);
    }
  }

}

?>