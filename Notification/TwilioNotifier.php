<?php

namespace Notification;

use Twilio\Rest\Client;

class TwilioNotifier implements SmsProvider
{

    private $sid;

    /**
     * @param $sid
     */

    private $token;

    /**
     * @param $token
     */

    private $senderNumber;

    /**
     * @param $senderNumber
     */

    public function __construct($sid, $token, $senderNumber)
    {
        $this->sid = $sid;
        $this->token = $token;
        $this->senderNumber = $senderNumber;
    }


    public function send(SmsMessage $message)
    {
        $client = new Client($this->sid, $this->token);
        $twilioMessage = $client->messages->create(
            $message->getNumber(),
            [
                'from' => $this->senderNumber,
                'body' => $message->getText()
            ]
        );
    }
}