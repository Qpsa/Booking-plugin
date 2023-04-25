<?php

namespace Payments;

class PaymentInformation
{
    private $orderid, $amount;

    public function __construct($orderid, $amount)
    {
        $this->orderid = $orderid;
        $this->amount = $amount;
    }
    /**
     * @return string
     */
    public function getOrderID()
    {
        return $this->orderid;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

}