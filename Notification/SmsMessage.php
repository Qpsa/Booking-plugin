<?php

namespace Notification;

class SmsMessage
{
    private $number, $text;

    public function __construct($number, $text)
    {
        $this->number = $number;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }


}