<?php

namespace Plugin\Component;

use Calendar\Calendar;
use Calendar\CalendarDataProvider;
use Client\ClientFacade;
use Utils\WebParam;

class FullCalendarView implements CalendarViewInterface
{

    private CalendarDataProvider $calendarDataProvider;
    private ClientFacade $clientFacade;

    public function __construct(CalendarDataProvider $calendarDataProvider, ClientFacade $clientFacade)
    {
        $this->calendarDataProvider = $calendarDataProvider;
        $this->clientFacade = $clientFacade;
    }

    public function display(Calendar $calendar)
    {
        if (WebParam::post('submit')) {
            $this->clientFacade->formReservation(WebParam::post('startDate'), WebParam::post('endDate'), WebParam::post('name'), WebParam::post('lastName'), WebParam::post('phone'), $calendar);
        }

        $dateTime = new \DateTime();
        $events = $this->calendarDataProvider->getEvents($calendar, $dateTime);

        ?>
        <script>
            var data = <?php echo json_encode($events); ?>
        </script>
        <?php

        wp_add_inline_script('jquery', 'var $ = jQuery.noConflict();');

        wp_enqueue_style('coreMainCSS', plugins_url('fullcalendar/packages/core/main.css', __FILE__));
        wp_enqueue_style('daygridMainCSS', plugins_url('fullcalendar/packages/daygrid/main.css', __FILE__));

        wp_enqueue_script('coreMainJS', plugins_url('fullcalendar/packages/core/main.js', __FILE__));
        wp_enqueue_script('interactionMainJS', plugins_url('fullcalendar/packages/interaction/main.js', __FILE__));
        wp_enqueue_script('daygridMainJS', plugins_url('fullcalendar/packages/daygrid/main.js', __FILE__));
        wp_enqueue_script('timegridMainJS', plugins_url('fullcalendar/packages/timegrid/main.js', __FILE__));
        wp_enqueue_script('listMainJS', plugins_url('fullcalendar/packages/list/main.js', __FILE__));


        wp_enqueue_script('fullcalendarLanguage', plugins_url('fullcalendar/packages/core/locales/lt.js', __FILE__));

        return "
              <div id='calendar-container'>
                <div id='calendar'></div>
              </div>
              
              <div class='container'>
                  <form id='myplugin-reservation-form' method='post'>
                     <input type='text' name='title' id='title' value='' readonly><br><br>
                     <input type='text' name='startDate' id='startDate' value='' readonly>
                     <input type='text' name='endDate' id='endDate' value='' readonly><br><br>
                     <input type='text' name='name' value='' placeholder='Name'>
                     <input type='text' name='lastName' value='' placeholder='Last name'><br><br>
                     <input type='tel' name='phone' value='' placeholder='phone number'><br><br>
                     <input id='myplugin-reservation-submit' type='submit' value='Reserve'>
                  </form>
              </div>
              
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'lt',
                    plugins: ['interaction', 'dayGrid'],
                    height: 'parent',
                    header: {
                        left: 'title',
                        center: '',
                        right: 'today prev,next'
                    },
                    eventClick: function(info) {
                        var eventObject = info.event;
                        
                        $('html,body').animate({
                        scrollTop: $('.container').offset().top},
                        'slow');
        
                        document.getElementById('title').value = eventObject.title;
                        document.getElementById('startDate').value = eventObject.start;
                        document.getElementById('endDate').value = eventObject.end;
                     },
                    defaultView: 'dayGridMonth',
                    defaultDate: new Date(),
                    navLinks: true, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow more link when too many events
                    events: data
                    
                });
                calendar.render();
            });
              </script> ";
    }
}