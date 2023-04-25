<?php

namespace Reservation;

class ReservationDTO
{

    /**
     * @var \DateTime
     */
    public $fromDate;

    /**
     * @var \DateTime
     */
    public $toDate;

    /**
     * @param \DateTime $fromDate
     * @param \DateTime $toDate
     */
    public function __construct(\DateTime $fromDate, \DateTime $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }


}