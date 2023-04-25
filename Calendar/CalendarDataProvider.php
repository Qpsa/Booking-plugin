<?php

namespace Calendar;

use Repository\ReservationRepository;
use Repository\SlotSettingsRepository;
use Reservation\Reservation;
use SlotSettings\SlotDayParametersDTO;

class CalendarDataProvider
{
    const CALENDAR_TYPE_MONTH = 'month';
    const CALENDAR_TYPE_WEEK = 'week';
    const CALENDAR_TYPE_DAY = 'day';

    private ReservationRepository $reservationRepository;
    private SlotSettingsRepository $slotSettingsRepository;
    private CalendarItemTransformerInterface $calendarItemTransformer;


    public function __construct(ReservationRepository $reservationRepository, SlotSettingsRepository $slotSettingsRepository, CalendarItemTransformerInterface $calendarItemTransformer)
    {
        $this->reservationRepository = $reservationRepository;
        $this->slotSettingsRepository = $slotSettingsRepository;
        $this->calendarItemTransformer = $calendarItemTransformer;
    }


    public function getEvents(Calendar $calendar, \DateTime $dateTime, $type = self::CALENDAR_TYPE_MONTH)
    {
        $events = [];
        $date = $dateTime->format('F Y');
        $slotSettings = $this->slotSettingsRepository->selectBy($calendar->getSlotSettingsID());

        $startDate = (clone $dateTime)->modify('first day of this month');
        $endDate = (clone $dateTime)->modify('last day of this month');

        $daysOfWeek = [
            $slotSettings->getSunday(),
            $slotSettings->getMonday(),
            $slotSettings->getTuesday(),
            $slotSettings->getWednesday(),
            $slotSettings->getThursday(),
            $slotSettings->getFriday(),
            $slotSettings->getSaturday()
        ];

        for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $dayOfWeek = $date->format('w');

            /** @var SlotDayParametersDTO $daySlotSettings */
            $daySlotSettings = $daysOfWeek[$dayOfWeek];
            if ($daySlotSettings->isAvailable()) {
                $slotDayStartDatetime = new \DateTime($date->format('Y-m-d') . " " . $daySlotSettings->dayStart);
                $slotDayEndDatetime = new \DateTime($date->format('Y-m-d') . " " . $daySlotSettings->dayEnd);

                $slotStart = clone $slotDayStartDatetime;
                $slotCount = 0;
                while ($slotStart < $slotDayEndDatetime) {
                    $slotStart = clone $slotDayStartDatetime;
                    $slotStart->modify(sprintf("+%s minutes", ($slotCount * $slotSettings->getSlotSize())));
                    $slotStartClone = clone $slotStart;
                    $startClone = clone $slotStart;
                    $slotEnd = $startClone->modify(sprintf("+%s minutes", ($slotSettings->getSlotSize())));
                    $slotCount++;

                    $items[] = new CalendarItemDTO
                    (
                        $slotSettings->getSlotName(),
                        $slotStartClone,
                        $slotEnd,
                        'grey',
                        $slotSettings->getSlotSize(),
                        $daySlotSettings->unavailableFrom,
                        $daySlotSettings->unavailableTo
                    );
                    //tikrinti ar dar galima sugeneruoti daugiau slotu
                    if ($slotEnd >= $slotDayEndDatetime) {
                        break;
                    }
                }

            }
        }
        $reservations = $this->reservationRepository->select($calendar->getID());

        $itemsFiltered = [];
        foreach ($items as $item) {
            if ($this->itemIsAvailable($item, $reservations)) {
                $itemsFiltered[] = $item;
            }
        }
//        foreach ($reservations as $reservation) {
//            $startDate = $reservation['from_date'];
//            $endDate = $reservation['to_date'];
//            $startDateTime = new \DateTime($startDate);
//            $endDateTime = new \DateTime($endDate);
//
//            $items[] = new CalendarItemDTO
//            (
//                'booked',
//                $startDateTime,
//                $endDateTime,
//                'blue'
//            );
//
//        }

        foreach ($itemsFiltered as $item) {
            $events[] = $this->calendarItemTransformer->transform($item);
        }
        return $events;
    }

    /**
     * @param CalendarItemDTO $item
     * @param Reservation[] $reservations
     * @return bool
     */

    private function itemIsAvailable(CalendarItemDTO $item, array $reservations)
    {
        foreach ($reservations as $reservation) {
            $todayDate = new \DateTime();
            $startDate = $reservation['from_date'];
            $endDate = $reservation['to_date'];
            $startDateTime = new \DateTime($startDate);
            $endDateTime = new \DateTime($endDate);
            if ($item->dayStart <= $endDateTime && $startDateTime <= $item->dayEnd) {
                $available = false;
            } else {
                if ($item->dayStart > $todayDate) {
                    $available = true;
                } else {
                    $available = false;
                }
            }
        }
        return $available;
    }
}