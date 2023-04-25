<?php

namespace Reservation;

use Calendar\Calendar;
use Client\Client;

class ReservationFacade
{
    private ReservationManager $reservationManager;

    /**
     * @param ReservationManager $reservationManager ;
     */
    public function __construct(ReservationManager $reservationManager)
    {
        $this->reservationManager = $reservationManager;
    }

    /**
     * @param $from
     * @param $to
     * @param $amount
     * @return Reservation
     */
    public function createReservation(\DateTime $from, \DateTime $to, Calendar $calendar, Client $client = null)
    {
        if ($client) {
            $reservation = new Reservation($from, $to, $calendar->getID(), $client->getId());
            $this->reservationManager->create($reservation);
        } else {
            $reservation = new Reservation($from, $to, $calendar->getID());
            $this->reservationManager->create($reservation);
        }
        return $reservation;
    }

}