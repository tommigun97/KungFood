<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPmailer/src/Exception.php';
require '../../PHPmailer/src/PHPMailer.php';
require '../../PHPmailer/src/SMTP.php';


function send_mail_registration($nome, $mail_destinatario)
{
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "kungfoodcompany@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "fornitoreadminutente";

    //Set who the message is to be sent from
    $mail->setFrom('kungfoodcompany@gmail.com', 'KungFood');

    //Set an alternative reply-to address
    $mail->addReplyTo('kungfoodcompany@gmail.com', 'KungFood');

    //Set who the message is to be sent to
    $mail->addAddress($mail_destinatario, $nome);

      //Content
      $mail->isHTML(true);
      $mail->Subject = "Registrazione Avvenuta";
      $mail->Body = "Benvenuto ".$nome."! La registrazione all'applicazione Kung Food e' avvenuta con successo. Ora puoi procedere al login e sfondarti di cibo come se non ci fosse un domani. Un saluto dal tuo Sensei.";
      $mail->AltBody = "Benvenuto ".$nome."! La registrazione all'applicazione Kung Food e' avvenuta con successo. Ora puoi procedere al login e sfondarti di cibo come se non ci fosse un domani. Un saluto dal tuo Sensei.";

      //definiamo i comportamenti in caso di invio corretto
      //o di errore
      if (!$mail->Send()) {
          return false;
      } else {
          return true;
      }
      //chiudiamo la connessione
      $mail->SmtpClose();
      unset($mail);
}


function send_mail_notify($mail_destinatario, $body)
{
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "kungfoodcompany@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "fornitoreadminutente";

    //Set who the message is to be sent from
    $mail->setFrom('kungfoodcompany@gmail.com', 'KungFood');

    //Set an alternative reply-to address
    $mail->addReplyTo('kungfoodcompany@gmail.com', 'KungFood');

    //Set who the message is to be sent to
    $mail->addAddress($mail_destinatario, $nome);

      //Content
      $mail->isHTML(true);
      $mail->Subject = "Registrazione Avvenuta";
      $mail->Body = $body;
      $mail->AltBody = $body;

      //definiamo i comportamenti in caso di invio corretto
      //o di errore
      if (!$mail->Send()) {
          return false;
      } else {
          return true;
      }
      //chiudiamo la connessione
      $mail->SmtpClose();
      unset($mail);
}

?>
