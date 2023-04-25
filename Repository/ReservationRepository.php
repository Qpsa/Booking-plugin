<?php

namespace Repository;

use Reservation\Reservation;

class ReservationRepository
{
    public static function getTableName()
    {
        /** @var \wpdb */
        global $wpdb;

        return $wpdb->prefix . 'reservations';
    }

    public function select($search = null, $fromDate = null, $toDate = null, $calendar = null)
    {
        /** @var \wpdb */
        global $wpdb;

        $sql = sprintf
        ("SELECT * FROM %s", self::getTableName());

        if ($search || $fromDate ||  $toDate || $calendar) {
            $sql = $sql . " WHERE";

            if ($search) {
                $sql = $sql . sprintf
                    (" calendar_id LIKE '%s'", $search);
            }

            if ($fromDate && $toDate) {
                $calendarSQL = '';
                if ($calendar) {
                    $calendarSQL = sprintf(" AND calendar_id ='%s'", $calendar);
                }
                $sql = $sql . sprintf
                    (" '%s' BETWEEN from_date AND to_date $calendarSQL OR '%s' BETWEEN from_date AND to_date $calendarSQL", $fromDate->format('Y-m-d H:i:s'), $toDate->format('Y-m-d H:i:s'));
            }
        }

        $query = $wpdb->prepare($sql);

        $selectData = $wpdb->get_results($query, ARRAY_A);

        return $selectData;
    }

    public function selectBy($calendarID): Reservation
    {
        /** @var \wpdb */
        global $wpdb;

        $sql = sprintf
        ("SELECT * FROM %s WHERE calendar_id = '%s'", self::getTableName(), $calendarID);

        $query = $wpdb->prepare($sql);

        $selectData = $wpdb->get_results($query, ARRAY_A);

        return Reservation::fromArray($selectData[0]);
    }

    public function insert(Reservation $reservation)
    {
        /** @var \wpdb */
        global $wpdb;

        $wpdb->insert(
            self::getTableName(),
            $reservation->toArray()
        );
    }

    public function deleteReservation($id)
    {
        /** @var \wpdb */
        global $wpdb;

        $sql = sprintf
        ("DELETE FROM %s WHERE id = '%s'", self::getTableName(), $id);

        $query = $wpdb->prepare($sql);

        $wpdb->query($query);
    }

}