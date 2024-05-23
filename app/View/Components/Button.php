<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $text;
    public $route;
    public $classes;
    /**
     * Create a new component instance.
     */
    public function __construct($text, $route, $classes = '')
    {
        $this->text = $text;
        $this->route = $route;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
