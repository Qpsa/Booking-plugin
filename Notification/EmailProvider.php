<?php

namespace Notification;

interface EmailProvider
{

    public function sendEmail(EmailMessage $emailMessage);
}