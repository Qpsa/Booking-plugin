<?php

namespace Calendar;

class CalendarItemDTO
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var \DateTime
     */
    public $dayStart;

    /**
     * @var \DateTime
     */
    public $dayEnd;

    /**
     * @var string
     */
    public $slotColor;

    /**
     * @var int
     */
    public $slotSize;

    /**
     * @var string
     */

    public $unavailableFrom;

    /**
     * @var string
     */
    public $unavailableTo;

    /**
     * @param $name
     * @param \DateTime $dayStart
     * @param \DateTime $dayEnd
     * @param $slotSize
     * @param $unavailableFrom
     * @param $unavailableTo
     */
    public function __construct($name, \DateTime $dayStart, \DateTime $dayEnd, $slotColor, $slotSize = null, $unavailableFrom = null, $unavailableTo = null)
    {
        $this->name = $name;
        $this->dayStart = $dayStart;
        $this->dayEnd = $dayEnd;
        $this->slotColor = $slotColor;
        $this->slotSize = $slotSize;
        $this->unavailableFrom = $unavailableFrom;
        $this->unavailableTo = $unavailableTo;
    }


}