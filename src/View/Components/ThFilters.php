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
    public $rangeFilters;
    public $typeFilters;
    public $path;
    public $isRangeFilter;
    public $filterType;

    public function __construct(
        $tableFilters = false,
        $name = '',
        $requestFilters = [],
        $rangeFilters = [],
        $typeFilters = [],
        $path = ''
    )
    {
        $this->tableFilters = $tableFilters;
        $this->name = $name;
        $this->requestFilters = $requestFilters;
        $this->rangeFilters = $rangeFilters;
        $this->typeFilters = $typeFilters;
        $this->path = $path;
        $this->isRangeFilter = array_key_exists($path, $this->rangeFilters);
        $this->filterType = array_key_exists($path, $this->typeFilters) ? $this->typeFilters[$path] : 'text';
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
