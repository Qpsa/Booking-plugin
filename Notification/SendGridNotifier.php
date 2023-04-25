<?php

namespace Notification;

class SendGridNotifier implements EmailProvider
{

    /**
     * @var string
     */
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendEmail(EmailMessage $emailMessage)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($emailMessage->getSenderEmail(), $emailMessage->getSenderName());
        $email->setSubject($emailMessage->getSubject());
        $email->addTo($emailMessage->getRecipientEmail(), $emailMessage->getRecipientName());
        $email->addContent("text/plain", $emailMessage->getContent());
        $sendgrid = new \SendGrid($this->apiKey);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
        } catch (Exception $e) {
             _e('Caught exception: ' . $e->getMessage() . "\n");
        }
    }
}