<?php

namespace Notification;

class EmailNotification
{

    private array $providers;

    /**
     * @param EmailProvider[] $providers
     */
    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function sendEmail(string $provider, EmailMessage $emailMessage): void
    {
        $this->getProvider($provider)->sendEmail($emailMessage);
    }

    private function getProvider(string $provider): EmailProvider
    {
        if (!array_key_exists($provider, $this->providers)) {

            throw new \RuntimeException(sprintf('Provider %s not found', $provider));
        }

        return $this->providers[$provider];
    }

}