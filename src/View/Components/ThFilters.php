<?php

namespace michalkortas\LaravelIndexable\View\Components;

use Illuminate\View\Component;

class ThFilters extends Component
{
    /**
     * Create a new component instance.
     */

    public $tableFilters;
    public $name;
    public $requestFilters;
    public $path;

    public function __construct(
        $tableFilters = false,
        $name = '',
        $requestFilters = [],
        $path = ''
    )
    {
        $this->tableFilters = $tableFilters;
        $this->name = $name;
        $this->requestFilters = $requestFilters;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('indexable::components/th-filters');
    }

}
