<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MessageContainer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $messages=array(),
        public string $conversationWith="Aucun utilisateur séléctionné",
        public string|int $receiver_id=1,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message-container');
    }
}
