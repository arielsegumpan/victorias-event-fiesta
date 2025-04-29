<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Guava\Calendar\Widgets\CalendarWidget;

class FiestaCalendarWidget extends CalendarWidget
{
    protected static string $view = 'filament.admin.widgets.fiesta-calendar-widget';

    // public function getEvents(array $fetchInfo = []): Collection | array
    // {
    //     return [
    //         // Chainable object-oriented variant
    //         CalendarEvent::make()
    //             ->title('My first event')
    //             ->start(today())
    //             ->end(today()),

    //         // Array variant
    //         ['title' => 'My second event', 'start' => today()->addDays(3), 'end' => today()->addDays(3)],

    //         // Eloquent model implementing the `Eventable` interface
    //         MyEvent::find(1),
    //     ];
    // }
}
