<?php

namespace Notification;

interface SmsProvider
{

    public function send(SmsMessage $message);
}