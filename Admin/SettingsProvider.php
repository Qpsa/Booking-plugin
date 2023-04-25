<?php

namespace Admin;

use Notification\TwilioNotifier;
use Payments\PayseraService;

class SettingsProvider
{
    const OPTIONS_GENERAL_SECTION = 'myplugin_general_section';
    const OPTION_NAME_PAYSERA_PROJECT_ID = 'paysera_project_id';
    const OPTION_NAME_PAYSERA_PROJECT_PASSWORD = 'paysera_project_password';
    const OPTION_NAME_TWILIO_ID = 'myplugin_twilio_id';
    const OPTION_NAME_TWILIO_TOKEN = 'myplugin_twilio_token';
    const OPTION_NAME_DEFAULT_SMS_PROVIDER = 'default_sms_provider';
    const OPTION_NAME_EMAIL_SMTP_PORT = 'myplugin_email_port';
    const OPTION_NAME_EMAIL_SMTP_HOST = 'myplugin_email_host';
    const OPTION_NAME_EMAIL_SMTP_USERNAME = 'myplugin_email_username';
    const OPTION_NAME_EMAIL_SMTP_PASSWORD = 'myplugin_email_password';
    const OPTION_NAME_EMAIL_SENDGRID_API = 'myplugin_email_sendgrid_api';
    const DEFAULT_NULL_AVAILABILITY = '0';
    const DEFAULT_NULL_TIME = '00:00';


    public function getPayseraProjectID(): string
    {
        return get_option(self::OPTION_NAME_PAYSERA_PROJECT_ID);
    }

    public function getPayseraProjectSignPassword(): string
    {
        return get_option(self::OPTION_NAME_PAYSERA_PROJECT_PASSWORD);
    }

    public function getTwilioSID(): string
    {
        return get_option(self::OPTION_NAME_TWILIO_ID);
    }

    public function getTwilioTOKEN(): string
    {
        return get_option(self::OPTION_NAME_TWILIO_TOKEN);
    }

    public function getDefaultSmsProvider(): string
    {
        return get_option(self::OPTION_NAME_DEFAULT_SMS_PROVIDER);
    }

    public function getEmailPort(): string
    {
        return get_option(self::OPTION_NAME_EMAIL_SMTP_PORT);
    }

    public function getEmailHost(): string
    {
        return get_option(self::OPTION_NAME_EMAIL_SMTP_HOST);
    }

    public function getEmailUsername(): string
    {
        return get_option(self::OPTION_NAME_EMAIL_SMTP_USERNAME);
    }

    public function getEmailPassword(): string
    {
        return get_option(self::OPTION_NAME_EMAIL_SMTP_PASSWORD);
    }

    public function getSendGridApiKey(): string
    {
        return get_option(self::OPTION_NAME_EMAIL_SENDGRID_API);
    }

}
