<?php

namespace Admin\Component;

use Admin\SettingsProvider;
use SlotSettings\SlotDayParametersDTO;
use SlotSettings\SlotSettingsFacade;
use Utils\WebParam;

class SlotSettingsForm implements GUIComponentInterface
{

    private SlotSettingsFacade $slotSettingsFacade;

    public function __construct(SlotSettingsFacade $slotSettingsFacade)
    {
        $this->slotSettingsFacade = $slotSettingsFacade;
    }


    public function display()
    {
        if (WebParam::post('create')) {
            $monday = $this->createSlotDayParameterDTO(WebParam::post('monday')[0]);
            $tuesday = $this->createSlotDayParameterDTO(WebParam::post('tuesday')[0]);
            $wednesday = $this->createSlotDayParameterDTO(WebParam::post('wednesday')[0]);
            $thursday = $this->createSlotDayParameterDTO(WebParam::post('thursday')[0]);
            $friday = $this->createSlotDayParameterDTO(WebParam::post('friday')[0]);
            $saturday = $this->createSlotDayParameterDTO(WebParam::post('saturday')[0]);
            $sunday = $this->createSlotDayParameterDTO(WebParam::post('sunday')[0]);

            $slotSetting = $this->slotSettingsFacade->createSlotSetting(
                    WebParam::post('slotName'),
                    WebParam::post('slotSize'),
                    $monday,
                    $tuesday,
                    $wednesday,
                    $thursday,
                    $friday,
                    $saturday,
                    $sunday
            );
        }
        ?>
        <form method="post">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="slots">Slot settings name:</label>
                    </th>
                    <td>
                        <input type="text" name="slotName" required>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="slots">Slot size:</label>
                    </th>
                    <td>
                        <input type="number" min="5" max="60" step="5" name="slotSize" required>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="Options-field">Days available:</label>
                    </th>
                    <td>
                        <fieldset>
                            <label for="options"><input type="checkbox" id="m" onclick="showMonday(this)" name="monday[0][available]" value="1">Monday</label><br>
                            <label for="options"><input type="checkbox" id="t" onclick="showTuesday(this)" name="tuesday[0][available]" value="1">Tuesday</label><br>
                            <label for="options"><input type="checkbox" id="w" onclick="showWednesday(this)" name="wednesday[0][available]" value="1">Wednesday</label><br>
                            <label for="options"><input type="checkbox" id="th" onclick="showThursday(this)" name="thursday[0][available]" value="1">Thursday</label><br>
                            <label for="options"><input type="checkbox" id="f" onclick="showFriday(this)" name="friday[0][available]" value="1">Friday</label><br>
                            <label for="options"><input type="checkbox" id="st" onclick="showSaturday(this)" name="saturday[0][available]" value="1">Saturday</label><br>
                            <label for="options"><input type="checkbox" id="s" onclick="showSunday(this)" name="sunday[0][available]" value="1">Sunday</label><br>
                        </fieldset>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <thead>
                    <tr style="display: block">
                        <th scope="col">Day</th>
                        <th scope="col">Day start</th>
                        <th scope="col">Day end</th>
                        <th scope="col">Unavailable from</th>
                        <th scope="col">Unavailable to</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="displayMonday" style="display: none">
                        <th scope="col">Monday</th>
                        <th scope="col"><input type="time" name="monday[0][dayStart]"></th>
                        <th scope="col"><input type="time" name="monday[0][dayEnd]"></th>
                        <th scope="col"><input type="time" name="monday[0][unavailableFrom]"></th>
                        <th scope="col"><input type="time" name="monday[0][unavailableTo]"></th>
                    </tr>
                    <tr id="displayTuesday" style="display: none">
                        <th scope="col">Tuesday</th>
                        <th scope="col"><input type="time" name="tuesday[0][dayStart]"></th>
                        <th scope="col"><input type="time" name="tuesday[0][dayEnd]"></th>
                        <th scope="col"><input type="time" name="tuesday[0][unavailableFrom]"></th>
                        <th scope="col"><input type="time" name="tuesday[0][unavailableTo]"></th>
                    </tr>
                    <tr id="displayWednesday" style="display: none">
                        <th scope="col">Wednesday</th>
                        <th scope="col"><input type="time" name="wednesday[0][dayStart]"></th>
                        <th scope="col"><input type="time" name="wednesday[0][dayEnd]"></th>
                        <th scope="col"><input type="time" name="wednesday[0][unavailableFrom]"></th>
                        <th scope="col"><input type="time" name="wednesday[0][unavailableTo]"></th>
                    </tr>
                    <tr id="displayThursday" style="display: none">
                        <th scope="col">Thursday</th>
                        <th scope="col"><input type="time" name="thursday[0][dayStart]"></th>
                        <th scope="col"><input type="time" name="thursday[0][dayEnd]"></th>
                        <th scope="col"><input type="time" name="thursday[0][unavailableFrom]"></th>
                        <th scope="col"><input type="time" name="thursday[0][unavailableTo]"></th>
                    </tr>
                    <tr id="displayFriday" style="display: none">
                        <th scope="col">Friday</th>
                        <th scope="col"><input type="time" name="friday[0][dayStart]"></th>
                        <th scope="col"><input type="time" name="friday[0][dayEnd]"></th>
                        <th scope="col"><input type="time" name="friday[0][unavailableFrom]"></th>
                        <th scope="col"><input type="time" name="friday[0][unavailableTo]"></th>
                    </tr>
                    <tr id="displaySaturday" style="display: none">
                        <th scope="col">Saturday</th>
                        <th scope="col"><input type="time" name="saturday[0][dayStart]"></th>
                        <th scope="col"><input type="time" name="saturday[0][dayEnd]"></th>
                        <th scope="col"><input type="time" name="saturday[0][unavailableFrom]"></th>
                        <th scope="col"><input type="time" name="saturday[0][unavailableTo]"></th>
                    </tr>
                    <tr id="displaySunday" style="display: none">
                        <th scope="col">Sunday</th>
                        <th scope="col"><input type="time" name="sunday[0][dayStart]"></th>
                        <th scope="col"><input type="time" name="sunday[0][dayEnd]"></th>
                        <th scope="col"><input type="time" name="sunday[0][unavailableFrom]"></th>
                        <th scope="col"><input type="time" name="sunday[0][unavailableTo]"></th>
                    </tr>
                </tbody>
            </table>

            <div class="wrap">
                <input type="submit" class="button-primary" name="create" value="Create">
            </div>
        </form>
        <script>
            function showMonday(m) {
                var displayMonday = document.getElementById("displayMonday");
                displayMonday.style.display = m.checked ? "block" : "none";
            }

            function showTuesday(t) {
                var displayTuesday = document.getElementById("displayTuesday");
                displayTuesday.style.display = t.checked ? "block" : "none";
            }

            function showWednesday(w) {
                var displayWednesday = document.getElementById("displayWednesday");
                displayWednesday.style.display = w.checked ? "block" : "none";
            }

            function showThursday(th) {
                var displayThursday = document.getElementById("displayThursday");
                displayThursday.style.display = th.checked ? "block" : "none";
            }

            function showFriday(f) {
                var displayFriday = document.getElementById("displayFriday");
                displayFriday.style.display = f.checked ? "block" : "none";
            }

            function showSaturday(st) {
                var displaySaturday = document.getElementById("displaySaturday");
                displaySaturday.style.display = st.checked ? "block" : "none";
            }

            function showSunday(s) {
                var displaySunday = document.getElementById("displaySunday");
                displaySunday.style.display = s.checked ? "block" : "none";
            }
        </script>
        <?php
    }

    /**
     * @param $dayData
     * @return SlotDayParametersDTO
     */
    private function createSlotDayParameterDTO($dayData)
    {
        return new SlotDayParametersDTO(
            $dayData['available'] ?? SettingsProvider::DEFAULT_NULL_AVAILABILITY,
            $dayData['dayStart'] ? $dayData['dayStart'] : SettingsProvider::DEFAULT_NULL_TIME,
            $dayData['dayEnd'] ? $dayData['dayEnd'] : SettingsProvider::DEFAULT_NULL_TIME,
            $dayData['unavailableFrom'] ? $dayData['unavailableFrom'] : SettingsProvider::DEFAULT_NULL_TIME,
            $dayData['unavailableTo'] ? $dayData['unavailableTo'] : SettingsProvider::DEFAULT_NULL_TIME

        );
    }
}