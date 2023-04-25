<?php

namespace Repository;

use Calendar\Calendar;

class CalendarRepository
{

    public static function getTableName()
    {
        /** @var \wpdb */
        global $wpdb;

        return $wpdb->prefix . 'calendars';
    }

    public function select($search = null)
    {
        /** @var \wpdb */
        global $wpdb;
        $tableName = self::getTableName();
        $productOptionTableName = ProductOptionRepository::getTableName();
        $optionTableName = OptionRepository::getTableName();
        $slotSettingsTableName = SlotSettingsRepository::getTableName();

        if ($search) {
            $sql = 'SELECT ' . $tableName . ' .*, group_concat(' . $optionTableName . '.name) as option_name, ' . $slotSettingsTableName . '.slot_name FROM ' . $tableName . ' LEFT JOIN ' . $productOptionTableName . ' ON ' . $tableName . '.id = ' . $productOptionTableName . '.calendar_id LEFT JOIN ' . $optionTableName . ' ON ' . $productOptionTableName . '.order_option_id = ' . $optionTableName . '.id LEFT JOIN ' . $slotSettingsTableName . ' ON ' . $tableName . '.slot_settings_id = ' . $slotSettingsTableName . '.id WHERE ' . $tableName . '.name LIKE "%' . $search . '%" group by ' . $tableName . '.id';
        } else {
            $sql = 'SELECT ' . $tableName . ' .*, group_concat(' . $optionTableName . '.name) as option_name, ' . $slotSettingsTableName . '.slot_name FROM ' . $tableName . ' LEFT JOIN ' . $productOptionTableName . ' ON ' . $tableName . '.id = ' . $productOptionTableName . '.calendar_id LEFT JOIN ' . $optionTableName . ' ON ' . $productOptionTableName . '.order_option_id = ' . $optionTableName . '.id LEFT JOIN ' . $slotSettingsTableName . ' ON ' . $tableName . '.slot_settings_id = ' . $slotSettingsTableName . '.id group by ' . $tableName . '.id';
        }

        $query = $wpdb->prepare($sql);

        $selectData = $wpdb->get_results($query, ARRAY_A);

        return $selectData;
    }

    public function insert(Calendar $calendar)
    {
        /** @var \wpdb */
        global $wpdb;

        $wpdb->insert(
            self::getTableName(),
            $calendar->toArray()
        );

        $calendar->__setID($wpdb->insert_id);

        return $calendar;
    }


    public function deleteCalendar(Calendar $calendar)
    {
        /** @var \wpdb */
        global $wpdb;

        $sql = sprintf
        ("DELETE FROM %s WHERE id = '%s'", self::getTableName(), $calendar->getID());

        $query = $wpdb->prepare($sql);

        $wpdb->query($query);
    }

    public function updateCalendar(Calendar $calendar, $name)
    {
        /** @var \wpdb */
        global $wpdb;

        $sql = sprintf
        ("UPDATE %s SET name = '%s' WHERE id = '%s'", self::getTableName(), $name, $calendar->getID());

        $query = $wpdb->prepare($sql);

        $wpdb->query($query);
    }

    public function selectBy($id): Calendar
    {
        /** @var \wpdb */
        global $wpdb;

        $sql = sprintf
        ("SELECT * FROM %s WHERE id = '%s'", self::getTableName(), $id);

        $query = $wpdb->prepare($sql);

        $selectData = $wpdb->get_results($query, ARRAY_A);

        return Calendar::fromArray($selectData[0]);
    }
}