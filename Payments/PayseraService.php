<?php

namespace Payments;

use WebToPay;

class PayseraService implements TransactionProvider
{

    private $projectid;

    /**
     * @param $projectid
     */

    private $sign_password;

    /**
     * @param $sign_password
     */

    public function __construct($projectid, $sign_password)
    {
        $this->projectid = $projectid;
        $this->sign_password = $sign_password;
    }

    public function collectPayment(PaymentInformation $paymentInformation)
    {
        WebToPay::redirectToPayment([
            'projectid' => $this->projectid,
            'sign_password' => $this->sign_password,
            'orderid' => $paymentInformation->getOrderID(),
            'amount' => $paymentInformation->getAmount(),
            'currency' => 'EUR',
            'country' => 'LT',
            'accepturl' => '',
            'cancelurl' => '',
            'callbackurl' => '',
            'test' => 1,
        ]);
    }
}
