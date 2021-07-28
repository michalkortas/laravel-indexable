<?php

namespace michalkortas\LaravelIndexable\View\Components;

use Illuminate\View\Component;

class Td extends Component
{
    /**
     * Create a new component instance.
     */

    public $item;
    public $path;
    public $columns;
    public $loop;
    public $resource;
    public $actionButtons;

    public function __construct(
        $item = [],
        $path = '',
        $columns = [],
        $loop = null,
        $resource = '',
        $actionButtons = false
    )
    {
        $this->item = $item;
        $this->path = $path;
        $this->columns = $columns;
        $this->loop = $loop;
        $this->resource = $resource;
        $this->actionButtons = $actionButtons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('indexable::components/td');
    }

}
