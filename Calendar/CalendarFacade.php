<?php

namespace Calendar;

use Calendar\CalendarManager;
use Option\Option;
use ProductOption\ProductOptionFacade;
use Reservation\ReservationDTO;
use Reservation\ReservationFacade;
use SlotSettings\SlotSettings;

class CalendarFacade
{

    private CalendarManager $calendarManager;
    private ProductOptionFacade $productOptionFacade;
    private ReservationFacade $reservationFacade;

    public function __construct(CalendarManager $calendarManager, ProductOptionFacade $productOptionFacade, ReservationFacade $reservationFacade)
    {
        $this->calendarManager = $calendarManager;
        $this->productOptionFacade = $productOptionFacade;
        $this->reservationFacade = $reservationFacade;
    }

    /**
     * @param $name
     * @param ReservationDTO[] $reservations
     * @param Option[] $options
     * @return Calendar
     */
    public function createCalendar($name, SlotSettings $slotSettings = null, array $reservations = [], array $options = [])
    {
        $calendar = $this->calendarManager->create(new Calendar($name, $slotSettings));

        foreach ($reservations as $reservation) {
            $this->reservationFacade->createReservation($reservation->fromDate, $reservation->toDate, $calendar);
        }

        foreach ($options as $option) {
            $this->productOptionFacade->setCalendarOptions($calendar, $option);
        }

        return $calendar;
    }

}