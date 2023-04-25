<?php

namespace Notification;

class SmsNotification
{

    private array $providers;

    /**
     * @param SmsProvider[] $providers
     */
    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function send(string $provider, SmsMessage $message): void
    {
        $this->getProvider($provider)->send($message);
    }

    private function getProvider(string $provider): SmsProvider
    {
        if (!array_key_exists($provider, $this->providers)) {

            throw new \RuntimeException(sprintf('Provider %s not found', $provider));
        }

        return $this->providers[$provider];
    }

}