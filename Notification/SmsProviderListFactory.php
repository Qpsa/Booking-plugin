<?php

namespace Notification;

use Admin\SettingsProvider;

class SmsProviderListFactory
{
    public const PROVIDER_TWILIO = 'twilio';

    private SettingsProvider $settingsProvider;

    /**
     * @param SettingsProvider $settingsProvider
     */
    public function __construct(SettingsProvider $settingsProvider)
    {
        $this->settingsProvider = $settingsProvider;
    }

    /**
     * @return SmsProvider[]
     */
    public function create(): array
    {
        return [
            self::PROVIDER_TWILIO => new TwilioNotifier($this->settingsProvider->getTwilioSID(), $this->settingsProvider->getTwilioTOKEN(), $this->settingsProvider->getDefaultSmsProvider())
        ];
    }
}