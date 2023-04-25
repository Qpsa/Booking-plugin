<?php

namespace Notification;

use Admin\SettingsProvider;
use Payments\PayseraService;

class PaymentProviderListFactory
{
    public const PROVIDER_PAYSERA = 'paysera';

    private SettingsProvider $settingsProvider;

    /**
     * @param SettingsProvider $settingsProvider
     */
    public function __construct(SettingsProvider $settingsProvider)
    {
        $this->settingsProvider = $settingsProvider;
    }

    public function create(): array
    {
        return [
            self::PROVIDER_PAYSERA => new PayseraService($this->settingsProvider->getPayseraProjectID(), $this->settingsProvider->getPayseraProjectSignPassword())
        ];
    }
}