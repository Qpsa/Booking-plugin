<?php

namespace Plugin\Component;

use Calendar\Calendar;

interface CalendarViewInterface
{

    public function display(Calendar $calendar);
}