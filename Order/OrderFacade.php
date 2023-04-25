<?php

namespace Order;

use Admin\SettingsProvider;
use Notification\SmsMessage;
use Notification\SmsNotification;
use Notification\SmsProviderListFactory;

class OrderFacade
{

    private OrderManager $orderManager;
    private SmsNotification $smsNotification;

    /**
     * @param OrderManager $orderManager
     * @param SmsNotification $smsNotification
     */
    public function __construct(OrderManager $orderManager, SmsNotification $smsNotification)
    {
        $this->orderManager = $orderManager;
        $this->smsNotification = $smsNotification;
    }

    public function new($amount)
    {
        $order = $this->orderManager->save(new Order($amount));

        return $order;
    }

    public function paymentAccepted(Order $order)
    {
        $order->setPaid(true);
        $this->orderManager->save($order);
        $this->smsNotification->send(SmsProviderListFactory::PROVIDER_TWILIO, new SmsMessage('','Thank you for your order'));
    }
}