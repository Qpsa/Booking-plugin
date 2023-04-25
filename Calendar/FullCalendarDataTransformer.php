<?php

namespace Calendar;

class FullCalendarDataTransformer implements CalendarItemTransformerInterface
{

    public function transform(CalendarItemDTO $calendarItem)
    {
        $event = [
            'title' => $calendarItem->name,
            'start' => $calendarItem->dayStart->format('Y-m-d').'T'.$calendarItem->dayStart->format('H:i:s'),
            'end' => $calendarItem->dayEnd->format('Y-m-d').'T'.$calendarItem->dayEnd->format('H:i:s'),
            'slot duration' => $calendarItem->slotSize,
            'color' => $calendarItem->slotColor
        ];
        return $event;
    }
}