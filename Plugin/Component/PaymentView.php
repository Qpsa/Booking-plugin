<?php

namespace Plugin\Component;

use Utils\WebParam;

class PaymentView
{

    public function display()
    {
        if (!empty(WebParam::post('pay'))) {

            global $container;
            $reservation = $container->get(\Reservation\ReservationFacade::class)->createReservation(WebParam::post('from'), WebParam::post('to'), WebParam::post('amount'));
            $container->get(\Payments\ProviderSelector::class)->collectPayment(\Notification\PaymentProviderListFactory::PROVIDER_PAYSERA,
                new \Payments\PaymentInformation($reservation->getOrder()->getOrderID(), $reservation->getOrder()->getAmount()));
        }
        return '<form method="POST"> 
                    <input type="number" name="amount">
                    <input type="datetime-local" name="from">
                    <input type="datetime-local" name="to">
                    <input type="submit" class="button-primary" name="pay" value="Pay">
                </form>';

    }
}