<?php

namespace Plugin;

use Plugin\Component\FullCalendarView;
use Plugin\Component\PaymentView;
use Repository\CalendarRepository;

class Plugin
{
    private PaymentView $paymentView;
    private FullCalendarView $fullCalendarView;
    private CalendarRepository $calendarRepository;

    public function __construct(PaymentView $paymentView, FullCalendarView $fullCalendarView, CalendarRepository $calendarRepository)
    {
        $this->paymentView = $paymentView;
        $this->fullCalendarView = $fullCalendarView;
        $this->calendarRepository = $calendarRepository;
    }

    public function pluginInit()
    {
        add_shortcode('paymentShortcode', [$this, 'initPaymentShortcode']);
        add_shortcode('calendarShortcode', [$this, 'initCalendarShortcode']);
    }

    public function initPaymentShortcode()
    {
        return $this->paymentShortcode();
    }

    public function initCalendarShortcode()
    {
        return $this->calendarShortcode('1');
    }

    private function paymentShortcode()
    {
        return $this->paymentView->display();
    }

    private function calendarShortcode($id)
    {
        //fetch calendar from db and pass object not id
         $calendar = $this->calendarRepository->selectBy($id);
         return $this->fullCalendarView->display($calendar);
    }
}