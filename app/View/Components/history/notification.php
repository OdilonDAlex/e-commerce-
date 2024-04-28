<?php

namespace App\View\Components\history;

use Closure;
use Faker\Core\Color;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Notifications\DatabaseNotification;

class notification extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public DatabaseNotification $notification,
        public string $bgColor="white",
        public string $color="black"
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.history.notification');
    }
}
