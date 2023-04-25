<?php

class Container
{
    private $services;

    public function __construct()
    {
        $this->services = [];
    }


    public function get($class)
    {
        if (array_key_exists($class, $this->services)) {
            return $this->services[$class];
        }

        return $this->init($class);
    }

    private function init($class)
    {
        $object = null;
        switch ($class) {
            case \Calendar\FullCalendarDataTransformer::class:
                $object = new \Calendar\FullCalendarDataTransformer();
                break;
            case \Calendar\CalendarDataProvider::class:
                $object = new \Calendar\CalendarDataProvider($this->get(\Repository\ReservationRepository::class), $this->get(\Repository\SlotSettingsRepository::class), $this->get(\Calendar\FullCalendarDataTransformer::class));
                break;
            case \Repository\ClientRepository::class:
                $object = new \Repository\ClientRepository();
                break;
            case \Client\ClientManager::class:
                $object = new \Client\ClientManager($this->get(\Repository\ClientRepository::class));
                break;
            case \Client\ClientFacade::class:
                $object = new \Client\ClientFacade($this->get(\Client\ClientManager::class), $this->get(\Reservation\ReservationFacade::class));
                break;
            case \Plugin\Component\FullCalendarView::class:
                $object = new \Plugin\Component\FullCalendarView($this->get(\Calendar\CalendarDataProvider::class), $this->get(\Client\ClientFacade::class));
                break;
            case \Plugin\Component\PaymentView::class:
                $object = new \Plugin\Component\PaymentView();
                break;
            case \Plugin\Plugin::class:
                $object = new \Plugin\Plugin($this->get(\Plugin\Component\PaymentView::class), $this->get(\Plugin\Component\FullCalendarView::class), $this->get(\Repository\CalendarRepository::class));
                break;
            case \Admin\SettingsProvider::class:
                $object = new \Admin\SettingsProvider();
                break;
            case \Notification\EmailProviderListFactory::class:
                $object = new \Notification\EmailProviderListFactory($this->get(\Admin\SettingsProvider::class));
                break;
            case \Notification\SmsProviderListFactory::class:
                $object = new \Notification\SmsProviderListFactory($this->get(\Admin\SettingsProvider::class));
                break;
            case \Notification\PaymentProviderListFactory::class:
                $object = new \Notification\PaymentProviderListFactory($this->get(\Admin\SettingsProvider::class));
            case \Notification\SmsNotification::class:
                $object = new \Notification\SmsNotification($this->get(\Notification\SmsProviderListFactory::class)->create());
                break;
            case \Notification\EmailNotification::class:
                $object = new \Notification\EmailNotification($this->get(\Notification\EmailProviderListFactory::class)->create());
                break;
            case \Payments\ProviderSelector::class:
                $object = new \Payments\ProviderSelector($this->get(\Notification\PaymentProviderListFactory::class)->create());
                break;
            case \Repository\OrderRepository::class:
                $object = new \Repository\OrderRepository();
                break;
            case \Order\OrderManager::class:
                $object = new \Order\OrderManager($this->get(\Repository\OrderRepository::class));
                break;
            case \Order\OrderFacade::class:
                $object = new \Order\OrderFacade($this->get(\Order\OrderManager::class), $this->get(\Notification\SmsNotification::class), $this->get(\Admin\SettingsProvider::class));
                break;
            case \Repository\ReservationRepository::class:
                $object = new \Repository\ReservationRepository();
                break;
            case \Reservation\ReservationManager::class:
                $object = new \Reservation\ReservationManager($this->get(\Repository\ReservationRepository::class));
                break;
            case \Reservation\ReservationFacade::class:
                $object = new \Reservation\ReservationFacade($this->get(\Reservation\ReservationManager::class));
                break;
            case \Repository\CalendarRepository::class:
                $object = new \Repository\CalendarRepository();
                break;
            case \Calendar\CalendarManager::class:
                $object = new \Calendar\CalendarManager($this->get(\Repository\CalendarRepository::class));
                break;
            case \Calendar\CalendarFacade::class:
                $object = new \Calendar\CalendarFacade($this->get(\Calendar\CalendarManager::class), $this->get(\ProductOption\ProductOptionFacade::class), $this->get(\Reservation\ReservationFacade::class));
                break;
            case \Admin\CalendarPage::class:
                $object = new \Admin\CalendarPage($this->get(\Repository\CalendarRepository::class), $this->get(\Repository\OptionRepository::class), $this->get(\Admin\Component\CalendarForm::class), $this->get(\Admin\Component\OptionForm::class));
                break;
            case \Admin\Component\CalendarForm::class:
                $object = new \Admin\Component\CalendarForm($this->get(\Repository\OptionRepository::class), $this->get(\Calendar\CalendarFacade::class), $this->get(\Repository\SlotSettingsRepository::class));
                break;
            case \Admin\Component\OptionForm::class:
                $object = new \Admin\Component\OptionForm($this->get(\Option\OptionFacade::class));
                break;
            case \Admin\SettingsPage::class:
                $object = new \Admin\SettingsPage();
                break;
            case \Admin\DashboardPage::class:
                $object = new \Admin\DashboardPage($this->get(\Notification\EmailNotification::class));
                break;
            case \Admin\ReservationsPage::class:
                $object = new \Admin\ReservationsPage($this->get(\Repository\ReservationRepository::class));
                break;
            case \Admin\Component\SlotSettingsForm::class:
                $object = new \Admin\Component\SlotSettingsForm($this->get(\SlotSettings\SlotSettingsFacade::class));
                break;
            case \Admin\SlotSettingsPage::class:
                $object = new \Admin\SlotSettingsPage($this->get(\Admin\Component\SlotSettingsForm::class));
                break;
            case \Repository\ItemRepository::class:
                $object = new \Repository\ItemRepository();
                break;
            case \Admin\Component\ItemForm::class:
                $object = new \Admin\Component\ItemForm($this->get(\Item\ItemFacade::class));
                break;
            case \Admin\ItemsPage::class:
                $object = new \Admin\ItemsPage($this->get(\Repository\ItemRepository::class), $this->get(\Admin\Component\ItemForm::class));
                break;
            case \Admin\Admin::class:
                $object = new \Admin\Admin($this->get(\Admin\DashboardPage::class), $this->get(\Admin\CalendarPage::class), $this->get(\Admin\ReservationsPage::class), $this->get(\Admin\ItemsPage::class), $this->get(\Admin\SlotSettingsPage::class), $this->get(\Admin\SettingsPage::class));
                break;
            case \Item\ItemManager::class:
                $object = new \Item\ItemManager($this->get(\Repository\ItemRepository::class));
                break;
            case \Item\ItemFacade::class:
                $object = new \Item\ItemFacade($this->get(\Item\ItemManager::class));
                break;
            case \Repository\OptionRepository::class:
                $object = new \Repository\OptionRepository();
                break;
            case \Option\OptionManager::class:
                $object = new \Option\OptionManager($this->get(\Repository\OptionRepository::class));
                break;
            case \Option\OptionFacade::class:
                $object = new \Option\OptionFacade($this->get(\Option\OptionManager::class));
                break;
            case \Repository\ProductOptionRepository::class:
                $object = new \Repository\ProductOptionRepository();
                break;
            case \ProductOption\ProductOptionManager::class:
                $object = new \ProductOption\ProductOptionManager($this->get(\Repository\ProductOptionRepository::class));
                break;
            case \ProductOption\ProductOptionFacade::class:
                $object = new \ProductOption\ProductOptionFacade($this->get(\ProductOption\ProductOptionManager::class));
                break;
            case \Database\Database::class:
                $object = new \Database\Database();
                break;
            case \SlotSettings\SlotSettingsFacade::class:
                $object = new \SlotSettings\SlotSettingsFacade($this->get(\SlotSettings\SlotSettingsManager::class));
                break;
            case \SlotSettings\SlotSettingsManager::class:
                $object = new \SlotSettings\SlotSettingsManager($this->get(\Repository\SlotSettingsRepository::class));
                break;
            case \Repository\SlotSettingsRepository::class:
                $object = new \Repository\SlotSettingsRepository();
                break;
        }

        $this->services[$class] = $object;

        return $object;
    }
}