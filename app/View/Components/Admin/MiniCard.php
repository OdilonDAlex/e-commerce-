<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MiniCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title="",
        public string $value="",
        public string $action="voir",
        public string $actionLink="", 
        public string $svg="",
        public string $incomeDifference="",
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.mini-card');
    }
}
