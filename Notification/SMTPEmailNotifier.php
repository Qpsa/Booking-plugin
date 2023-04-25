<?php

namespace Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SMTPEmailNotifier implements EmailProvider
{
    private $port;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    public function __construct($port, $host, $username, $password)
    {
        $this->port = $port;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function sendEmail(EmailMessage $emailMessage)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();


        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = $this->port;
        $mail->Host       = $this->host;
        $mail->Username   = $this->username;
        $mail->Password   = $this->password;

        $mail->IsHTML(true);
        $mail->AddAddress($emailMessage->getRecipientEmail(), $emailMessage->getRecipientName());
        $mail->SetFrom($emailMessage->getSenderEmail(), $emailMessage->getSenderName());
        $mail->AddReplyTo("reply-to-email", "reply-to-name");
        $mail->AddCC("cc-recipient-email", "cc-recipient-name");
        $mail->Subject = $emailMessage->getSubject();
        $content = $emailMessage->getContent();

        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            throw new \RuntimeException(__("Error while sending Email", PLUGIN_TRANSLATION_SLUG));
        } else {
            _e("Email sent successfully", PLUGIN_TRANSLATION_SLUG);
        }
    }
}