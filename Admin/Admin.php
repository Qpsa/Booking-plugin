<?php

namespace Admin;

use Admin\Component\ReservationList;

class Admin
{
    private DashboardPage $dashboardPage;
    private CalendarPage $calendarPage;
    private ReservationsPage $reservationsPage;
    private ItemsPage $itemsPage;
    private SlotSettingsPage $slotSettingsPage;
    private SettingsPage $settingsPage;

    public function __construct(DashboardPage $dashboardPage, CalendarPage $calendarPage, ReservationsPage $reservationsPage, ItemsPage $itemsPage, SlotSettingsPage $slotSettingsPage, SettingsPage $settingsPage)
    {
        $this->dashboardPage = $dashboardPage;
        $this->calendarPage = $calendarPage;
        $this->reservationsPage = $reservationsPage;
        $this->itemsPage = $itemsPage;
        $this->slotSettingsPage = $slotSettingsPage;
        $this->settingsPage = $settingsPage;
    }

    public function init()
    {
        add_action('admin_menu', [$this, 'initAll']);
        add_action('admin_init', [$this->settingsPage, 'registerSettingFields']);
    }

    public function initAll()
    {
        $this->initMenu();
        $this->initSubMenu();
    }

    private function initMenu()
    {
        add_menu_page(  __('Dashboard', PLUGIN_TRANSLATION_SLUG), 'Dashboard', 'administrator', PLUGIN_NAME, [$this->dashboardPage, 'displayDashboardPage'], 'dashicons-chart-area', 26 );
    }

    private function initSubMenu()
    {

        $calendarSubMenuPageId = add_submenu_page( PLUGIN_NAME, __('Calendar', PLUGIN_TRANSLATION_SLUG), 'Calendar', 'administrator', PLUGIN_NAME.'-list', [$this->calendarPage, 'displayList']);
        $reservationSubMenuPageId = add_submenu_page( PLUGIN_NAME, __('Reservations', PLUGIN_TRANSLATION_SLUG), 'Reservations', 'administrator', PLUGIN_NAME.'-reservations', [$this->reservationsPage, 'displayReservations']);
        $itemsSubMenuPageId = add_submenu_page( PLUGIN_NAME, __('Items', PLUGIN_TRANSLATION_SLUG), 'Items', 'administrator', PLUGIN_NAME.'-items', [$this->itemsPage, 'displayItems']);
        add_submenu_page( PLUGIN_NAME, __('Slot settings', PLUGIN_TRANSLATION_SLUG), 'Slot settings', 'administrator', PLUGIN_NAME.'-slot-settings', [$this->slotSettingsPage, 'displaySlotSettings']);
        add_submenu_page( PLUGIN_NAME, __('Plugin settings', PLUGIN_TRANSLATION_SLUG), 'Settings', 'administrator', PLUGIN_NAME.'-settings', [$this->settingsPage, 'displaySettings']);

    }
}
