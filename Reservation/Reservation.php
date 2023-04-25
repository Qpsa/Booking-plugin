<?php

namespace Reservation;

use Order\Order;

class Reservation
{
    const STATUS_PAID = 'paid';
    const STATUS_OPEN = 'open';

    private $id, $fromDate, $toDate, $orderID, $status, $calendarID, $clientID;

    public function __construct($fromDate, $toDate, $calendarID, $clientID = null) {
        $this->id = null;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->orderID = null;
        $this->status = self::STATUS_OPEN;
        $this->calendarID = $calendarID;
        $this->clientID = $clientID;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getFromDate()
    {
        return $this->fromDate;
    }

    public function getToDate()
    {
        return $this->toDate;
    }

    public function getOrderID()
    {
        return $this->orderID;
    }
    public function getCalendarID()
    {
        return $this->calendarID;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getClientID()
    {
        return $this->clientID;
    }

    public function setOrder()
    {
        return $this->orderID;
    }

    public function setPaidStatus()
    {
        return $this->status = self::STATUS_PAID;
    }

    public function toArray(): array
    {
        return [
            'from_date' => $this->fromDate->format('Y-m-d H:i:s'),
            'to_date' => $this->toDate->format('Y-m-d H:i:s'),
            'order_id' => $this->orderID,
            'client_id'=> $this->clientID,
            'calendar_id' => $this->calendarID,
            'status' => $this->status

        ];
    }

    public static function fromArray(array $data): Reservation
    {
        $reservation = new self($data['from_date'], $data['to_date'], $data['client_id'], $data['calendar_id']);
        $reservation->id = $data['id'];

        return $reservation;
    }
}