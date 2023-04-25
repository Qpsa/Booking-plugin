<?php

namespace Notification;

use Admin\SettingsProvider;

class EmailProviderListFactory
{
    public const EMAIL_PROVIDER_SMTP = 'smtp';
    public const EMAIL_PROVIDER_SENDGRID = 'sendgrid';

    private SettingsProvider $settingsProvider;

    /**
     * @param SettingsProvider $settingsProvider
     */
    public function __construct(SettingsProvider $settingsProvider)
    {
        $this->settingsProvider = $settingsProvider;
    }

    /**
     * @return EmailProvider[]
     */
    public function create(): array
    {
        return [
            self::EMAIL_PROVIDER_SENDGRID => new SendGridNotifier($this->settingsProvider->getSendGridApiKey()),
            self::EMAIL_PROVIDER_SMTP => new SMTPEmailNotifier($this->settingsProvider->getEmailPort(), $this->settingsProvider->getEmailHost(), $this->settingsProvider->getEmailUsername(), $this->settingsProvider->getEmailPassword())
        ];
    }
}