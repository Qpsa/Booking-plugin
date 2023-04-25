<?php

namespace Calendar;

interface CalendarItemTransformerInterface
{

    public function transform(CalendarItemDTO $calendarItem);
}