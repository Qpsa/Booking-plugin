<?php

namespace Payments;

interface TransactionProvider
{

    public function collectPayment(PaymentInformation $paymentInformation);
}