<?php

namespace Admin;

use Admin\Component\CalendarForm;
use Admin\Component\GenericList;
use Admin\Component\OptionForm;
use Admin\Component\CalendarList;
use Admin\Component\OptionList;
use Repository\CalendarRepository;
use Repository\OptionRepository;
use Utils\WebParam;

class CalendarPage
{
    private CalendarRepository $calendarRepository;
    private OptionRepository $optionRepository;
    private ?CalendarList $calendarList = null;
    private CalendarForm $calendarForm;
    private OptionForm $optionForm;
    private ?OptionList $optionList = null;

    public function __construct(
            CalendarRepository $calendarRepository,
            OptionRepository $optionRepository,
            CalendarForm $calendarForm,
            OptionForm $optionForm
    )
    {
        $this->calendarRepository = $calendarRepository;
        $this->optionRepository = $optionRepository;
        $this->calendarForm = $calendarForm;
        $this->optionForm = $optionForm;
    }

    public function loadScreenOptions()
    {
        global $table;

        $args = array(
            'label' => __('Elements per page', 'my-booking-plugin'),
            'default' => 10,
            'option' => 'elements_per_page'
        );
        add_screen_option( 'per_page', $args );

        $table = $this->getCalendarList();
    }

    private function getCalendarList()
    {
        if ($this->calendarList) {

            //do nothing
        } else {
            $calendarList = $this->calendarRepository->select(WebParam::post('s'));

            $this->calendarList = new CalendarList($calendarList, new GenericList());
        }

        return $this->calendarList;
    }

    private function getOptionsList()
    {
        if ($this->optionList) {

            //do nothing
        } else {
            $optionList = $this->optionRepository->select(WebParam::post('s'));

            $this->optionList = new OptionList($optionList, new GenericList());
        }

        return $this->optionList;
    }

    public function displayList()
    {

        ?>
            <div class="wrap">
                <h3 class="nav-tab-wrapper">
                    <a href="#" onclick="viewList()" class="nav-tab">View calendars</a>
                    <a href="#" onclick="viewInsert()" class="nav-tab">Insert new</a>
                    <a href="#" onclick="viewOptionsList()" class="nav-tab">View options</a>
                    <a href="#" onclick="viewOptions()" class="nav-tab">Create options</a>
                </h3>
            </div>
        <div id="listContainer">
        <?php $this->getCalendarList()->display(); ?>
        </div>

        <div class="wrap" id="calendarCreationForm" style="display:none">
            <?php $this->calendarForm->display(); ?>
        </div>

        <div id="listOptionsContainer" style="display:none">
            <?php $this->getOptionsList()->display(); ?>
        </div>

        <div class="wrap" id="optionCreationForm" style="display:none">
            <?php $this->optionForm->display(); ?>
        </div>

        <script>
            var listContainer = document.getElementById("listContainer");
            var insertContainer = document.getElementById("calendarCreationForm");
            var listOptionsContainer = document.getElementById("listOptionsContainer");
            var optionCreationForm = document.getElementById("optionCreationForm");

            function viewInsert()
            {
                listContainer.style.display = "none";
                optionCreationForm.style.display = "none";
                listOptionsContainer.style.display = "none";
                insertContainer.style.display = "block";
            }

            function viewList()
            {
                listContainer.style.display = "block";
                optionCreationForm.style.display = "none";
                listOptionsContainer.style.display = "none";
                insertContainer.style.display = "none";
            }

            function viewOptionsList()
            {
                listContainer.style.display = "none";
                optionCreationForm.style.display = "none";
                listOptionsContainer.style.display = "block";
                insertContainer.style.display = "none";
            }

            function viewOptions()
            {
                listContainer.style.display = "none";
                optionCreationForm.style.display = "block";
                listOptionsContainer.style.display = "none";
                insertContainer.style.display = "none";
            }
        </script>


        <?php
    }
}



