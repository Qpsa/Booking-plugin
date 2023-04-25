<?php

namespace Reservation;

use Repository\ReservationRepository;

class ReservationManager
{
    private ReservationRepository $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function create(Reservation $reservation)
    {
        if ($reservation->getFromDate() < $reservation->getToDate()) {
            $validate = $this->reservationRepository->select(null, $reservation->getFromDate(), $reservation->getToDate(), $reservation->getCalendarID());
            if (count($validate) === 0) {
                $this->reservationRepository->insert($reservation);
            } else {
                throw new \RuntimeException(__("Date is already booked", PLUGIN_TRANSLATION_SLUG));
            }
        } else {
            throw new \RuntimeException(__("Wrong reservation date", PLUGIN_TRANSLATION_SLUG));
        }
    }

}