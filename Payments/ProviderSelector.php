<?php

namespace Payments;

class ProviderSelector
{

    private array $providers;

    /**
     * @param TransactionProvider[] $providers
     */
    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function collectPayment(string $provider, PaymentInformation $paymentInformation): void
    {
        $this->getProvider($provider)->collectPayment($paymentInformation);
    }

    private function getProvider(string $provider): TransactionProvider
    {
        if (!array_key_exists($provider, $this->providers)) {
            throw new \RuntimeException(sprintf('Provider %s not found', $provider));
        }

        return $this->providers[$provider];
    }

}