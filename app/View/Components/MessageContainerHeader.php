<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MessageContainerHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $with="Aucun utilisateur séléctionné",
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message-container-header');
    }
}
