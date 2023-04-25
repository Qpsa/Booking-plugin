<?php

namespace Notification;

class EmailMessage
{

    private $recipientEmail, $recipientName, $senderEmail, $senderName, $subject, $content;

    public function __construct($recipientEmail, $recipientName, $senderEmail, $senderName, $subject, $content)
    {
        $this->recipientEmail = $recipientEmail;
        $this->recipientName = $recipientName;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }

    /**
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * @return string
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * @return string
     */
    public function getSenderName()
    {
        return $this->senderName;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}