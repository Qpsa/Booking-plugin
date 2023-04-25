<?php

namespace Order;

use Payments\PaymentInformation;

class Order
{
    private $id, $time, $orderid, $amount, $isPaid;

    public function __construct($amount)
    {
        $this->id = null;
        $this->time = (new \DateTime())->format(\DateTime::ATOM);
        $this->orderid = self::generateOrderId();
        $this->amount = $amount;
        $this->isPaid = false;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getOrderID()
    {
        return $this->orderid;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setPaid($paid)
    {
        $this->isPaid = $paid;
    }

    public function setAmount(PaymentInformation $paymentInformation)
    {
        $this->amount = $paymentInformation->getAmount();
        return $this->amount;
    }

    public function setOrderID(PaymentInformation $paymentInformation)
    {
        $this->orderid = $paymentInformation->getOrderID();
        return $this->orderid;
    }

    public static function fromArray(array $data): Order
    {
        $order = new self($data['amount']);
        $order->id = $data['id'];
        $order->orderid = $data['order_id'];
        $order->time = $data['time'];
        $order->setPaid($data['is_paid']);

        return $order;
    }

    public function toArray(): array
    {
        return [
            'time' => $this->time,
            'order_id' => $this->orderid,
            'amount' => $this->amount,
            'is_paid' => $this->isPaid
        ];
    }

    public static function generateOrderId()
    {
        return uniqid();
    }
}