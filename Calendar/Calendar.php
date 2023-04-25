<?php

namespace Calendar;

use SlotSettings\SlotSettings;

class Calendar
{

    private $id, $name, $slotSettingsID;

    public function __construct($name, SlotSettings $slotSettings = null)
    {
        $this->id = null;
        $this->name = $name;
        if ($slotSettings === null) {
            $this->slotSettingsID = null;
        } else {
            $this->slotSettingsID = $slotSettings->getId();
        }
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlotSettingsID()
    {
        return $this->slotSettingsID;
    }

    public function __setID($id)
    {
        $this->id = $id;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slot_settings_id' => $this->slotSettingsID
        ];
    }

    public static function fromArray(array $data): Calendar
    {
        $calendar = new self($data['name']);
        $calendar->id = $data['id'];
        $calendar->slotSettingsID = $data['slot_settings_id'];

        return $calendar;
    }
}