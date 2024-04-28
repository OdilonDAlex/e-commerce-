<?php

namespace App\View\Components\history;

use Closure;
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
