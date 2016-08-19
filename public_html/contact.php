<?php
    require("functions.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("contactform.php", ['title' => 'Contact']);
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // $transport = Swift_SmtpTransport::newInstance();
        $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
        // $transport->setHost('smtp-relay.gmail.com');
        // $transport->setPort(587);
        // $transport->setUsername('cathony@ailurophiliac.com');
        // $transport->setPassword('Foomy421');
        // $transport->setEncryption('tls');

        $mailer = Swift_Mailer::newInstance($transport);

        $mail = Swift_Message::newInstance();
        $mail->setSubject('Message From ' . $name . ": " . $email);
        $mail->setFrom(array('webform@ailurophiliac.com' => $name));
        $mail->setReplyTo(array($email => $name));
        $mail->setTo(array('contactform@ailurophiliac.com' => 'Cat'));
        $mail->setBody($message);

        if($mailer->send($mail)) {
            thank('Your message was successfully sent. We will get back to you as soon as possible.');
        } else {
            error('Failed to send your message. Please try again.');
        }
    }
?>
